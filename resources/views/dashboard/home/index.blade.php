<x-dashboard.layout>
    {{-- Start::Head component --}}
    <x-slot name="title">Beranda</x-slot>
    {{-- End::Head component --}}

    {{-- Start::Toolbar component --}}
    <x-slot name="toolbar">
        <x-dashboard.toolbar.main>
            <x-slot name="title">Beranda</x-slot>

            <x-slot name="breadcrumb">
            </x-slot>
        </x-dashboard.toolbar.main>
    </x-slot>
    {{-- End::Toolbar component --}}

    {{-- Start::Post component --}}
    <x-slot name="post">

    </x-slot>
    {{-- End::Post component --}}
</x-dashboard.layout>
