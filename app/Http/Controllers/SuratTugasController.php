<?php

namespace App\Http\Controllers;

use App\Models\SuratTugas;
use App\Models\Pegawai;
use App\Models\MasterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SuratTugasController extends Controller
{
    /**
     * Folder penyimpanan dokumen PDF.
     */
    private function uploadFolder(): string
    {
        return public_path('surat-tugas');
    }

    /**
     * Membuat folder jika belum tersedia.
     */
    private function ensureUploadFolder(): void
    {
        $folder = $this->uploadFolder();

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }
    }

    /**
     * Menyimpan file PDF dan mengembalikan nama file.
     */
    private function uploadPdf(Request $request): ?string
    {
        if (!$request->hasFile('dokumen_pdf')) {
            return null;
        }

        $this->ensureUploadFolder();

        $file = $request->file('dokumen_pdf');
        $filename = Str::uuid() . '.pdf';

        $file->move($this->uploadFolder(), $filename);

        return $filename;
    }

    /**
     * Menghapus file PDF.
     */
    private function deletePdf(?string $filename): void
    {
        if (!$filename) {
            return;
        }

        $path = $this->uploadFolder() . DIRECTORY_SEPARATOR . basename($filename);

        if (File::exists($path)) {
            File::delete($path);
        }
    }

    /**
     * Mencari atau membuat data master berdasarkan kategori.
     */
    private function getOrCreateMaster(string $kategori, string $nama): MasterModel
    {
        return MasterModel::firstOrCreate(
            [
                'kategori' => $kategori,
                'nama' => trim($nama),
            ],
            [
                'aktif' => true,
            ]
        );
    }

    /**
     * Menyimpan relasi master dari input teks.
     */
    private function resolveMasterData(array $data): array
    {
        $instansi = $this->getOrCreateMaster(
            'instansi',
            $data['instansi']
        );

        $lokasi = $this->getOrCreateMaster(
            'lokasi',
            $data['lokasi']
        );

        $jenisKegiatan = $this->getOrCreateMaster(
            'jenis_kegiatan',
            $data['jenis_kegiatan']
        );

        return [
            'instansi_id' => $instansi->id,
            'lokasi_id' => $lokasi->id,
            'jenis_kegiatan_id' => $jenisKegiatan->id,
        ];
    }

    /**
     * Validasi data surat tugas.
     */
    private function validateSuratTugas(Request $request, ?SuratTugas $suratTugas = null): array
    {
        $uniqueNomor = 'unique:surat_tugas,nomor_surat';

        if ($suratTugas) {
            $uniqueNomor .= ',' . $suratTugas->id;
        }

        return $request->validate([
            'nomor_surat' => [
                'required',
                'string',
                'max:255',
                $uniqueNomor,
            ],

            'kegiatan' => [
                'required',
                'string',
                'max:255',
            ],

            'pegawai_id' => [
                'required',
                'integer',
                'exists:pegawais,id',
            ],

            'instansi' => [
                'required',
                'string',
                'max:255',
            ],

            'lokasi' => [
                'required',
                'string',
                'max:255',
            ],

            'jenis_kegiatan' => [
                'required',
                'string',
                'max:255',
            ],

            'tanggal_mulai' => [
                'required',
                'date',
            ],

            'tanggal_selesai' => [
                'nullable',
                'date',
                'after_or_equal:tanggal_mulai',
            ],

            'dokumen_pdf' => [
                $suratTugas ? 'nullable' : 'required',
                'file',
                'mimes:pdf',
                'max:10240',
            ],

            'catatan' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'nomor_surat.required' => 'Nomor surat wajib diisi.',
            'nomor_surat.unique' => 'Nomor surat sudah digunakan.',
            'pegawai_id.required' => 'Pegawai wajib dipilih.',
            'pegawai_id.exists' => 'Pegawai tidak ditemukan.',
            'instansi.required' => 'Instansi wajib diisi.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'jenis_kegiatan.required' => 'Jenis kegiatan wajib diisi.',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
            'dokumen_pdf.required' => 'Dokumen PDF wajib diupload.',
            'dokumen_pdf.mimes' => 'Dokumen harus berupa PDF.',
            'dokumen_pdf.max' => 'Ukuran PDF maksimal 10 MB.',
        ]);
    }

    /**
     * INDEX
     */
    public function index()
    {
        $suratTugas = SuratTugas::with([
            'pegawai',
            'pembuat',
            'approver',
            'instansi',
            'lokasi',
            'jenisKegiatan',
        ])
            ->latest()
            ->get();

        $pegawais = Pegawai::orderBy('nama')->get();

        return view('admin.surat-tugas.index', compact(
            'suratTugas',
            'pegawais'
        ));
    }

    /**
     * CREATE
     */
    public function create()
    {
        $pegawais = Pegawai::orderBy('nama')->get();

        return view('admin.surat-tugas.create', compact('pegawais'));
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $data = $this->validateSuratTugas($request);

        $filename = null;

        try {
            DB::beginTransaction();

            $masterData = $this->resolveMasterData($data);

            $filename = $this->uploadPdf($request);

            SuratTugas::create([
                'nomor_surat' => $data['nomor_surat'],
                'kegiatan' => $data['kegiatan'],
                'pegawai_id' => $data['pegawai_id'],

                'instansi_id' => $masterData['instansi_id'],
                'lokasi_id' => $masterData['lokasi_id'],
                'jenis_kegiatan_id' => $masterData['jenis_kegiatan_id'],

                'tanggal_mulai' => $data['tanggal_mulai'],
                'tanggal_selesai' => $data['tanggal_selesai'] ?? null,

                'dokumen_pdf' => $filename,

                'status' => 'draft',
                'catatan' => $data['catatan'] ?? null,

                'created_by' => auth()->id(),
                'approved_by' => null,
                'approved_at' => null,
            ]);

            DB::commit();

            return redirect()
                ->route('admin.surat-tugas.index')
                ->with('success', 'Surat tugas berhasil dibuat.');

        } catch (\Throwable $e) {
            DB::rollBack();

            $this->deletePdf($filename);

            report($e);

            return back()
                ->withInput()
                ->with('error', 'Gagal menyimpan surat tugas. Silakan periksa kembali data.');
        }
    }

    /**
     * SHOW
     */
    public function show(SuratTugas $suratTugas)
    {
        $suratTugas->load([
            'pegawai',
            'pembuat',
            'approver',
            'instansi',
            'lokasi',
            'jenisKegiatan',
        ]);

        return view('admin.surat-tugas.show', compact('suratTugas'));
    }

    /**
     * EDIT
     */
    public function edit(SuratTugas $suratTugas)
    {
        if (!$this->canEdit($suratTugas)) {
            return redirect()
                ->route('admin.surat-tugas.index')
                ->with('error', 'Surat tugas tidak dapat diedit pada status saat ini.');
        }

        $pegawais = Pegawai::orderBy('nama')->get();

        $suratTugas->load([
            'pegawai',
            'instansi',
            'lokasi',
            'jenisKegiatan',
        ]);

        return view('admin.surat-tugas.edit', compact(
            'suratTugas',
            'pegawais'
        ));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, SuratTugas $suratTugas)
    {
        if (!$this->canEdit($suratTugas)) {
            return redirect()
                ->route('admin.surat-tugas.index')
                ->with('error', 'Surat tugas tidak dapat diperbarui pada status saat ini.');
        }

        $data = $this->validateSuratTugas($request, $suratTugas);

        $filename = null;

        try {
            DB::beginTransaction();

            $masterData = $this->resolveMasterData($data);

            $filename = $this->uploadPdf($request);

            $updateData = [
                'nomor_surat' => $data['nomor_surat'],
                'kegiatan' => $data['kegiatan'],
                'pegawai_id' => $data['pegawai_id'],

                'instansi_id' => $masterData['instansi_id'],
                'lokasi_id' => $masterData['lokasi_id'],
                'jenis_kegiatan_id' => $masterData['jenis_kegiatan_id'],

                'tanggal_mulai' => $data['tanggal_mulai'],
                'tanggal_selesai' => $data['tanggal_selesai'] ?? null,

                'catatan' => $data['catatan'] ?? null,
            ];

            if ($filename) {
                $updateData['dokumen_pdf'] = $filename;
            }

            // Jika surat sebelumnya ditolak, kembalikan ke draft.
            if ($suratTugas->status === 'ditolak') {
                $updateData['status'] = 'draft';
                $updateData['approved_by'] = null;
                $updateData['approved_at'] = null;
            }

            $oldFilename = $suratTugas->dokumen_pdf;

            $suratTugas->update($updateData);

            DB::commit();

            // Hapus file lama setelah update database berhasil.
            if ($filename && $oldFilename) {
                $this->deletePdf($oldFilename);
            }

            return redirect()
                ->route('admin.surat-tugas.index')
                ->with('success', 'Surat tugas berhasil diperbarui.');

        } catch (\Throwable $e) {
            DB::rollBack();

            $this->deletePdf($filename);

            report($e);

            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui surat tugas. Silakan coba kembali.');
        }
    }

    /**
     * DESTROY
     */
    public function destroy(SuratTugas $suratTugas)
    {
        if (!$this->canEdit($suratTugas)) {
            return back()->with(
                'error',
                'Surat tugas yang sudah diajukan atau disetujui tidak dapat dihapus.'
            );
        }

        $filename = $suratTugas->dokumen_pdf;

        $suratTugas->delete();

        $this->deletePdf($filename);

        return redirect()
            ->route('admin.surat-tugas.index')
            ->with('success', 'Surat tugas berhasil dihapus.');
    }

    /**
     * AJUKAN
     */
    public function ajukan(SuratTugas $suratTugas)
    {
        if (!$this->canEdit($suratTugas)) {
            return back()->with(
                'error',
                'Surat tugas tidak dapat diajukan pada status saat ini.'
            );
        }

        if (!$suratTugas->dokumen_pdf) {
            return back()->with(
                'error',
                'Dokumen PDF wajib diupload sebelum diajukan.'
            );
        }

        $suratTugas->update([
            'status' => 'diajukan',
            'catatan' => null,
            'approved_by' => null,
            'approved_at' => null,
        ]);

        return redirect()
            ->route('admin.surat-tugas.index')
            ->with('success', 'Surat tugas berhasil diajukan kepada pimpinan.');
    }

    /**
     * CETAK
     */
    public function cetak(SuratTugas $suratTugas)
    {
        if ($suratTugas->status !== 'disetujui') {
            return back()->with(
                'error',
                'Surat tugas belum disetujui pimpinan.'
            );
        }

        $suratTugas->load([
            'pegawai',
            'pembuat',
            'approver',
            'instansi',
            'lokasi',
            'jenisKegiatan',
        ]);

        return view('admin.surat-tugas.cetak', compact('suratTugas'));
    }

    /**
     * Memeriksa apakah surat masih boleh diedit.
     */
    private function canEdit(SuratTugas $suratTugas): bool
    {
        return in_array($suratTugas->status, ['draft', 'ditolak']);
    }
}