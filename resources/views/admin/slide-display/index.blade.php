@extends('layouts.admin')

@section('title', 'Slide Display')

@section('content')

<div class="content-card">

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

                        <img src="{{ asset('storage/'.$slide->gambar) }}"
                             style="width:100px;height:55px;object-fit:cover;border-radius:7px;">

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

                        <button class="btn-dark-custom"
                                data-bs-toggle="modal"
                                data-bs-target="#editSlide{{ $slide->id }}">
                            Ubah
                        </button>

                        <button class="btn-dark-custom"
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


{{-- TAMBAH --}}

<div class="modal fade" id="tambahSlide" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.slide-display.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Slide
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Judul
                        </label>

                        <input type="text"
                               name="judul"
                               class="form-control">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Gambar
                        </label>

                        <input type="file"
                               name="gambar"
                               class="form-control"
                               accept="image/*"
                               required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Urutan
                        </label>

                        <input type="number"
                               name="urutan"
                               class="form-control"
                               value="0">

                    </div>

                    <div class="form-check">

                        <input type="checkbox"
                               name="aktif"
                               value="1"
                               class="form-check-input"
                               checked>

                        <label class="form-check-label">
                            Aktif
                        </label>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn-dark-custom"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn-orange">
                        Tambah
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


@foreach($slides as $slide)

{{-- EDIT --}}

<div class="modal fade"
     id="editSlide{{ $slide->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.slide-display.update', $slide) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="modal-header">

                    <h5 class="modal-title">
                        Ubah Slide
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Judul
                        </label>

                        <input type="text"
                               name="judul"
                               class="form-control"
                               value="{{ $slide->judul }}">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Ganti Gambar
                        </label>

                        <input type="file"
                               name="gambar"
                               class="form-control"
                               accept="image/*">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Urutan
                        </label>

                        <input type="number"
                               name="urutan"
                               class="form-control"
                               value="{{ $slide->urutan }}">

                    </div>

                    <div class="form-check">

                        <input type="checkbox"
                               name="aktif"
                               value="1"
                               class="form-check-input"
                               @checked($slide->aktif)>

                        <label class="form-check-label">
                            Aktif
                        </label>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn-dark-custom"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn-orange">
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- DELETE --}}

<div class="modal fade"
     id="hapusSlide{{ $slide->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.slide-display.destroy', $slide) }}"
                  method="POST">

                @csrf
                @method('DELETE')

                <div class="modal-header">

                    <h5 class="modal-title">
                        Hapus Slide
                    </h5>

                </div>

                <div class="modal-body">

                    Yakin ingin menghapus slide ini?

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn-dark-custom"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn btn-danger">
                        Hapus
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endforeach

@endsection