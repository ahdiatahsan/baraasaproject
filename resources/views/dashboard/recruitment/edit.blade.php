<x-dashboard.layout>
    {{-- Start::Head component --}}
    <x-slot name="title">Perekrutan</x-slot>
    {{-- End::Head component --}}

    {{-- Start::Toolbar component --}}
    <x-slot name="toolbar">
        <x-dashboard.toolbar.main>
            <x-slot name="title">Perekrutan</x-slot>

            <x-slot name="breadcrumb">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Kegiatan</span>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Perekrutan</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Ubah Pendaftar Perekrutan</li>
            </x-slot>
        </x-dashboard.toolbar.main>
    </x-slot>
    {{-- End::Toolbar component --}}

    {{-- Start::Post component --}}
    <x-slot name="post">
        {{-- Start::Alert component --}}
        <x-dashboard.alert.success />
        <x-dashboard.alert.error />
        {{-- End::Alert Component --}}

        {{-- Start::Content --}}
        <form class="form" action="{{ route('recruitment.update', $recruitment->id) }}" method="POST" autocomplete="off"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="card">
                <div class="card-header">
                    <div class="card-title fs-3 fw-bolder">Ubah Pendaftar Perekrutan</div>
                    <div class="card-toolbar">
                        <a class="btn btn-sm btn-light-primary fw-bolder" href="{{ route('recruitment.index') }}">
                            <i class="fa fa-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input class="form-control" type="text" name="user_id" value="{{ $recruitment->user_id }}"
                            required hidden>
                        <input class="form-control" type="text" name="recruit_name"
                            value="{{ $recruitment->user->name }}" required readonly>
                    </div>
                    <div class="mb-7">
                        <label class="form-label">
                            <span>Berkas</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                title="Masukkan berkas yang sesuai dan maksimal berukuran 3MB."></i></label>
                        <input class="form-control" type="file" name="file">
                    </div>
                    <div class="mb-6">
                        <label class="form-label">Status Berkas</label>
                        <select class="form-select" name="document_status" required>
                            <option value="0" {{ $recruitment->document_status == 0 ? 'selected' : '' }}>Belum
                                Diverifikasi
                            </option>
                            <option value="1" {{ $recruitment->document_status == 1 ? 'selected' : '' }}>Telah
                                Diverifikasi
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Status Interview</label>
                        <select class="form-select" name="interview_status" required>
                            <option value="0" {{ $recruitment->interview_status == 0 ? 'selected' : '' }}>Tidak Lulus
                            </option>
                            <option value="1" {{ $recruitment->interview_status == 1 ? 'selected' : '' }}>Lulus</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6">
                    <button type="submit" class="btn btn-sm btn-success">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z"
                                    fill="black"></path>
                                <path
                                    d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z"
                                    fill="black"></path>
                                <path
                                    d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z"
                                    fill="black"></path>
                            </svg>
                        </span>Ubah Pendaftar</button>
                </div>
            </div>
        </form>
        {{-- End::Content --}}
    </x-slot>
    {{-- End::Post component --}}
</x-dashboard.layout>