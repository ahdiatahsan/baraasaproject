@if ($recruitment->interview_status == 0)
<span class="badge badge-light-danger">Tidak Lulus</span>
@else
<span class="badge badge-light-success">Lulus</span>
@endif