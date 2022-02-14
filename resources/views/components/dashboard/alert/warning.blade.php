@if ($message = Session::get('warning'))
<div class="alert alert-danger d-flex align-items-center p-5 mb-5">
    <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black" />
            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black" />
        </svg>
    </span>

    <div class="d-flex flex-column">
        <h4 class="mb-1 text-danger">Peringatan</h4>
        <span>
            {{ $message }}
        </span>
    </div>

    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
        data-bs-dismiss="alert">
        <i class="bi bi-x fs-1 text-danger"></i>
    </button>
</div>
@endif