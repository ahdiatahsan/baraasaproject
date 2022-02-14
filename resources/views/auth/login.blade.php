<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>Login | Bara Asa Project</title>
    <meta charset="utf-8" />
    <meta name="description" content="Platform Non-Profit Untuk Pengembangan Diri Anak Muda Di Kota Palu" />
    <meta name="keywords"
        content="Bara Asa Project, self-development, anak muda, kota palu, sulawesi tengah, soft-skill" />
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
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <a href="#" class="mb-12">
                    <img alt="Logo" src="{{ asset('media/logos/authlogo.png') }}" class="h-100px" />
                </a>
                <!--end::Logo-->
                <!--begin::Wrapper-->
                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form class="form w-100" method="POST" action="{{ route('login') }}" novalidate="novalidate"
                        id="kt_sign_in_form">
                        @csrf
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid" type="email" name="email"
                                autocomplete="off" tabindex="1" />
                            @error('email')
                            <small class="text-danger font-weight-bold"><strong>{{ $message }}</strong></small>
                            @enderror
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack mb-2">
                                <!--begin::Label-->
                                <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                                <!--end::Label-->
                                <!--begin::Link-->
                                <a href="auth/password-reset.html"
                                    class="text-gray-600 text-hover-dark fs-6 fw-bolder">Lupa Password ?</a>
                                <!--end::Link-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                name="password" autocomplete="off" tabindex="2" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group=-->
                        <div class="fv-row mb-10">
                            <div class="form-check form-check-danger form-check-solid form-check-inline">
                                <input class="form-check-input" type="checkbox" name="remember" tabindex="3" />
                                <label class="form-check-label fw-bold text-dark fs-6">Ingat Saya</label>
                            </div>
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <!--begin::Submit button-->
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-color-white w-100"
                                style="background-color: #f7a052!important;">
                                <span class="indicator-label">Masuk</span>
                            </button>
                            <!--end::Submit button-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Authentication - Sign-in-->
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