<x-dashboard.layout>
    {{-- Start::Head component --}}
    <x-slot name="title">Acara</x-slot>

    <x-slot name="style">
        <link rel="stylesheet" href="{{ asset('plugins/custom/datatables/datatables.bundle.css')}} ">
    </x-slot>
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
                <li class="breadcrumb-item text-muted">Rincian Acara</li>
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
        <div class="card mb-6">
            <div class="card-header">
                <div class="card-title fs-3 fw-bolder">Rincian Acara</div>
                <div class="card-toolbar">
                    <a class="btn btn-sm btn-light-primary fw-bolder" href="{{ route('event.index') }}">
                        <i class="fa fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <div class="card-body pt-5 pb-5">
                <div class="d-flex flex-wrap flex-sm-nowrap">
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-4">
                                    <span class="text-gray-900 fs-3 fw-bolder me-1">{{ $event->title }}</span>
                                </div>
                                <div class="d-flex flex-wrap fw-bold fs-6 pe-2">
                                    <span class="d-flex align-items-center text-gray-500 me-5 mb-2">
                                        <span class="svg-icon svg-icon-danger svg-icon-4 me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                                    fill="black" />
                                                <path
                                                    d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                    fill="black" />
                                                <path
                                                    d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                                    fill="black" />
                                            </svg>
                                        </span> {{ $date_event }}
                                    </span>

                                    <span class="d-flex align-items-center text-gray-500 me-5 mb-2">
                                        <span class="svg-icon svg-icon-primary svg-icon-4 me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M17.5 7.89998L14.8 14.8L13.4 13.3999C14.2 12.5999 14.2 11.4001 13.4 10.6001C12.6 9.80006 11.4 9.80006 10.6 10.6001L9.20001 9.19991L16.1 6.49996C17 6.19996 17.8 6.99998 17.5 7.89998ZM12.7 11.3C12.3 10.9 11.7 10.9 11.3 11.3C10.9 11.7 10.9 12.2999 11.3 12.6999C11.7 13.0999 12.3 13.0999 12.7 12.6999C13.1 12.2999 13.1 11.7 12.7 11.3Z"
                                                    fill="black" />
                                                <path opacity="0.3"
                                                    d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM16.1 6.5L9.20001 9.19995L6.5 16.1001C6.2 17.0001 6.99999 17.8 7.89999 17.5L14.8 14.8L17.5 7.90002C17.8 7.00002 17 6.2 16.1 6.5Z"
                                                    fill="black" />
                                            </svg>
                                        </span> {{ $event->location }}
                                    </span>

                                    <span class="d-flex align-items-center text-gray-500 me-5 mb-2">
                                        <span class="svg-icon svg-icon-success svg-icon-4 me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10"
                                                    fill="black" />
                                                <rect x="11" y="17" width="7" height="2" rx="1"
                                                    transform="rotate(-90 11 17)" fill="black" />
                                                <rect x="11" y="9" width="2" height="2" rx="1"
                                                    transform="rotate(-90 11 9)" fill="black" />
                                            </svg>
                                        </span>
                                        @if ($event->event_status == 1)
                                        Berlangsung
                                        @else
                                        Terlaksana
                                        @endif
                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-title fs-3 fw-bolder">Daftar Peserta Acara</div>
                <div class="card-toolbar">
                    @if (Auth::user()->hasAnyRole('super_administrator|administrator'))
                    <a class="btn btn-sm btn-light-primary" data-bs-toggle="tooltip" title="Tambah Peserta"
                        href="{{ route('event.participant', $event->id) }}">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                    transform="rotate(-90 11.364 20.364)" fill="black" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                            </svg>
                        </span>
                        Tambah Peserta
                    </a>
                    @endif
                </div>
            </div>

            <div class="card-body p-lg-8">
                <table id="datatable"
                    class="table table-sm table-row-bordered gy-5 gs-8 border rounded no-footer nowrap dataTable">
                    <thead>
                        <tr class="border-gray-200 fw-bold bg-lighten fs-6 ">
                            <th>No.</th>
                            <th>Nama Peserta</th>
                            <th>Status Berkas</th>
                            <th>Status Sertifikat</th>
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
                        var url = '{{ route("participant.destroy", ":participant") }}';
                        url = url.replace(':participant', id);
        
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
                    ajax: "{{ route('event.show', $event->id) }}",
                    columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    }, {
                        data: 'user.name',
                        name: 'user.name'
                    }, {
                        data: 'status',
                        name: 'status'
                    }, {
                        data: 'certificate',
                        name: 'certificate'
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