
@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible" id="success_message_div">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Success!</strong> {{ Session::get('success') }}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible" id="error_message_div">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Error!</strong> {{ Session::get('error') }}
    </div>
@endif

<script type="text/javascript">
    $(document).ready(function()
    {
        setTimeout(function()
        {
            $('#success_message_div').fadeOut(1000, function () 
            {
                $('#success_message_div').remove();
            });
        }, 10000);

        setTimeout(function()
        {
            $('#error_message_div').fadeOut(1000, function () 
            {
                $('#error_message_div').remove();
            });
        },10000);
    });
</script>