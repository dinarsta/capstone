
@extends('layouts.admin')

@section('title', 'Slide Display')

@section('content')
<div class="content-card">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <div class="page-title">Slide Display</div>
            <small class="text-secondary">
                Kelola gambar pada layar display
            </small>
        </div>

        <button class="btn-orange"
                data-bs-toggle="modal"
                data-bs-target="#tambahSlide">
            + Tambah Slide
        </button>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- TABEL SLIDE --}}
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($slides as $slide)
                    <tr>
                        <td>
                            @if($slide->gambar)
                                <img
                                    src="{{ asset('storage/' . $slide->gambar) }}"
                                    alt="{{ $slide->judul ?? 'Gambar slide' }}"
                                    style="width:100px;height:55px;object-fit:cover;border-radius:7px;"
                                    onerror="this.style.display='none';"
                                >
                            @else
                                <span class="text-secondary">
                                    Tidak ada gambar
                                </span>
                            @endif
                        </td>

                        <td>{{ $slide->judul ?? '-' }}</td>
                        <td>{{ $slide->urutan }}</td>

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

                        <td>
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
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5"
                            class="text-center text-secondary py-4">
                            Belum ada slide.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- =========================================================
     MODAL TAMBAH SLIDE
========================================================= --}}
<div class="modal fade" id="tambahSlide" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form
                action="{{ route('admin.slide-display.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Slide</h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input
                            type="text"
                            name="judul"
                            class="form-control"
                            value="{{ old('judul') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input
                            type="file"
                            name="gambar"
                            class="form-control"
                            accept="image/jpeg,image/png,image/webp"
                            required>

                        <small class="text-secondary">
                            Format JPG, JPEG, PNG, atau WEBP. Maksimal 5 MB.
                        </small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input
                            type="number"
                            name="urutan"
                            class="form-control"
                            value="{{ old('urutan', 0) }}">
                    </div>

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
                            Aktif
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
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- =========================================================
     MODAL EDIT DAN HAPUS
========================================================= --}}
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
                        <h5 class="modal-title">Ubah Slide</h5>

                        <button type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        {{-- JUDUL --}}
                        <div class="mb-3">
                            <label class="form-label">Judul</label>

                            <input
                                type="text"
                                name="judul"
                                class="form-control"
                                value="{{ old('judul', $slide->judul) }}">
                        </div>

                        {{-- GAMBAR LAMA --}}
                        <div class="mb-3">
                            <label class="form-label d-block">
                                Gambar Saat Ini
                            </label>

                            @if($slide->gambar)
                                <div class="mb-3">
                                    <img
                                        src="{{ asset('storage/' . $slide->gambar) }}"
                                        alt="{{ $slide->judul ?? 'Gambar slide' }}"
                                        class="preview-gambar-lama"
                                        style="display:block;max-width:100%;width:250px;max-height:160px;object-fit:contain;border:1px solid #dee2e6;border-radius:8px;padding:5px;"
                                    >
                                </div>

                                <input
                                    type="hidden"
                                    name="gambar_lama"
                                    value="{{ $slide->gambar }}">
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
                                accept="image/jpeg,image/png,image/webp"
                                onchange="previewGambar(this, 'previewBaru{{ $slide->id }}')">

                            <small class="text-secondary">
                                Kosongkan jika ingin tetap menggunakan gambar lama.
                                Format JPG, JPEG, PNG, atau WEBP. Maksimal 5 MB.
                            </small>

                            {{-- PREVIEW GAMBAR BARU --}}
                            <div class="mt-3">
                                <img
                                    id="previewBaru{{ $slide->id }}"
                                    alt="Preview gambar baru"
                                    style="display:none;max-width:100%;width:250px;max-height:160px;object-fit:contain;border:1px solid #dee2e6;border-radius:8px;padding:5px;">
                            </div>
                        </div>

                        {{-- URUTAN --}}
                        <div class="mb-3">
                            <label class="form-label">Urutan</label>

                            <input
                                type="number"
                                name="urutan"
                                class="form-control"
                                value="{{ old('urutan', $slide->urutan ?? 0) }}">
                        </div>

                        {{-- STATUS --}}
                        <div class="form-check">
                            <input
                                type="checkbox"
                                name="aktif"
                                value="1"
                                class="form-check-input"
                                id="aktif{{ $slide->id }}"
                                @checked(old('aktif', $slide->aktif))>

                            <label
                                class="form-check-label"
                                for="aktif{{ $slide->id }}">
                                Aktif
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
                        <p class="mb-2">
                            Yakin ingin menghapus slide ini?
                        </p>

                        @if($slide->gambar)
                            <img
                                src="{{ asset('storage/' . $slide->gambar) }}"
                                alt="{{ $slide->judul ?? 'Gambar slide' }}"
                                style="width:120px;height:70px;object-fit:cover;border-radius:7px;">
                        @endif

                        <p class="mt-2 mb-0">
                            <strong>{{ $slide->judul ?? 'Tanpa judul' }}</strong>
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn-dark-custom"
                            data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-danger">
                            Hapus
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endforeach

{{-- PREVIEW GAMBAR BARU --}}
<script>
    function previewGambar(input, previewId) {
        const preview = document.getElementById(previewId);

        if (!preview) {
            return;
        }

        if (input.files && input.files[0]) {
            const file = input.files[0];

            if (!file.type.startsWith('image/')) {
                input.value = '';
                preview.src = '';
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
        } else {
            preview.removeAttribute('src');
            preview.style.display = 'none';
        }
    }
</script>

@endsection
