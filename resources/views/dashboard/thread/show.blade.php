<x-dashboard.layout>
    {{-- Start::Head component --}}
    <x-slot name="title">Forum</x-slot>
    {{-- End::Head component --}}

    {{-- Start::Toolbar component --}}
    <x-slot name="toolbar">
        <x-dashboard.toolbar.main>
            <x-slot name="title">Forum</x-slot>

            <x-slot name="breadcrumb">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Postingan</span>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Forum</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Rincian Forum</li>
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
        <!--begin::Question-->
        <div class="separator separator-dashed border-gray-300 mt-8 mb-10"></div>
        <div class="mb-0">
            <div class="d-flex align-items-center mb-9">
                <h1 class="fs-2x fw-bolder text-gray-900 mb-0 me-1">{{ $thread->title }}</h1>
            </div>
            <div class="fs-4 fw-normal text-gray-800 mb-10">
                {!! $thread->body !!}
            </div>
            <div class="d-flex flex-stack flex-wrap">
                <div class="d-flex align-items-center py-1 mb-2">
                    <div class="symbol symbol-35px me-4">
                        <div class="symbol-label bg-light-warning fs-3 fw-bold text-warning text-uppercase">
                            {{ $thread->user->name[0] }}
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-start justify-content-center me-9">
                        <span class="text-gray-800 fs-7 fw-bold lh-1 mb-2">{{ $thread->user->name }}</span>
                        <span class="text-muted fs-8 fw-bold lh-1">{{ $date_posted }}</span>
                    </div>
                    <div class="d-flex flex-column align-items-start justify-content-center me-6">
                        <a href="#"
                            class="btn btn-sm btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary px-4 me-2">
                            <span class="svg-icon svg-icon-primary svg-icon-2 me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M21.7189 13.9C17.6189 9.8 11.4189 8.79999 6.21895 11.2L7.31895 12.9C11.719 11 16.919 12 20.319 15.4C20.519 15.6 20.819 15.7 21.019 15.7C21.219 15.7 21.5189 15.6 21.7189 15.4C22.1189 14.9 22.1189 14.2 21.7189 13.9Z"
                                        fill="black"></path>
                                    <path opacity="0.3"
                                        d="M10.119 17.1L3.61896 7L2.01895 14.3C1.91895 14.8 2.21895 15.4 2.81895 15.5L10.119 17.1Z"
                                        fill="black"></path>
                                </svg>
                            </span> {{ $totalComments }} Komentar
                        </a>
                    </div>
                    @if ($thread->publication_status == 1)
                    <div class="d-flex flex-column align-items-start justify-content-center">
                        <a href="#"
                            class="btn btn-sm btn-outline btn-outline-dashed btn-outline-success btn-active-light-success px-4 me-2">
                            <span class="svg-icon svg-icon-success svg-icon-2 me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                    <path
                                        d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                        fill="black"></path>
                                </svg>
                            </span> Telah Terbit
                        </a>
                    </div>
                    @else
                    <div class="d-flex flex-column align-items-start justify-content-center">
                        <a href="#"
                            class="btn btn-sm btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger px-4 me-2">
                            <span class="svg-icon svg-icon-danger svg-icon-2 me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path opacity="0.3"
                                        d="M12 10.6L14.8 7.8C15.2 7.4 15.8 7.4 16.2 7.8C16.6 8.2 16.6 8.80002 16.2 9.20002L13.4 12L12 10.6ZM10.6 12L7.8 14.8C7.4 15.2 7.4 15.8 7.8 16.2C8 16.4 8.3 16.5 8.5 16.5C8.7 16.5 8.99999 16.4 9.19999 16.2L12 13.4L10.6 12Z"
                                        fill="black" />
                                    <path
                                        d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM13.4 12L16.2 9.20001C16.6 8.80001 16.6 8.19999 16.2 7.79999C15.8 7.39999 15.2 7.39999 14.8 7.79999L12 10.6L9.2 7.79999C8.8 7.39999 8.2 7.39999 7.8 7.79999C7.4 8.19999 7.4 8.80001 7.8 9.20001L10.6 12L7.8 14.8C7.4 15.2 7.4 15.8 7.8 16.2C8 16.4 8.3 16.5 8.5 16.5C8.7 16.5 9 16.4 9.2 16.2L12 13.4L14.8 16.2C15 16.4 15.3 16.5 15.5 16.5C15.7 16.5 16 16.4 16.2 16.2C16.6 15.8 16.6 15.2 16.2 14.8L13.4 12Z"
                                        fill="black" />
                                </svg>
                            </span> Belum Terbit
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="mt-8 mb-10"></div>
        <form id="kt_devs_reply_form" class="form mb-10" action="{{ route('thread.comment') }}" method="POST"
            autocomplete="off">
            @csrf
            <div class="form-group mb-2">
                <input class="form-control" type="text" name="thread_id" value="{{ $thread->id }}" hidden>
                <textarea name="body" class="form-control" rows="4" placeholder="Tulis komentarmu disini.."
                    maxlength="1000" data-kt-autosize="true"
                    style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 150px;" required></textarea>
            </div>
            <div class="d-flex align-items-center justify-content-between py-2 mb-5">
                <div class="text-primary fs-base fw-bold cursor-pointer"></div>
                <button class="btn btn-sm btn-primary fw-bolder" data-kt-action="submit">
                    <span class="svg-icon svg-icon-success svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                transform="rotate(-90 11.364 20.364)" fill="black" />
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                        </svg></span> Tambah Komentar
                </button>
            </div>
        </form>
        <a id="answers" data-kt-scroll-offset="{default: 100, lg: 125}"></a>
        <h2 class="fw-bolder text-gray-900 mb-10">Komentar ({{$totalComments}})</h2>
        <div class="mb-10">
            @foreach($comments as $comment)
            <div class="border rounded p-2 p-lg-6 mb-10">
                <div class="mb-0">
                    <div class="d-flex flex-stack flex-wrap mb-5">
                        <div class="d-flex align-items-center py-1">
                            <div class="symbol symbol-35px me-4">
                                <div class="symbol-label bg-light-warning fs-3 fw-bold text-warning text-uppercase">
                                    {{ $thread->user->name[0] }}
                                </div>
                            </div>
                            <div class="d-flex flex-column align-items-start justify-content-center">
                                <span class="text-gray-800 fs-7 fw-bold lh-1 mb-2">{{ $comment->user->name }}</span>
                                <span class="text-muted fs-8 fw-bold lh-1">
                                    {{
                                    Carbon\Carbon::parse($comment->created_at)->locale('id')->settings(['formatFunction'
                                    => 'translatedFormat'])->format('l, j F Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center py-1">
                            @if ($comment->user_id == Auth::user()->id)
                            <a href="{{ route('comment.edit', $comment->id) }}"
                                class="btn btn-sm btn-flex btn-light-success btn-active-light me-2">
                                <span class="svg-icon svg-icon-success svg-icon-2"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z"
                                            fill="black" />
                                        <path
                                            d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z"
                                            fill="black" />
                                        <path
                                            d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z"
                                            fill="black" />
                                    </svg></span> Ubah</a>
                            @endif
                            @if ($comment->user_id == Auth::user()->id ||
                            Auth::user()->hasAnyRole('super_administrator|administrator'))
                            <a id="{{$comment->id}}"
                                class="btn btn-sm btn-flex btn-light-danger btn-active-light me-1 delete">
                                <span class="svg-icon svg-icon-danger svg-icon-2"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                            fill="black" />
                                        <path opacity="0.5"
                                            d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                            fill="black" />
                                        <path opacity="0.5"
                                            d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                            fill="black" />
                                    </svg></span> Hapus</a>
                            @endif
                        </div>
                    </div>
                    <div class="fs-5 fw-normal text-gray-800">{!! $comment->body !!}</div>
                </div>
            </div>
            @endforeach
        </div>
        {{ $comments->links('components.dashboard.pagination') }}
    </x-slot>
    {{-- End::Post component --}

    {{-- Start::Javascript --}}
    <x-slot name="javascript">
        {{-- Start::Sweetalert2 --}}
        <script>
            $(document).on('click', '.delete', function () {
                var id = $(this).attr('id');
                swal.fire({
                    title: "Hapus data ini?",
                    text: "Data yang terhapus tidak dapat dikembalikan.",
                    icon: "warning",
                    showCloseButton: true,
                    confirmButtonColor: '#f1416c',
                    confirmButtonText: 'Ya, Hapus!'
                }).then(function (result) {
                    if (result.value) {
                        var url = '{{ route("comment.destroy", ":comment") }}';
                        url = url.replace(':comment', id);
        
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: url,
                            type: 'POST',
                            datatype: 'json',
                            data: {
                                "_method": 'DELETE',
                            },
                            success: function (data) {
                                setTimeout(function () {
                                    location.reload()
                                }, 1500);
                            },
                            complete: function () {
                                swal.hideLoading();
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                swal.hideLoading();
                                swal.fire("!Maaf ", "Terjadi kesalahan", "error");
                            }
                        });
                    }
                });
            });
        </script>
        {{-- End::Sweetalert2 --}}
    </x-slot>
    {{-- End::Javascript --}}
</x-dashboard.layout>