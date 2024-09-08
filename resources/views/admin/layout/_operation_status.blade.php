@if (Session::has('flash_notification.message'))

<!--     <div class="alert alert-{{ Session::get('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ Session::get('flash_notification.message') }} -->

    <div class="alert alert-{{ Session::get('flash_notification.level') }} alert-dismissible">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span></button>
       {{ Session::get('flash_notification.message') }}
    </div>
@endif