<div class="d-flex align-items-stretch flex-shrink-0">
    <div class="d-flex align-items-stretch flex-shrink-0">
        <div class="d-flex align-items-center ms-lg-5" id="kt_header_user_menu_toggle">
            <div class="btn btn-active-light d-flex align-items-center bg-hover-light py-2 px-2 px-md-3"
                data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                <div class="d-none d-md-flex flex-column align-items-end justify-content-center me-2">
                    <span class="text-muted fs-7 fw-bold lh-1 mb-2">Halo,</span>
                    <span class="text-dark fs-base fw-bolder lh-1">{{ Auth::user()->name }}</span>
                </div>

                <div class="symbol symbol-30px symbol-md-40px">
                    @if (Storage::exists('public/user/' . Auth::user()->photo))
                    <img alt="img" src="{{ Storage::url('public/user/' . Auth::user()->photo) }}" />
                    @else
                    <img alt="img" src="{{ asset('media/avatars/blank.png') }}" />
                    @endif
                </div>
            </div>

            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                data-kt-menu="true">
                <div class="menu-item px-3">
                    <div class="menu-content d-flex align-items-center px-3">

                        <div class="symbol symbol-50px me-5">
                            @if (Storage::exists('public/user/' . Auth::user()->photo))
                            <img alt="img" src="{{ Storage::url('public/user/' . Auth::user()->photo) }}" />
                            @else
                            <img alt="img" src="{{ asset('media/avatars/blank.png') }}" />
                            @endif
                        </div>

                        <div class="d-flex flex-column">
                            <div class="fw-bolder d-flex align-items-center fs-7">{{ Auth::user()->name }}</div>
                            <a href="#" class="fw-bold text-muted text-hover-primary fs-7 my-2">{{ Auth::user()->email
                                }}</a>

                            @if (Auth::user()->hasRole('super_administrator'))
                            <span class="badge badge-light-primary fw-bolder fs-7">Super Administrator</span>
                            @elseif (Auth::user()->hasRole('administrator'))
                            <span class="badge badge-light-success fw-bolder fs-7">Administrator</span>
                            @elseif (Auth::user()->hasRole('member'))
                            <span class="badge badge-light-warning fw-bolder fs-7">Anggota</span>
                            @elseif (Auth::user()->hasRole('general'))
                            <span class="badge badge-light-danger fw-bolder fs-7">Umum</span>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="separator my-2"></div>

                <div class="menu-item px-5">
                    <a href="{{ route('profile.index', Auth::user()->id) }}" class="menu-link px-5">Profil Saya</a>
                </div>

                <div class="menu-item px-5">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a class="menu-link px-5" onclick="event.preventDefault(); this.closest('form').submit();">
                            Keluar
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>