@if ($blog->publication_status == 0)
<span class="badge badge-light-danger">Belum Terbit</span>
@else
<span class="badge badge-light-success">Telah Terbit</span>
@endif