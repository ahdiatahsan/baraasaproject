<x-dashboard.layout>
    {{-- Start::Head component --}}
    <x-slot name="title">Acara</x-slot>
    {{-- End::Head component --}}

    {{-- Start::Toolbar component --}}
    <x-slot name="toolbar">
        <x-dashboard.toolbar.main>
            <x-slot name="title">Acara</x-slot>

            <x-slot name="breadcrumb">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Aktivitas</span>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Acara</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Tambah Peserta</li>
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
        <form class="form" action="{{ route('participant.store')}}" method="POST" autocomplete="off"
            enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-title fs-3 fw-bolder">Tambah Peserta</div>
                    <div class="card-toolbar">
                        <a class="btn btn-sm btn-light-primary fw-bolder"
                            href="{{ route('event.show', $eventGet->id) }}">
                            <i class="fa fa-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-6">
                        <label class="form-label required">Judul Acara</label>
                        <input class="form-control" type="text" name="event_id" value="{{ $eventGet->id }}" required
                            hidden>
                        <input class="form-control" type="text" name="event_name" value="{{ $eventGet->title }}"
                            required readonly>
                    </div>
                    <div class="mb-6">
                        <label class="form-label required">Nama Peserta</label>
                        <select class="form-select" name="user_id" id="select2User"
                            data-placeholder="Cari Nama Lengkap Pengguna" data-allow-clear="true" required>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label required">Alasan Mengikuti Acara</label>
                        <textarea class="form-control" name="body" id="body" rows="10"></textarea>
                    </div>
                    <div class="mb-7">
                        <label class="form-label">
                            <span class="required">Berkas</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                title="Masukkan berkas yang sesuai dan maksimal berukuran 3MB"></i></label>
                        <input class="form-control" type="file" name="file" required>
                    </div>
                    <div>
                        <label class="form-label required">Status Berkas</label>
                        <select class="form-select" name="publication_status" required>
                            <option value="0">Belum Diverifikasi</option>
                            <option value="1">Telah Diverifikasi</option>
                        </select>
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
                        </span> Tambah Peserta</button>
                </div>
            </div>
        </form>
        {{-- End::Content --}}
    </x-slot>
    {{-- End::Post component --}}

    {{-- Start::Javascript --}}
    <x-slot name="javascript">
        {{-- Start::Select2 --}}
        <script>
            $('#select2User').select2({
                language: {
                    noResults: function () {
                        return "Data Tidak ditemukan";
                    },
                    inputTooShort: function () {
                        return 'Masukkan minimal 1 huruf';
                    },
                },
                ajax: {
                    url: '{{ route("event.select2-user") }}',
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
        </script>
        {{-- Start::Select2 --}}
    </x-slot>
    {{-- End::Post component --}}
</x-dashboard.layout>