<x-dashboard.layout>
    {{-- Start::Head component --}}
    <x-slot name="title">Divisi</x-slot>

    <x-slot name="style">
        <link rel="stylesheet" href="{{ asset('plugins/custom/datatables/datatables.bundle.css')}} ">
    </x-slot>
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
                <li class="breadcrumb-item text-muted">Rincian Divisi</li>
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
        <!--begin::Form-->
        <form class="form py-6">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card header-->
                    <div class="card-title fs-3 fw-bolder">Rincian Divisi</div>
                    <div class="card-toolbar">
                        <a class="btn btn-sm btn-light-primary fw-bolder" href="{{ route('division.index') }}">
                            <i class="fa fa-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                    <!--end::Card header-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body">
                    <div>
                        <span class="svg-icon svg-icon-danger svg-icon-4 me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.3"
                                    d="M11 20.8129C11 21.4129 10.5 21.9129 9.89999 21.8129C5.49999 21.2129 2 17.5128 2 12.9128C2 8.31283 5.39999 4.51281 9.89999 4.01281C10.5 3.91281 11 4.41281 11 5.01281V20.8129Z"
                                    fill="black"></path>
                                <path
                                    d="M13 18.8129C13 19.4129 13.5 19.9129 14.1 19.8129C18.5 19.2129 22 15.5128 22 10.9128C22 6.31283 18.6 2.51281 14.1 2.01281C13.5 1.91281 13 2.41281 13 3.01281V18.8129Z"
                                    fill="black"></path>
                            </svg>
                        </span>
                        <span class="text-gray-900 fs-5 fw-bold">{{ $division->name }}</span>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </form>
        <!--end:Form-->
        <!--end::Alert-->
        <!--begin::Home card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title fs-3 fw-bolder">Daftar Posisi Pada Divisi</div>
                <div class="card-toolbar">
                    <a class="btn btn-sm btn-light-primary" data-bs-toggle="tooltip" title="Tambah Posisi Pada Divisi"
                        href="{{ route('division.position', $division->id) }}">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                    transform="rotate(-90 11.364 20.364)" fill="black" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                            </svg>
                        </span>
                        Tambah Posisi Pada Divisi
                    </a>
                </div>
            </div>
            <!--end::Card header-->
            <!--begin::Body-->
            <div class="card-body p-lg-8">
                <!--begin::Datatable-->
                <table id="datatable"
                    class="table table-sm table-row-bordered gy-5 gs-8 border rounded no-footer nowrap dataTable">
                    <thead>
                        <tr class="border-gray-200 fw-bold bg-lighten fs-6 ">
                            <th>No.</th>
                            <th>Nama Posisi</th>
                            <th class="text-end"></th>
                        </tr>
                    </thead>
                </table>
                <!--end::Datatable-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Home card-->
        {{-- End::Content --}}
    </x-slot>
    {{-- End::Post component --}}

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
                        var url = '{{ route("position.destroy", ":position") }}';
                        url = url.replace(':position', id);
        
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

        {{-- Start::Datatable --}}
        <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script>
            $(document).ready(function () {
                $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('division.show', $division->id) }}",
                    columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    }, {
                        data: 'name',
                        name: 'name'
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
                        targets: [2]
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
        {{-- End::Datatable --}}
    </x-slot>
    {{-- End::Javascript --}}
</x-dashboard.layout>