<x-dashboard.layout>
    {{-- Start::Head component --}}
    <x-slot name="title">Divisi</x-slot>
    {{-- End::Head component --}}

    {{-- Start::Toolbar component --}}
    <x-slot name="toolbar">
        <x-dashboard.toolbar.main>
            <x-slot name="title">Divisi</x-slot>

            <x-slot name="breadcrumb">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Pengguna</span>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Divisi</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Tambah Divisi</li>
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
        <form class="form" action="{{ route('division.store')}}" method="POST" autocomplete="off">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-title fs-3 fw-bolder">Tambah Divisi</div>
                    <div class="card-toolbar">
                        <a class="btn btn-sm btn-light-primary fw-bolder" href="{{ route('division.index') }}">
                            <i class="fa fa-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <label class="form-label required">Nama Divisi</label>
                        <input class="form-control" type="text" name="name" value="{{ old('name') }}" required
                            autofocus>
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
                        </span> Tambah Divisi</button>
                </div>
            </div>
        </form>
        {{-- End::Content --}}
    </x-slot>
    {{-- End::Post component --}}
</x-dashboard.layout>