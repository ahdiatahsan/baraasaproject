@if (Auth::user()->hasAnyRole('super_administrator|administrator'))
<div class="d-flex justify-content-center">
  <div class="ms-4 ms-sm-2">
    <a class="btn btn-sm btn-icon btn-light-success btn-active-light-dark" data-bs-toggle="tooltip" title="Ubah"
      href="{{ route('participant.edit', $participant->id) }}">
      <span class="svg-icon svg-icon-5 m-0">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
            d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z"
            fill="black"></path>
          <path
            d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z"
            fill="black"></path>
          <path
            d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z"
            fill="black"></path>
        </svg>
      </span>
    </a>
  </div>

  <div class="ms-2">
    <a class="btn btn-sm btn-icon btn-light-danger btn-active-light-dark delete" data-bs-toggle="tooltip" title="Hapus"
      id="{{$participant->id}}">
      <span class="svg-icon svg-icon-5 m-0">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path
            d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
            fill="black" />
          <path opacity="0.5"
            d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
            fill="black" />
          <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
        </svg>
      </span>
    </a>
  </div>

  @if($participant->event->event_status == 0 && $participant->certificate == null)
  <div class="ms-2">
    <a href="#" class="btn btn-sm btn-icon btn-light-primary btn-active-light-dark" data-bs-toggle="modal"
      data-bs-target="#modal-certificate-{{ $participant->id }}">
      <span class="svg-icon svg-icon-5 m-0">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
          <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)"
            fill="black" />
          <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
        </svg>
      </span>
    </a>
  </div>
  @endif
</div>
@endif


{{-- Start::Modal Role --}}
<div class="modal fade" id="modal-certificate-{{ $participant->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered mw-650px">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Tambah Sertifikat</h2>
        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
          <span class="svg-icon svg-icon-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
              <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                fill="black" />
              <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
            </svg>
          </span>
        </div>
      </div>

      <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
        <form class="form" action="{{ route('participant.certificate', $participant->id) }}" method="POST"
          enctype="multipart/form-data" autocomplete="off">
          @csrf
          @method('PATCH')
          <div class="d-flex flex-column mb-7 fv-row">
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
              <span>Nama Peserta</span>
            </label>
            <input type="text" class="form-control form-control-solid" name="name"
              value="{{ $participant->user->name }}" readonly />
          </div>
          <div class="d-flex flex-column mb-7 fv-row">
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
              <span>Judul Acara</span>
            </label>
            <input type="text" class="form-control form-control-solid" name="title"
              value="{{ $participant->event->title }}" readonly />
          </div>
          <div class="d-flex flex-column fv-row">
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
              <span class="required">Sertifikat</span>
              <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                title="Ukuran maksimal sertifikat adalah 3MB."></i></label>
            <input class="form-control" type="file" name="certificate" required>
          </div>
          <div class="text-end pt-15">
            <button type="submit" class="btn btn-sm btn-primary">
              <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                    transform="rotate(-90 11.364 20.364)" fill="black" />
                  <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                </svg>
              </span>Tambah Sertifikat</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- End::Modal Role --}}