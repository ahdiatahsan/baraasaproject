<x-dashboard.layout>
    {{-- Start::Head component --}}
    <x-slot name="title">Umum</x-slot>
    {{-- End::Head component --}}

    {{-- Start::Toolbar component --}}
    <x-slot name="toolbar">
        <x-dashboard.toolbar.main>
            <x-slot name="title">Umum</x-slot>

            <x-slot name="breadcrumb">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Pengguna</span>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Umum</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Tambah Pengguna Umum</li>
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
        <form class="form" action="{{ route('general.store')}}" method="POST" autocomplete="off"
            enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-title fs-3 fw-bolder">Tambah Pengguna Umum</div>
                    <div class="card-toolbar">
                        <a class="btn btn-sm btn-light-primary fw-bolder" href="{{ route('general.index') }}">
                            <i class="fa fa-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-6">
                        <label class="form-label required">Nama Lengkap</label>
                        <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label required">Jenis Kelamin</label>
                        <select class="form-select" name="gender" required>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label required">Tempat Lahir</label>
                        <input class="form-control" type="text" name="birthplace" value="{{ old('birthplace') }}"
                            required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label required">Tanggal Lahir</label>
                        <input class="form-control flatpickr" type="text" name="date_of_birth"
                            value="{{ old('date_of_birth') }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label required">Alamat</label>
                        <input class="form-control" type="text" name="address" value="{{ old('address') }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label required">Nomor Telepon</label>
                        <input class="form-control" type="tel" name="phone_number" value="{{ old('phone_number') }}"
                            required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label required">Email</label>
                        <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label required">Password</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label required">Konfirmasi Password</label>
                        <input class="form-control" type="password" name="password_confirm" required>
                    </div>
                    <div class="mb-7">
                        <label class="form-label">
                            <span class="required">Foto Profil</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                title="Ukuran maksimal foto profil adalah 2MB."></i></label>
                        <input class="form-control" type="file" name="photo" required>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                    transform="rotate(-90 11.364 20.364)" fill="black" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                            </svg>
                        </span>Tambah Pengguna Umum</button>
                </div>
            </div>
        </form>
        {{-- End::Content --}}
    </x-slot>
    {{-- End::Post component --}}

    {{-- Start::Javascript --}}
    <x-slot name="javascript">
        {{-- Start::Flatpickr --}}
        <script src="{{ asset('js/flatpickr/id.js') }}"></script>
        <script>
            $(".flatpickr").flatpickr({
                altInput: true,
                locale: "id",
                altFormat: "d F Y",
            });
        </script>
        {{-- End::Flatpickr --}}
    </x-slot>
    {{-- End::Javascript --}}
</x-dashboard.layout>