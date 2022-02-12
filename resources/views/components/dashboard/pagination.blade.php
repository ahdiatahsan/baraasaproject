@if ($paginator->hasPages())
<div class="d-flex flex-center mb-0">
    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
    {{-- Array Of Links --}}
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <a href="#" class="btn btn-icon btn-light btn-active-light-primary h-30px w-30px fw-bold fs-6 mx-2 active">{{
        $page }}</a>
    @else
    <a href="{{ $url }}" class="btn btn-icon btn-light btn-active-light-primary h-30px w-30px fw-bold fs-6 mx-2">{{
        $page }}</a>
    @endif
    @endforeach
    @endif
    @endforeach
</div>
@endif