<!DOCTYPE html>
<html lang="id">

<head>
    {{-- Start::Meta slot --}}
    <x-dashboard.head.meta />
    {{ $meta ?? null }}
    {{-- End::Meta slot --}}

    <title>Bara Asa Project | {{ $title }}</title>

    {{-- Start::Style slot --}}
    <x-dashboard.head.style />
    {{ $style ?? null }}
    {{-- End::Style slot --}}
</head>


<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-enabled">

    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-column flex-column-fluid">
            <!--Start::Header-->
            <div id="kt_header" class="header align-items-stretch">
                <div class="container-xxl d-flex align-items-stretch justify-content-between">
                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 w-lg-225px me-5">
                        <div class="btn btn-icon btn-active-icon-primary ms-n2 me-2 d-flex d-lg-none" id="kt_aside_toggle">
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                                    <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                                </svg>
                            </span>
                        </div>
                        <a href="{{ route('home') }}">
                            <img alt="Logo" src="{{ asset('media/logos/headerlogo.png') }}" class="d-none d-lg-inline h-60px" />
                            <img alt="Logo" src="{{ asset('media/logos/headerlogo.png') }}" class="d-lg-none h-25px" />
                        </a>
                    </div>

                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                        <div class="d-flex align-items-stretch" id="kt_header_nav">
                        </div>

                        <x-dashboard.navbar.profile />
                    </div>
                </div>
            </div>
            <!--End::Content-->

            <!--Start::Content Container-->
            <div id="kt_content_container" class="d-flex flex-column-fluid align-items-stretch container-xxl ">
                <!--Start::Aside-->
                <x-dashboard.aside.list />
                <!--End::Aside-->

                <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
                    <!--Start::Content-->
                    <div class="content flex-column-fluid" id="kt_content">
                        {{-- Start::Toolbar slot --}}
                        {{ $toolbar }}
                        {{-- End::Toolbar slot --}}

                        <div class="post" id="kt_post">
                            {{-- Start::Content slot --}}
                            {{ $post }}
                            {{-- End::Content slot --}}
                        </div>
                    </div>
                    <!--End::Content-->

                    <!--Start::Footer-->
                    <x-dashboard.footer />
                    <!--End::Footer-->
                </div>
            </div>
            <!--End::Content Container-->
        </div>
    </div>

    <!--Start::Scrolltop-->
    <x-dashboard.scrolltop />
    <!--Start::Scrolltop-->

    {{-- Start::Javascript component --}}
    <x-dashboard.script />
    {{ $javascript ?? null }}
    {{-- End::Javascript component --}}
</body>

</html>
