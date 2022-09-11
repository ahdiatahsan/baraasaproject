<x-dashboard.layout>
    {{-- Start::Head component --}}
    <x-slot name="title">Jurnal</x-slot>
    {{-- End::Head component --}}

    {{-- Start::Toolbar component --}}
    <x-slot name="toolbar">
        <x-dashboard.toolbar.main>
            <x-slot name="title">Jurnal</x-slot>

            <x-slot name="breadcrumb">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Postingan</span>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Jurnal</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Tambah Jurnal</li>
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
        <form class="form" action="{{ route('research.store')}}" method="POST" autocomplete="off"
            enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-title fs-3 fw-bolder">Tambah Jurnal</div>
                    <div class="card-toolbar">
                        <a class="btn btn-sm btn-light-primary fw-bolder" href="{{ route('research.index') }}">
                            <i class="fa fa-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-6">
                        <label class="form-label required">Judul Jurnal</label>
                        <input class="form-control" type="text" name="title" value="{{ old('title') }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label required">Tanggal Terbit</label>
                        <input class="form-control flatpickr" type="text" name="date_of_publish"
                            value="{{ old('date_of_publish') }}" required>
                    </div>
                    <div>
                        <label class="form-label">
                            <span class="required">Berkas Jurnal</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                title="Ukuran maksimal jurnal adalah 3MB."></i></label>
                        <input class="form-control" type="file" name="file" required>
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
                        </span>Tambah Jurnal</button>
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