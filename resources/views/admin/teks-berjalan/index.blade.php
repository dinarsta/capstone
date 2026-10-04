@extends('layouts.admin')

@section('title', 'Teks Berjalan')

@section('content')

<div class="content-card">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <div class="page-title">Teks Berjalan</div>
            <small class="text-secondary">
                Informasi yang tampil pada display
            </small>
        </div>

        <button class="btn-orange"
                data-bs-toggle="modal"
                data-bs-target="#tambahTeks">
            + Tambah Teks
        </button>

    </div>

    <div class="table-responsive">

        <table class="table-custom">

            <thead>
                <tr>
                    <th>Teks</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($teksBerjalans as $teks)

                <tr>

                    <td>{{ $teks->teks }}</td>

                    <td>

                        @if($teks->aktif)

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
                                data-bs-target="#editTeks{{ $teks->id }}">
                            Ubah
                        </button>

                        <button class="btn-dark-custom"
                                data-bs-toggle="modal"
                                data-bs-target="#hapusTeks{{ $teks->id }}">
                            Hapus
                        </button>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="3"
                        class="text-center text-secondary py-4">
                        Belum ada teks.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- TAMBAH --}}

<div class="modal fade" id="tambahTeks" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.teks-berjalan.store') }}"
                  method="POST">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Teks
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Teks
                        </label>

                        <textarea name="teks"
                                  class="form-control"
                                  rows="4"
                                  required></textarea>

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


@foreach($teksBerjalans as $teks)

<div class="modal fade"
     id="editTeks{{ $teks->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.teks-berjalan.update', $teks) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-header">

                    <h5 class="modal-title">
                        Ubah Teks
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Teks
                        </label>

                        <textarea name="teks"
                                  class="form-control"
                                  rows="4"
                                  required>{{ $teks->teks }}</textarea>

                    </div>

                    <div class="form-check">

                        <input type="checkbox"
                               name="aktif"
                               value="1"
                               class="form-check-input"
                               @checked($teks->aktif)>

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


<div class="modal fade"
     id="hapusTeks{{ $teks->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.teks-berjalan.destroy', $teks) }}"
                  method="POST">

                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title">
                        Hapus Teks
                    </h5>
                </div>

                <div class="modal-body">
                    Yakin ingin menghapus teks ini?
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