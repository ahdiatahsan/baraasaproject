<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>Reset Password | Bara Asa Project</title>
    <meta charset="utf-8" />
    <meta name="description" content="Platform Non-Profit Untuk Pengembangan Diri Anak Muda Di Kota Palu" />
    <meta name="keywords" content="Bara Asa Project, self-development, anak muda, kota palu, sulawesi tengah, soft-skill" />
    <meta name="viewport" content="width= device-width, initial-scale=1, shrink-to-fit=no" />
    <meta property="og:locale" content="id, in" />
    <meta property="og:site_name" content="Bara Asa Project" />
    <link rel="shortcut icon" href="{{ asset('media/logos/baraasa.png') }}" />
    <!--begin::Fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - New password -->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <a href="#" class="mb-12">
                    <img alt="Logo" src="{{ asset('media/logos/authlogo.png') }}" class="h-100px" />
                </a>
                <!--end::Logo-->
                <!--begin::Wrapper-->
                <div class="w-lg-550px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form class="form w-100" method="POST" action="{{ route('password.update') }}" novalidate="novalidate" id="kt_new_password_form">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h2 class="text-dark mb-3">Buat Password Baru</h2>
                            <!--end::Title-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <label class="form-label fw-bolder text-dark fs-6">Email</label>
                            <input class="form-control form-control-solid" type="email" name="email" value="{{ old('email', $request->email )}}" autocomplete="off" autofocus readonly />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10 fv-row" data-kt-password-meter="true">
                            <!--begin::Wrapper-->
                            <div class="mb-1">
                                <!--begin::Label-->
                                <label class="form-label fw-bolder text-dark fs-6">Password</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password" autocomplete="off" />
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                        <i class="bi bi-eye-slash fs-2"></i>
                                        <i class="bi bi-eye fs-2 d-none"></i>
                                    </span>
                                </div>
                                <!--end::Input wrapper-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Input group=-->
                        <div class="fv-row mb-10">
                            <label class="form-label fw-bolder text-dark fs-6">Konfirmasi Password</label>
                            <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password_confirmation" autocomplete="off" />
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Actions-->
                        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                            <button type="button" id="kt_new_password_submit" class="btn btn-lg btn-color-white me-4" style="background-color: #f7a052!important;">
                                <span class="indicator-label">Simpan</span>
                            </button>
                            <a href="{{ route('login') }}" class="btn btn-lg btn-secondary btn-active-light-dark fw-bolder">Kembali</a>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Authentication - New password-->
    </div>
    <!--end::Main-->
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
