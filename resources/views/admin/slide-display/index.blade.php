@extends('layouts.admin')

@section('title', 'Slide Display')

@section('content')

<div class="content-card">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <div class="page-title">Slide Display</div>
            <small class="text-secondary">
                Kelola gambar dan project yang ditampilkan pada layar TV
            </small>
        </div>

        <button type="button"
                class="btn-orange"
                data-bs-toggle="modal"
                data-bs-target="#tambahSlide">
            + Tambah Slide
        </button>
    </div>

 

    {{-- TABEL SLIDE --}}
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Project</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($slides as $slide)
                    <tr>
                        {{-- GAMBAR --}}
                        <td>
                            @if($slide->gambar)
                                <img
                                    src="{{ asset('storage/' . $slide->gambar) }}"
                                    alt="{{ $slide->judul ?? 'Gambar slide' }}"
                                    style="width:100px;height:60px;object-fit:contain;border-radius:7px;"
                                    onerror="this.style.display='none';"
                                >
                            @else
                                <span class="text-secondary">
                                    Tidak ada gambar
                                </span>
                            @endif
                        </td>

                        {{-- JUDUL --}}
                        <td>
                            {{ $slide->judul ?? '-' }}
                        </td>

                        {{-- PROJECT --}}
                        <td>
                            {{ $slide->project->nama_project ?? 'Belum terhubung' }}
                        </td>

                        {{-- URUTAN --}}
                        <td>
                            {{ $slide->urutan }}
                        </td>

                        {{-- STATUS --}}
                        <td>
                            @if($slide->aktif)
                                <span class="status status-disetujui">
                                    Aktif
                                </span>
                            @else
                                <span class="status status-ditolak">
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td>
                            <div class="d-flex gap-2">
                                <button
                                    type="button"
                                    class="btn-dark-custom"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editSlide{{ $slide->id }}">
                                    Ubah
                                </button>

                                <button
                                    type="button"
                                    class="btn-dark-custom"
                                    data-bs-toggle="modal"
                                    data-bs-target="#hapusSlide{{ $slide->id }}">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6"
                            class="text-center text-secondary py-4">
                            Belum ada slide. Klik Tambah Slide untuk mengunggah gambar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


{{-- =====================================================
     MODAL TAMBAH SLIDE
===================================================== --}}
<div class="modal fade" id="tambahSlide" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form
                action="{{ route('admin.slide-display.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Slide Display</h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- PROJECT --}}
                    <div class="mb-3">
                        <label class="form-label">Project</label>

                        <select name="project_id"
                                class="form-select"
                                required>
                            <option value="">-- Pilih Project --</option>

                            @foreach($projects as $project)
                                <option
                                    value="{{ $project->id }}"
                                    @selected(old('project_id') == $project->id)>
                                    {{ $project->nama_project }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- JUDUL --}}
                    <div class="mb-3">
                        <label class="form-label">Judul Slide</label>

                        <input
                            type="text"
                            name="judul"
                            class="form-control"
                            value="{{ old('judul') }}"
                            placeholder="Masukkan judul slide">
                    </div>

                    {{-- GAMBAR --}}
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>

                        <input
                            type="file"
                            name="gambar"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                            onchange="previewGambarTambah(this)"
                            required>

                        <small class="text-secondary">
                            Format JPG, JPEG, PNG, atau WEBP. Maksimal 5 MB.
                        </small>

                        <div class="mt-3">
                            <img
                                id="previewTambah"
                                src=""
                                alt="Preview gambar"
                                style="display:none;max-width:100%;width:300px;max-height:200px;object-fit:contain;border:1px solid #dee2e6;border-radius:8px;padding:5px;">
                        </div>
                    </div>

                    {{-- URUTAN --}}
                    <div class="mb-3">
                        <label class="form-label">Urutan Tampilan</label>

                        <input
                            type="number"
                            name="urutan"
                            class="form-control"
                            min="0"
                            value="{{ old('urutan', 0) }}"
                            required>

                        <small class="text-secondary">
                            Angka lebih kecil akan ditampilkan lebih dahulu.
                        </small>
                    </div>

                    {{-- STATUS --}}
                    <div class="form-check">
                        <input
                            type="checkbox"
                            name="aktif"
                            value="1"
                            class="form-check-input"
                            id="aktifTambah"
                            checked>

                        <label class="form-check-label"
                               for="aktifTambah">
                            Aktifkan slide agar tampil di display
                        </label>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn-dark-custom"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn-orange">
                        Simpan Slide
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>


{{-- =====================================================
     MODAL EDIT DAN HAPUS
===================================================== --}}
@foreach($slides as $slide)

    {{-- MODAL EDIT --}}
    <div class="modal fade"
         id="editSlide{{ $slide->id }}"
         tabindex="-1">

        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <form
                    action="{{ route('admin.slide-display.update', $slide) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Slide Display</h5>

                        <button type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        {{-- PROJECT --}}
                        <div class="mb-3">
                            <label class="form-label">Project</label>

                            <select name="project_id"
                                    class="form-select"
                                    required>
                                <option value="">-- Pilih Project --</option>

                                @foreach($projects as $project)
                                    <option
                                        value="{{ $project->id }}"
                                        @selected(
                                            old('project_id', $slide->project_id)
                                            == $project->id
                                        )>
                                        {{ $project->nama_project }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- JUDUL --}}
                        <div class="mb-3">
                            <label class="form-label">Judul Slide</label>

                            <input
                                type="text"
                                name="judul"
                                class="form-control"
                                value="{{ $slide->judul }}"
                                placeholder="Masukkan judul slide">
                        </div>

                        {{-- GAMBAR LAMA --}}
                        <div class="mb-3">
                            <label class="form-label d-block">
                                Gambar Saat Ini
                            </label>

                            @if($slide->gambar)
                                <img
                                    src="{{ asset('storage/' . $slide->gambar) }}"
                                    alt="{{ $slide->judul ?? 'Gambar slide' }}"
                                    style="display:block;max-width:100%;width:300px;max-height:200px;object-fit:contain;border:1px solid #dee2e6;border-radius:8px;padding:5px;"
                                    class="mb-3">
                            @else
                                <p class="text-secondary">
                                    Belum ada gambar tersimpan.
                                </p>
                            @endif

                            <label class="form-label">
                                Ganti Gambar (Opsional)
                            </label>

                            <input
                                type="file"
                                name="gambar"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                                onchange="previewGambarEdit(this, 'previewBaru{{ $slide->id }}')">

                            <small class="text-secondary">
                                Kosongkan jika ingin tetap menggunakan gambar lama.
                                Maksimal 5 MB.
                            </small>

                            {{-- PREVIEW GAMBAR BARU --}}
                            <div class="mt-3">
                                <img
                                    id="previewBaru{{ $slide->id }}"
                                    src=""
                                    alt="Preview gambar baru"
                                    style="display:none;max-width:100%;width:300px;max-height:200px;object-fit:contain;border:1px solid #dee2e6;border-radius:8px;padding:5px;">
                            </div>
                        </div>

                        {{-- URUTAN --}}
                        <div class="mb-3">
                            <label class="form-label">Urutan Tampilan</label>

                            <input
                                type="number"
                                name="urutan"
                                class="form-control"
                                min="0"
                                value="{{ $slide->urutan }}"
                                required>
                        </div>

                        {{-- STATUS --}}
                        <div class="form-check">
                            <input
                                type="checkbox"
                                name="aktif"
                                value="1"
                                class="form-check-input"
                                id="aktif{{ $slide->id }}"
                                @checked($slide->aktif)>

                            <label
                                class="form-check-label"
                                for="aktif{{ $slide->id }}">
                                Aktifkan slide agar tampil di display
                            </label>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn-dark-custom"
                            data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn-orange">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    {{-- MODAL HAPUS --}}
    <div class="modal fade"
         id="hapusSlide{{ $slide->id }}"
         tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form
                    action="{{ route('admin.slide-display.destroy', $slide) }}"
                    method="POST">

                    @csrf
                    @method('DELETE')

                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Slide</h5>

                        <button type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p>
                            Yakin ingin menghapus slide ini?
                        </p>

                        @if($slide->gambar)
                            <img
                                src="{{ asset('storage/' . $slide->gambar) }}"
                                alt="{{ $slide->judul ?? 'Gambar slide' }}"
                                style="width:180px;height:100px;object-fit:contain;border-radius:7px;"
                                class="mb-3">
                        @endif

                        <div>
                            <strong>{{ $slide->judul ?? 'Tanpa Judul' }}</strong>
                        </div>

                        <div class="text-secondary mt-1">
                            Project: {{ $slide->project->nama_project ?? 'Belum terhubung' }}
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn-dark-custom"
                            data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-danger">
                            Hapus Slide
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endforeach


{{-- =====================================================
     PREVIEW GAMBAR
===================================================== --}}
<script>
    function tampilkanPreview(input, preview) {
        if (!input.files || !input.files[0]) {
            preview.removeAttribute('src');
            preview.style.display = 'none';
            return;
        }

        const file = input.files[0];

        if (!file.type.startsWith('image/')) {
            input.value = '';
            preview.removeAttribute('src');
            preview.style.display = 'none';

            alert('File harus berupa gambar.');

            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            preview.src = event.target.result;
            preview.style.display = 'block';
        };

        reader.readAsDataURL(file);
    }

    function previewGambarTambah(input) {
        const preview = document.getElementById('previewTambah');

        if (preview) {
            tampilkanPreview(input, preview);
        }
    }

    function previewGambarEdit(input, previewId) {
        const preview = document.getElementById(previewId);

        if (preview) {
            tampilkanPreview(input, preview);
        }
    }
</script>

@endsection
