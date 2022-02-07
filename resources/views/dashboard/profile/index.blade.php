<x-dashboard.layout>
    {{-- Start::Head component --}}
    <x-slot name="title">Profil Saya</x-slot>

    <x-slot name="style">
        <link rel="stylesheet" href="{{ asset('plugins/custom/datatables/datatables.bundle.css')}} ">
    </x-slot>
    {{-- End::Head component --}}

    {{-- Start::Toolbar component --}}
    <x-slot name="toolbar">
        <x-dashboard.toolbar.main>
            <x-slot name="title">Profil</x-slot>

            <x-slot name="breadcrumb">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Pengguna</span>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Profil Saya</li>
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
        <div class="d-flex flex-column flex-lg-row">
            <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-5">
                <div class="card mb-5 mb-xl-8">
                    <div class="card-body">

                        <div class="d-flex flex-center flex-column py-5">
                            <div class="symbol symbol-100px symbol-circle border mb-7">
                                @if (Storage::exists('public/user/' . Auth::user()->photo))
                                <img alt="img" src="{{ Storage::url('public/user/' . Auth::user()->photo) }}" />
                                @else
                                <img alt="img" src="{{ asset('media/avatars/blank.png') }}" />
                                @endif
                            </div>
                            <span class="fs-3 text-gray-800 fw-bolder mb-3">{{ $user->name }}</span>
                            <div class="mb-9">
                                @if (Auth::user()->hasRole('super_administrator'))
                                <span class="badge badge-lg badge-light-primary d-inline">Super Administrator</span>
                                @elseif (Auth::user()->hasRole('administrator'))
                                <span class="badge badge-lg badge-light-success d-inline">Administrator</span>
                                @elseif (Auth::user()->hasRole('member'))
                                <span class="badge badge-lg badge-light-warning d-inline">Anggota</span>
                                @elseif (Auth::user()->hasRole('general'))
                                <span class="badge badge-lg badge-light-danger d-inline">Umum</span>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex flex-stack fs-4 py-3">
                            <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse"
                                href="#kt_user_view_details" role="button" aria-expanded="false"
                                aria-controls="kt_user_view_details">Rincian Pengguna
                                <span class="ms-2 rotate-180">
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                </span>
                            </div>
                        </div>

                        <div class="separator"></div>

                        <div id="kt_user_view_details" class="collapse show">
                            <div class="pb-5 fs-6">
                                <div class="fw-bolder mt-5">Email</div>
                                <div class="text-gray-600">{{ $user->email }}</div>

                                <div class="fw-bolder mt-5">Nomor Telepon</div>
                                <div class="text-gray-600">{{ $user->phone_number }}</div>

                                <div class="fw-bolder mt-5">Jenis Kelamin</div>
                                <div class="text-gray-600">
                                    @if ($user->gender == 'L')
                                    Laki-Laki
                                    @elseif ($user->gender == 'P')
                                    Perempuan
                                    @endif
                                </div>

                                <div class="fw-bolder mt-5">Tempat dan Tanggal Lahir</div>
                                <div class="text-gray-600">
                                    {{ $user->birthplace . ', ' . $date_of_birth->format('j F Y'); }}
                                </div>

                                <div class="fw-bolder mt-5">Alamat</div>
                                <div class="text-gray-600">{{ $user->address }}</div>

                                @if ($user->division_id != NULL)
                                <div class="fw-bolder mt-5">Divisi</div>
                                <div class="text-gray-600">{{ $user->division->name }}</div>

                                <div class="fw-bolder mt-5">Posisi</div>
                                <div class="text-gray-600">{{ $user->position->name }}</div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="separator separator-dashed mb-5"></div>

            <div class="flex-lg-row-fluid ms-lg-15">
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-6 fw-bold mb-8">
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                            href="#tab_aktivitas">Aktivitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                            href="#tab_sertifikat">Sertifikat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab"
                            href="#tab_profil">Ubah Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab"
                            href="#tab_keamanan">Keamanan</a>
                    </li>
                </ul>

                {{-- Start::Tab Content --}}
                <div class="tab-content" id="myTabContent">
                    {{-- Start::Tab Aktivitas --}}
                    <div class="tab-pane fade show active" id="tab_aktivitas" role="tabpanel">
                        <div class="card card-flush mb-6 mb-xl-9">
                            <div class="card-header mt-6">
                                <div class="card-title flex-column">
                                    <h2 class="mb-1">Aktivitas Pengguna</h2>
                                    <div class="fs-6 fw-bold text-muted">Jumlah aktivitas di
                                        aplikasi Bara Asa Project.</div>
                                </div>
                            </div>

                            <div class="card-body p-9 pt-4 ">
                                <div class="d-flex align-items-center bg-light-warning rounded p-5 mb-7">
                                    <span class="svg-icon svg-icon-warning me-5">
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M16.163 17.55C17.0515 16.6633 17.6785 15.5488 17.975 14.329C18.2389 13.1884 18.8119 12.1425 19.631 11.306L12.694 4.36902C11.8574 5.18796 10.8115 5.76088 9.67099 6.02502C8.15617 6.3947 6.81277 7.27001 5.86261 8.50635C4.91245 9.74268 4.41238 11.266 4.44501 12.825C4.46196 13.6211 4.31769 14.4125 4.0209 15.1515C3.72412 15.8905 3.28092 16.5617 2.71799 17.125L2.28699 17.556C2.10306 17.7402 1.99976 17.9897 1.99976 18.25C1.99976 18.5103 2.10306 18.7598 2.28699 18.944L5.06201 21.719C5.24614 21.9029 5.49575 22.0062 5.75601 22.0062C6.01627 22.0062 6.26588 21.9029 6.45001 21.719L6.88101 21.288C7.44427 20.725 8.11556 20.2819 8.85452 19.9851C9.59349 19.6883 10.3848 19.5441 11.181 19.561C12.1042 19.58 13.0217 19.4114 13.878 19.0658C14.7343 18.7201 15.5116 18.2046 16.163 17.55Z"
                                                    fill="black"></path>
                                                <path
                                                    d="M19.631 11.306L12.694 4.36902L14.775 2.28699C14.9591 2.10306 15.2087 1.99976 15.469 1.99976C15.7293 1.99976 15.9789 2.10306 16.163 2.28699L21.713 7.83704C21.8969 8.02117 22.0002 8.27075 22.0002 8.53101C22.0002 8.79126 21.8969 9.04085 21.713 9.22498L19.631 11.306ZM13.041 10.959C12.6427 10.5604 12.1194 10.3112 11.5589 10.2532C10.9985 10.1952 10.4352 10.332 9.96375 10.6405C9.4923 10.949 9.14148 11.4105 8.97034 11.9473C8.79919 12.4841 8.81813 13.0635 9.02399 13.588L2.98099 19.631L4.36899 21.019L10.412 14.975C10.9364 15.1816 11.5161 15.2011 12.0533 15.0303C12.5904 14.8594 13.0523 14.5086 13.361 14.037C13.6697 13.5654 13.8065 13.0018 13.7482 12.4412C13.6899 11.8805 13.4401 11.357 13.041 10.959Z"
                                                    fill="black"></path>
                                            </svg>
                                        </span>
                                    </span>
                                    <div class="flex-grow-1 me-2">
                                        <span href="#" class="fw-bolder text-gray-800 fs-6">Postingan
                                            Blog</span>
                                    </div>
                                    <span class="fw-bolder text-warning py-2 fs-3">{{ $counter['blog'] }}</span>
                                </div>

                                <div class="d-flex align-items-center bg-light-success rounded p-5 mb-7">
                                    <span class="svg-icon svg-icon-success me-5">
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M8 8C8 7.4 8.4 7 9 7H16V3C16 2.4 15.6 2 15 2H3C2.4 2 2 2.4 2 3V13C2 13.6 2.4 14 3 14H5V16.1C5 16.8 5.79999 17.1 6.29999 16.6L8 14.9V8Z"
                                                    fill="black"></path>
                                                <path
                                                    d="M22 8V18C22 18.6 21.6 19 21 19H19V21.1C19 21.8 18.2 22.1 17.7 21.6L15 18.9H9C8.4 18.9 8 18.5 8 17.9V7.90002C8 7.30002 8.4 6.90002 9 6.90002H21C21.6 7.00002 22 7.4 22 8ZM19 11C19 10.4 18.6 10 18 10H12C11.4 10 11 10.4 11 11C11 11.6 11.4 12 12 12H18C18.6 12 19 11.6 19 11ZM17 15C17 14.4 16.6 14 16 14H12C11.4 14 11 14.4 11 15C11 15.6 11.4 16 12 16H16C16.6 16 17 15.6 17 15Z"
                                                    fill="black"></path>
                                            </svg>
                                        </span>
                                    </span>
                                    <div class="flex-grow-1 me-2">
                                        <span class="fw-bolder text-gray-800 fs-6">Postingan
                                            Forum</span>
                                    </div>
                                    <span class="fw-bolder text-success py-2 fs-3">{{ $counter['thread'] }}</span>
                                </div>

                                <div class="d-flex align-items-center bg-light-danger rounded p-5 mb-7">
                                    <span class="svg-icon svg-icon-danger me-5">
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M21.7189 13.9C17.6189 9.8 11.4189 8.79999 6.21895 11.2L7.31895 12.9C11.719 11 16.919 12 20.319 15.4C20.519 15.6 20.819 15.7 21.019 15.7C21.219 15.7 21.5189 15.6 21.7189 15.4C22.1189 14.9 22.1189 14.2 21.7189 13.9Z"
                                                    fill="black"></path>
                                                <path opacity="0.3"
                                                    d="M10.119 17.1L3.61896 7L2.01895 14.3C1.91895 14.8 2.21895 15.4 2.81895 15.5L10.119 17.1Z"
                                                    fill="black"></path>
                                            </svg>
                                        </span>
                                    </span>
                                    <div class="flex-grow-1 me-2">
                                        <span class="fw-bolder text-gray-800 fs-6">Postingan
                                            Komentar</span>
                                    </div>
                                    <span class="fw-bolder text-danger py-2 fs-3">{{ $counter['comment'] }}</span>
                                </div>

                                <div class="d-flex align-items-center bg-light-info rounded p-5">
                                    <span class="svg-icon svg-icon-info me-5">
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                                    fill="black"></path>
                                                <path
                                                    d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                    fill="black"></path>
                                                <path
                                                    d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                                    fill="black"></path>
                                            </svg>
                                        </span>
                                    </span>
                                    <div class="flex-grow-1 me-2">
                                        <span class="fw-bolder text-gray-800 fs-6">Acara
                                            Terdaftar</span>
                                    </div>
                                    <span class="fw-bolder text-info py-2 fs-3">{{ $counter['participant'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End::Tab Aktivitas --}}

                    {{-- Start::Tab Sertifikat --}}
                    <div class="tab-pane fade" id="tab_sertifikat" role="tabpanel">
                        <div class="card card-flush mb-6 mb-xl-9">
                            <div class="card-header mt-6">
                                <div class="card-title flex-column">
                                    <h2 class="mb-1">Sertifikat</h2>
                                    <div class="fs-6 fw-bold text-muted">Sertifikat diberikan setelah
                                        mengikuti acara di Bara Asa Project.</div>
                                </div>
                            </div>

                            <div class="card-body p-9 pt-10">
                                <table id="datatable"
                                    class="table table-sm table-row-bordered gy-5 gs-8 border rounded no-footer nowrap dataTable">
                                    <thead>
                                        <tr class="border-gray-200 fw-bold bg-lighten fs-6 ">
                                            <th>No.</th>
                                            <th>Judul Acara</th>
                                            <th class="text-end"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- End::Tab Sertifikat --}}

                    {{-- Start::Tab Profil --}}
                    <div class="tab-pane fade" id="tab_profil" role="tabpanel">
                        <form class="form" action="{{ route('profile.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PATCH')

                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title fs-3 fw-bolder">Ubah Profil</div>
                                </div>
                                <div class="card-body">
                                    <div class="mb-7">
                                        <label class="form-label">Foto Profil</label>
                                        <input class="form-control" type="file" name="photo">
                                    </div>
                                    <div class="mb-6">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input class="form-control" type="text" name="name"
                                            value="{{ old('name', $user->name ?? '') }}" required>
                                    </div>
                                    <div class="mb-6">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <select class="form-select" name="gender" required>
                                            <option value="L" {{ $user->gender == 'L' ? 'selected' : '' }}>Laki-Laki
                                            </option>
                                            <option value="P" {{ $user->gender == 'P' ? 'selected' : '' }}>Perempuan
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-6">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input class="form-control" type="text" name="birthplace"
                                            value="{{ old('birthplace', $user->birthplace ?? '') }}" required>
                                    </div>
                                    <div class="mb-6">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input class="form-control flatpickr" type="text" name="date_of_birth"
                                            value="{{ old('date_of_birth', $date_of_birth ?? '') }}" required>
                                    </div>
                                    <div class="mb-6">
                                        <label class="form-label">Alamat</label>
                                        <input class="form-control" type="text" name="address"
                                            value="{{ old('address', $user->address ?? '') }}" required>
                                    </div>
                                    <div class="mb-6">
                                        <label class="form-label">Nomor Telepon</label>
                                        <input class="form-control" type="tel" name="phone_number"
                                            value="{{ old('phone_number', $user->phone_number ?? '') }}" required>
                                    </div>
                                    <div class="mb-6">
                                        <label class="form-label">Email</label>
                                        <input class="form-control" type="email" name="email"
                                            value="{{ old('email', $user->email ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end py-6">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
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
                                        </span>Ubah Profil</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- End::Tab Profil --}}

                    {{-- Start::Tab Keamanan --}}
                    <div class="tab-pane fade" id="tab_keamanan" role="tabpanel">
                        <form class="form" action="{{ route('profile.password', $user->id) }}" method="POST"
                            autocomplete="off">
                            @csrf
                            @method('PATCH')

                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title fs-3 fw-bolder">Keamanan</div>
                                </div>
                                <div class="card-body">
                                    <div class="mb-6">
                                        <label class="form-label">Password</label>
                                        <input class="form-control" type="password" name="password" required>
                                    </div>
                                    <div class="mb-6">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <input class="form-control" type="password" name="password_confirm" required>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end py-6">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
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
                                        </span>Ubah Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- End::Tab Keamanan --}}
                </div>
                {{-- End::Tab Content --}}
            </div>
            <!--end::Content-->
        </div>
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

        {{-- Start::Datatable --}}
        <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script>
            $(document).ready(function () {
                $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('profile.datatable') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'event.title',
                            name: 'event.title'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ],
                    columnDefs: [{
                            className: 'text-center',
                            targets: [0]
                        },
                        {
                            className: 'min-w-250px',
                            targets: [1]
                        },
                        {
                            className: 'text-center mw-100px',
                            orderable: false,
                            targets: [2]
                        }
                    ],
                    pagingType: "full_numbers",
                    "language": {
                        "search": "Cari:",
                        "emptyTable": "Tidak ada data yang tersedia pada tabel ini",
                        "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        "infoEmpty": "Tidak menampilkan data apapun",
                        "loadingRecords": "Memuat...",
                        "processing": "Memproses...",
                        "zeroRecords": "Tidak ada data yang cocok ditemukan",
                    },
                    dom: "<'table-responsive'tr>" +
        
                        "<'row'" +
                        "<'d-flex align-items-center justify-content-center'p>" +
                        ">"
                });
            });
        </script>
        {{-- End::Datatable --}}
    </x-slot>
    {{-- End::Javascript --}}
</x-dashboard.layout>