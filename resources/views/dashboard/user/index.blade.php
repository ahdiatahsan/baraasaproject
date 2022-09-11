<x-dashboard.layout>
    {{-- Start::Head component --}}
    <x-slot name="title">Administrator</x-slot>

    <x-slot name="style">
        <link rel="stylesheet" href="{{ asset('plugins/custom/datatables/datatables.bundle.css')}} ">
    </x-slot>
    {{-- End::Head component --}}

    {{-- Start::Toolbar component --}}
    <x-slot name="toolbar">
        <x-dashboard.toolbar.main>
            <x-slot name="title">Administrator</x-slot>

            <x-slot name="breadcrumb">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Pengaturan</span>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Administrator</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Beranda</li>
            </x-slot>
        </x-dashboard.toolbar.main>
    </x-slot>
    {{-- End::Toolbar component --}}

    {{-- Start::Post component --}}
    <x-slot name="post">
        {{-- Start::Alert component --}}
        <x-dashboard.alert.success />
        <x-dashboard.alert.warning />
        <x-dashboard.alert.error />
        {{-- End::Alert Component --}}

        {{-- Start::Content --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title fs-3 fw-bolder">Daftar Administrator</div>
                <div class="card-toolbar">
                    <a class="btn btn-sm btn-light-primary" data-bs-toggle="tooltip" title="Tambah Administrator"
                        href="{{ route('administrator.create') }}">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                    transform="rotate(-90 11.364 20.364)" fill="black" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                            </svg>
                        </span>
                        Tambah Administrator
                    </a>
                </div>
            </div>

            <div class="card-body p-lg-8">
                <table id="datatable"
                    class="table table-sm table-row-bordered gy-5 gs-8 border rounded no-footer nowrap dataTable">
                    <thead>
                        <tr class="border-gray-200 fw-bold bg-lighten fs-6 ">
                            <th>No.</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Hak Akses</th>
                            <th class="text-end"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        {{-- End::Content --}}
    </x-slot>
    {{-- End::Post component --}}

    {{-- Start::Javascript --}}
    <x-slot name="javascript">
        {{-- Start::Datatable --}}
        <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script>
            $(document).ready(function () {
                $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('administrator.datatable') }}",
                    columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    }, {
                        data: 'name',
                        name: 'name'
                    }, {
                        data: 'email',
                        name: 'email'
                    }, {
                        data: 'role',
                        name: 'role'
                    }, {
                        data: 'action',
                        name: 'action'
                    }],
                    columnDefs: [{
                        className: 'text-center',
                        targets: [0]
                    }, {
                        className: 'text-center mw-100px',
                        orderable: false,
                        targets: [4]
                    }],
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
                    dom: "<'row'" +
                        "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                        "<'col-sm-6 d-flex align-items-center justify-content-end z-0'f>" +
                        ">" +
        
                        "<'table-responsive'tr>" +
        
                        "<'row'" +
                        "<'col-sm-6 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                        "<'col-sm-6 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                        ">"
                });
            });
        </script>
        {{-- Start::Datatable --}}
    </x-slot>
    {{-- End::Javascript --}}
</x-dashboard.layout>