@extends('front.layout.master')
@section('main_content')
<div class="blank-div"></div>
<div class="page-wrapper">
    <div class="container">
         <div class="white-wrapper reset-password">
                <h2>Reset Password</h2>

                <!-- Login Status Starts -->
                <div class="alert alert-success" id="reset_password_success" style="display: none;">
                    <strong>Success!</strong> <span id="reset_password_success_msg"></span>
                </div>
                
                <div class="alert alert-danger" id="reset_password_error" style="display: none;">
                    <strong>Error!</strong> <span id="reset_password_error_msg"></span>
                </div>
                <!-- Login Status Ends -->

                <form name="frm_reset_password" id="frm_reset_password" method="post" action="{{url('/')}}/reset_password">
                {{csrf_field()}}
                    <div class="form-group">
                        <label class="form-label">New Password<i class="red">*</i></label>
                        <input type="password" name="new_password" id="new_password" placeholder="Enter New Password"/>
                        <div class="error" id="err_new_password"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm Password<i class="red">*</i></label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password"/>
                        <div class="error" id="err_confirm_password"></div>
                    </div>
                    <input type="hidden" name="enc_id" value="{{$enc_id}}">
                    <input type="hidden" name="enc_reminder_code" value="{{$enc_reminder_code}}">
                   <button type="button" class="green-btn full-width" id="btn_reset_password">Submit</button>
                   <div class="clearfix"></div>
                </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#btn_reset_password').click(function(){
        var new_password     = $('#new_password').val();
        var confirm_password = $('#confirm_password').val();

        if($.trim(new_password) == '')
        {
            $('#new_password').focus();
            $('#err_new_password').show();
            $('#err_new_password').html('Please enter new password.');
            $('#err_new_password').fadeOut(4000);
            return false;
        }
        else if($.trim(new_password).length < 6)
        {
            $('#new_password').focus();
            $('#err_new_password').show();
            $('#err_new_password').html('For better security, use a password 6 characters long.');
            $('#err_new_password').fadeOut(4000);
            return false;
        }
        else if($.trim(confirm_password) == '')
        {
            $('#confirm_password').focus();
            $('#err_confirm_password').show();
            $('#err_confirm_password').html('Please enter confirm password.');
            $('#err_confirm_password').fadeOut(4000);
            return false;
        } 
        else if(new_password!=confirm_password)
        {
            $('#confirm_password').focus();
            $('#err_confirm_password').show();
            $('#err_confirm_password').html('Please enter confirm password same as new password.');
            $('#err_confirm_password').fadeOut(4000);
            return false;
        } 
        else
        {
            var form = $('#frm_reset_password')[0];
            var formData = new FormData(form);
            $.ajax({
                url         : '{{ url('/') }}/reset_password',
                type        : 'post',
                data        : formData,
                processData : false,
                contentType : false,
                cache       : false,
                beforeSend : showProcessingOverlay(),
                success     : function (res)
                {
                    hideProcessingOverlay();
                    if(res.status == 'success')
                    {
                        $('#frm_reset_password')[0].reset();

                        $("#reset_password_success_msg").html(res.msg);
                        $("#reset_password_success").css('display','block').delay(4000).fadeOut();
                    }
                    else
                    {
                        location.reload();
                    }
                }
            });
        }

    });
</script>
@endsection