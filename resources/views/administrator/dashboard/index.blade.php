<x-administrator.layout>
    {{-- Start::Head component --}}
    <x-slot name="title">Pengaturan</x-slot>
    {{-- End::Head component --}}

    {{-- Start::Toolbar component --}}
    <x-slot name="toolbar">
        <x-administrator.toolbar.main>
            <x-slot name="title">Dasbor</x-slot>

            <x-slot name="breadcrumb">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Dasbor</span>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Beranda</li>
            </x-slot>
        </x-administrator.toolbar.main>
    </x-slot>
    {{-- End::Toolbar component --}}

    {{-- Start::Post component --}}
    <x-slot name="post">

    </x-slot>
    {{-- End::Post component --}}
</x-administrator.layout>
