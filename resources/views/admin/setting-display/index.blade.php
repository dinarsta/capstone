@extends('layouts.admin')

@section('title', 'Setting Display')

@section('content')

<div class="content-card">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <div class="page-title">Setting Display</div>
            <small class="text-secondary">
                Pengaturan layar display
            </small>
        </div>

        <button class="btn-orange"
                data-bs-toggle="modal"
                data-bs-target="#tambahSetting">
            + Tambah Setting
        </button>

    </div>

    <table class="table-custom">

        <thead>

            <tr>
                <th>Nama Setting</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>

        </thead>

        <tbody>

        @forelse($settings as $setting)

            <tr>

                <td>{{ $setting->nama_setting }}</td>

                <td>{{ $setting->nilai }}</td>

                <td>

                    <button class="btn-dark-custom"
                            data-bs-toggle="modal"
                            data-bs-target="#editSetting{{ $setting->id }}">
                        Ubah
                    </button>

                    <button class="btn-dark-custom"
                            data-bs-toggle="modal"
                            data-bs-target="#hapusSetting{{ $setting->id }}">
                        Hapus
                    </button>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="3"
                    class="text-center text-secondary py-4">
                    Belum ada setting.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>


{{-- TAMBAH --}}

<div class="modal fade" id="tambahSetting" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.setting-display.store') }}"
                  method="POST">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Setting
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Setting
                        </label>

                        <input type="text"
                               name="nama_setting"
                               class="form-control"
                               required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Nilai
                        </label>

                        <textarea name="nilai"
                                  class="form-control"
                                  rows="3"></textarea>

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


@foreach($settings as $setting)

<div class="modal fade"
     id="editSetting{{ $setting->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.setting-display.update', $setting) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-header">

                    <h5 class="modal-title">
                        Ubah Setting
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Setting
                        </label>

                        <input type="text"
                               name="nama_setting"
                               class="form-control"
                               value="{{ $setting->nama_setting }}"
                               required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Nilai
                        </label>

                        <textarea name="nilai"
                                  class="form-control"
                                  rows="3">{{ $setting->nilai }}</textarea>

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
     id="hapusSetting{{ $setting->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.setting-display.destroy', $setting) }}"
                  method="POST">

                @csrf
                @method('DELETE')

                <div class="modal-header">

                    <h5 class="modal-title">
                        Hapus Setting
                    </h5>

                </div>

                <div class="modal-body">

                    Yakin ingin menghapus
                    <strong>{{ $setting->nama_setting }}</strong>?

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