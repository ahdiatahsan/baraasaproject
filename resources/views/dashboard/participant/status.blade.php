@if ($participant->data_status == 0)
<span class="badge badge-light-danger">Belum Diverifikasi</span>
@else
<span class="badge badge-light-success">Telah Diverifikasi</span>
@endif