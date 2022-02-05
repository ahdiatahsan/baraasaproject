<div class="dropdown">
  <button class="btn btn-sm btn-icon btn-light-dark" type="button" id="{{ $division->id }}" data-bs-toggle="dropdown">
    <span class="svg-icon svg-icon-4 m-0">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <rect x="10" y="10" width="4" height="4" rx="2" fill="black"></rect>
        <rect x="17" y="10" width="4" height="4" rx="2" fill="black"></rect>
        <rect x="3" y="10" width="4" height="4" rx="2" fill="black"></rect>
      </svg>
    </span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="{{ $division->id }}">
    <li><a class="dropdown-item py-2 text-dark" href="{{ route('division.show', $division->id) }}">Rincian</a></li>
    <li><a class="dropdown-item py-2 text-dark" href="{{ route('division.edit', $division->id) }}">Ubah</a></li>
    <div class="separator"></div>
    <li><a style="cursor: pointer;" class="dropdown-item text-danger py-2 delete" id="{{$division->id}}">Hapus</a></li>
  </ul>
</div>