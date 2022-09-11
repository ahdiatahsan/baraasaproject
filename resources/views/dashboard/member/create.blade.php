<x-dashboard.layout>
    {{-- Start::Head component --}}
    <x-slot name="title">Anggota</x-slot>
    {{-- End::Head component --}}

    {{-- Start::Toolbar component --}}
    <x-slot name="toolbar">
        <x-dashboard.toolbar.main>
            <x-slot name="title">Anggota</x-slot>

            <x-slot name="breadcrumb">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Pengguna</span>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Anggota</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Tambah Anggota</li>
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
        <form class="form" action="{{ route('member.store')}}" method="POST" autocomplete="off"
            enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-title fs-3 fw-bolder">Tambah Anggota</div>
                    <div class="card-toolbar">
                        <a class="btn btn-sm btn-light-primary fw-bolder" href="{{ route('member.index') }}">
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
                    <div class="mb-6">
                        <label class="form-label required">Divisi</label>
                        <select class="form-select" name="division_id" id="select2Division"
                            data-placeholder="Cari Nama Divisi" data-allow-clear="true" required>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label required">Posisi</label>
                        <select class="form-select" name="position_id" id="select2Position"
                            data-placeholder="Cari Nama Posisi" data-allow-clear="true" required>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label required">Hak Akses</label>
                        <select class="form-select" name="role" required>
                            @if (Auth::user()->hasRole('super_administrator'))
                            <option value="member">Anggota</option>
                            <option value="administrator">Administrator</option>
                            @else
                            <option value="member">Anggota</option>
                            @endif
                        </select>
                    </div>
                    <div>
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
                        </span>Tambah Anggota</button>
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

        {{-- Start::Select2 --}}
        <script>
            $('#select2Division').select2({
                language: {
                    noResults: function () {
                        return "Data Tidak ditemukan";
                    },
                    inputTooShort: function () {
                        return 'Masukkan minimal 1 huruf';
                    },
                },
                ajax: {
                    url: '{{ route("member.select2-division") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        }
                    },
                    cache: true
                },
                minimumInputLength: 1
            });
        
            $('#select2Division').change(function () {
                $('#select2Position').empty();
                let divisionID = $(this).val();
                if (divisionID) {
                    $('#select2Position').select2({
                        language: {
                            noResults: function () {
                                return "Data Tidak ditemukan";
                            },
                            inputTooShort: function () {
                                return 'Masukkan minimal 1 huruf';
                            },
                        },
                        ajax: {
                            url: "{{ route('member.select2-position') }}?divisionID=" + divisionID,
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    q: $.trim(params.term)
                                };
                            },
                            processResults: function (data) {
                                return {
                                    results: $.map(data, function (item) {
                                        return {
                                            text: item.name,
                                            id: item.id
                                        }
                                    })
                                }
                            },
                            cache: true
                        },
                        minimumInputLength: 1
                    });
                } else {
                    $('#select2Position').empty();
                }
            });
        
            $('#select2Division').on('select2:clear', function (e) {
                $("#select2Position").select2();
            });
        </script>
        {{-- End::Select2 --}}
    </x-slot>
    {{-- End::Javascript --}}
</x-dashboard.layout>