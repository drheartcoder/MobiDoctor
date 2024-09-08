@extends('front.patient.layout.master')
@section('main_content')
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                 @include('front.patient.layout._leftbar')
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                @include('front.layout._operation_status')
                <div class="white-wrapper prescription-wrapper">
                    <h2>Send Us Your Feedback</h2>
                    <form name="frm_feedback" id="frm_feedback" method="post" action="{{$module_url_path}}/completed/{{$enc_id}}/feedback_review/store">
                        {{csrf_field()}}
                        <div class="prescription-section">
                            <div class="feedback-wrapper">
                                <h4>Your feedback is important to us -</h4>
                                <p>It's because of this kind of feedback that doctoroo continues to be improved by our team &amp; loved by our members.</p>
                                <div class="rating-block">
                                     <input id="rates" class="star required" type="radio" name="rating" value="{{isset($arr_rating['rating'])?$arr_rating['rating']:'0'}}"/>
                                     <div class="error" id="err_rates"></div>
                                </div>
                                <div class="form-group">
                                    <textarea id="message" name="feedback" placeholder="Enter your feedback" rows="6">{{isset($arr_rating['feedback'])?$arr_rating['feedback']:''}}</textarea>
                                    <div class="error" id="err_message"></div>
                                </div>
                                <input type="hidden" name="rates" id="given_rates">
                                <input type="hidden" name="enc_id" value="{{$enc_id}}">
                                <button type="button" id="btn_send_feedback" class="green-btn">Feedback</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('common.rating')

<script type="text/javascript">
    $('#btn_send_feedback').click(function()
    {
        var rates = $('#rates').val();
        var message = $('#message').val();

        $('#given_rates').val(rates);

        if($.trim(rates) != '' && $.trim(rates) == '0')
        {
            $('#rates').focus();
            $('#err_rates').show();
            $('#err_rates').html('Please give ratings.');
            $('#err_rates').fadeOut(4000);
            return false;
        }  
        else if($.trim(message) == '')
        {
            $('#message').focus();
            $('#err_message').show();
            $('#err_message').html('Please enter message');
            $('#err_message').fadeOut(4000);
            return false;
        }   
        else
        {
            var form = $('#frm_feedback')[0];
            var formData = new FormData(form);
            $.ajax({
                url         : '{{ $module_url_path }}/completed/{{$enc_id}}/feedback_review/store',
                type        : 'post',
                data        : formData,
                processData : false,
                contentType : false,
                cache       : false,
                beforeSend  : showProcessingOverlay(),
                success     : function (res)
                {
                    hideProcessingOverlay();
                    location.reload();
                }
            });
        }

    });
</script>
@endsection