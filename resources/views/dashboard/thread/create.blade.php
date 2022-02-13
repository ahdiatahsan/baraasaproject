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
                <li class="breadcrumb-item text-muted">Tambah Forum</li>
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
        <form class="form" action="{{ route('thread.store')}}" method="POST" autocomplete="off">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-title fs-3 fw-bolder">Tambah Forum</div>
                    <div class="card-toolbar">
                        <a class="btn btn-sm btn-light-primary fw-bolder" href="{{ route('thread.index') }}">
                            <i class="fa fa-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-6">
                        <label class="form-label required">Judul Forum</label>
                        <input class="form-control" type="text" name="title" value="{{ old('title') }}" required>
                    </div>
                    <div class="mb-7">
                        <label class="form-label">Status Publikasi</label>
                        @if (Auth::user()->hasAnyRole('super_administrator|administrator'))
                        <select class="form-select" name="publication_status" required>
                            <option value="0">Belum Terbit</option>
                            <option value="1" selected>Telah Terbit</option>
                        </select>
                        @else
                        <select class="form-select" required disabled>
                            <option value="1" selected>Telah Terbit</option>
                        </select>
                        <input class="form-control" type="text" name="publication_status" value="1" required hidden>
                        @endif
                    </div>
                    <div>
                        <label class="form-label required">Deskripsi Pertanyaan</label>
                        <textarea class="form-control" name="body" id="body" rows="10">{{ old('body') }}</textarea>
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
                        </span>Tambah Forum</button>
                </div>
            </div>
        </form>
        {{-- End::Content --}}
    </x-slot>
    {{-- End::Post component --}}
</x-dashboard.layout>