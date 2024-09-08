@extends('front.doctor.layout.master')
@section('main_content')

<link href="{{ url('/') }}/public/fullcalendar/css/fullcalendar.css" rel="stylesheet" />
<link href="{{ url('/') }}/public/fullcalendar/css/fullcalendar.print.css" rel='stylesheet' media='print' />

<script src="{{ url('/') }}/public/fullcalendar/lib/moment.js"></script>
<script src="{{ url('/') }}/public/fullcalendar/lib/jquery.js"></script>
<script src="{{ url('/') }}/public/fullcalendar/js/fullcalendar.js"></script>

<style type="text/css">
    .advance-option-wrapp input
    {
        position: initial !important;
        width: unset;
        height: unset;
        left: 0 !important;
        visibility: visible !important;
    }
</style>

<div class="page-wrapper">
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-md-3 col-lg-3">
                 
                @if($is_pause == "1")
                  <a onclick="confirm_action(this,event,'Do you really want to resume new consultation?')" href="{{ $module_url_path.'/resume' }}" class="btn btn-danger pause-new-btn">Pause</a>
                @else
                  <a onclick="confirm_action(this,event,'Pre-booked consultations will not be canceled!     Do you really want to pause new consultation ?')" href="{{ $module_url_path.'/pause'}}" class="btn btn-success pause-new-btn">Resume</a>
                @endif

                <div class="clearfix"></div>

                <div id="small_datepicker"></div>
                <input type="hidden" id="selectedDate">
                <br/>

                @include('front.doctor.layout._leftbar')

            </div>

            <div class="col-sm-8 col-md-9 col-lg-9">                
                <a href="#availability_modal" id="btn_open_availability_modal" data-backdrop="static" data-keyboard="false" data-toggle="modal" class="green-trans-btn" style="display: none;">Add Availability</a>

                <div id='calendar'></div>
            </div>

        </div>
    </div>
</div>

<!--availability modal start-->
    <div class="modal fade availability-modal" id="availability_modal" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
              
                <button type="button" class="close close_btn" data-dismiss="modal">
                    <img src="{{ url('/') }}/public/front/images/close.png" class="img-responsive" alt=""/>
                </button>

                <div class="modal-body">
                    <h4>Availability Session</h4>

                    <div class="Availability-form">
                        
                        <!-- Status Starts -->
                        <div class="alert alert-success" id="availability_success" style="display: none;">
                            <strong>Success!</strong> <span id="availability_success_msg"></span>
                        </div>
                        
                        <div class="alert alert-danger" id="availability_error" style="display: none;">
                            <strong>Error!</strong> <span id="availability_error_msg"></span>
                        </div>
                        <!-- Status Ends -->

                        <div class="form-group">
                            <input type="hidden" id="event_id" name="event_id" value="" />
                        </div>

                        <div class="form-group date-picker-w">
                            <input type="text" class="date-input" id="start_date" name="start_date" placeholder="Start Date" readonly />
                        </div>
                        
                        <div class="form-group date-picker-w">
                            <input type="text" class="date-input" id="end_date" name="end_date" placeholder="End Date" readonly />
                        </div>
                        
                        <div class="form-group time-picker-w">
                            <input type="text" id="start_time" name="start_time" placeholder="Available From" readonly />
                        </div>
                        
                        <div class="form-group time-picker-w">
                            <input type="text" id="end_time" name="end_time" placeholder="Available To" readonly />
                        </div>

                        <!-------------------------------- Advance Options Starts -------------------------------->

                        <div class="form-group advance-option-wrapp" id="advance_option" style="display: none;margin-bottom: 0;">
                            <input type="checkbox" name="for_selected_days" value="yes" id="for_selected_days">
                            <label class="lable-font-size" for="for_selected_days">For Select Days</label>
                        </div>

                        <div class="form-group advance-option-wrapp" id="days_block" style="display: none;">
                            <div class="days-name modal-fields" id="days_block">
                                <span class="week-day-bx">
                                    <input class="selected_day" name="day" type="checkbox" value="Sunday" id="sun" />
                                    <label for="sun"><span>Sun</span></label>
                                </span>
                                 <span class="week-day-bx">
                                    <input class="selected_day" name="day" type="checkbox" value="Monday" id="mon" />
                                    <label for="mon"><span>Mon</span></label>
                                </span>
                                <span class="week-day-bx">
                                    <input class="selected_day" name="day" type="checkbox" value="Tuesday" id="tue" />
                                    <label for="tue"><span>Tue</span></label>
                                </span>
                                <span class="week-day-bx">
                                    <input class="selected_day" name="day" type="checkbox" value="Wednesday" id="wed" />
                                    <label for="wed"><span>Wed</span></label>
                                </span>
                                <span class="week-day-bx">
                                    <input class="selected_day" name="day" type="checkbox" value="Thursday" id="thu" />
                                    <label for="thu"><span>Thu</span></label>
                                </span>
                                <span class="week-day-bx">
                                    <input class="selected_day" name="day" type="checkbox" value="Friday" id="fri" />
                                    <label for="fri"><span>Fri</span></label>
                                </span>
                                  <span class="week-day-bx">
                                    <input class="selected_day" name="day" type="checkbox" value="Saturday" id="sat" />
                                    <label for="sat"><span>Sat</span></label>
                                </span>
                                <div class="form-group" id="err_week_days" style="color:red;font-size:12px;"></div>
                            </div>
                        </div>

                        <!-------------------------------- Advance Options Ends -------------------------------->

                        <div class="form-group" id="err_datetime" style="color:red;font-size:12px;"></div>
                        
                        {{-- <button class="green-btn close_btn" data-dismiss="modal" id="btn_cancel" style="display: none;">Cancel</button> --}}
                        <button class="green-btn " id="btn_add" style="display: none;">Add</button>
                        <button class="green-btn for-inline-btn" id="btn_update" style="display: none;">Update</button>
                        <button class="green-btn for-inline-btn" id="btn_delete" style="display: none;">Delete</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
<!--availability modal end-->

<!--datepicker start-->
<script type="text/javascript" src="{{ url('/') }}/public/front/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/front/css/bootstrap-datepicker.min.css"/>
<!--datepicker end-->

<!--timepicker start-->
<script type="text/javascript" src="{{ url('/') }}/public/front/js/bootstrap-timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/front/css/timepicker.css"/>
<!--timepicker end-->

<script type="text/javascript">
    $(document).ready(function()
    {
        $(document).keydown(function(event) 
        { 
            if (event.keyCode == 27)
            {
                $('#btn_cancel').click();
            }
        });

        $('#selectedDate').val( moment().toDate() );
        var token = "{{ csrf_token() }}";

        /*----------------timepicker starts----------------*/
        $('#start_time, #end_time').timepicker({
            format : 'hh:mm A',
        });
        /*----------------timepicker ends----------------*/


        /*----------------datepicker starts----------------*/
        $('#small_datepicker').datepicker({
            todayHighlight : true,
            todayBtn       : true,
        });
        
        $("#start_date, #end_date").datepicker({
            format         : 'dd-mm-yyyy',
            autoclose      : true,
            todayHighlight : true,
            todayBtn       : true,
        });
        /*----------------datepicker ends----------------*/
        

        /*----------------calendar starts----------------*/
        var calendar;
        var events = '';

        $.ajax({
            url  :"{{ $module_url_path }}/available_dates",
            type :'get',
            success:function(data)
            {
                if(data)
                {
                    events = JSON.parse(data);

                    calendar = $('#calendar').fullCalendar({

                        header : {
                            left   : 'prev,today',
                            center : 'title',
                            right  : 'today,next'
                        },

                        /*footer : {
                            left   : 'prevYear,prev,today',
                            center : 'title',
                            right  : 'today,next,nextYear'
                        },*/

                        buttonText : {
                            today    : 'Today',
                        },

                        defaultDate  : $('#selectedDate').val(), // by default start date
                        defaultView  : 'agendaWeek', // by default view
                        navLinks     : false,
                        selectable   : true,
                        selectHelper : true,
                        editable     : true,
                        eventLimit   : false,
                        loading      : true,
                        events       : events,
                        selectMinDistance: 1,

                        eventClick : function( event, element )
                        {
                            $("#event_id").val(event.id);

                            /*----------Start Date & Time----------*/
                            var start_js_datetime = event.start.format('DD-MM-YYYY+hh:mm A');
                            var split_start_js_datetime = start_js_datetime.split('+');
                            var start_js_date = split_start_js_datetime[0];
                            var start_js_time = split_start_js_datetime[1];

                            $("#start_date").datepicker({}).datepicker("setDate", start_js_date);
                            $('#start_time').timepicker({}).timepicker("setTime", start_js_time);

                            /*----------End Date & Time----------*/
                            var end_js_datetime   = event.end.format('DD-MM-YYYY+hh:mm A');
                            var split_end_js_datetime = end_js_datetime.split('+');
                            var end_js_date = split_end_js_datetime[0];
                            var end_js_time = split_end_js_datetime[1];

                            $("#end_date").datepicker({}).datepicker("setDate", end_js_date);
                            $('#end_time').timepicker({}).timepicker("setTime", end_js_time);

                            $("#btn_open_availability_modal")[0].click();
                            $("#btn_cancel").css('display','inline-block');
                            $("#btn_update").css('display','inline-block');
                            $("#btn_delete").css('display','inline-block');
                            $("#btn_add").css('display','none');

                            $("#start_date").attr("disabled", 'disabled');
                            $("#end_date").attr("disabled", 'disabled');

                            advance_option();
                        },

                        select : function( start, end )
                        {
                            /*----------Start Date & Time----------*/
                            var start_js_datetime = start.format('DD-MM-YYYY+hh:mm A');
                            var split_start_js_datetime = start_js_datetime.split('+');
                            var start_js_date = split_start_js_datetime[0];
                            var start_js_time = split_start_js_datetime[1];

                            $("#start_date").datepicker({}).datepicker("setDate", start_js_date);
                            $('#start_time').timepicker({}).timepicker("setTime", start_js_time);;

                            /*----------End Date & Time----------*/
                            var end_js_datetime = end.format('DD-MM-YYYY+hh:mm A');
                            var split_end_js_datetime = end_js_datetime.split('+');
                            var end_js_date = split_end_js_datetime[0];
                            var end_js_time = split_end_js_datetime[1];

                            $("#end_date").datepicker({}).datepicker("setDate", end_js_date);
                            $('#end_time').timepicker({}).timepicker("setTime", end_js_time);;

                            $("#btn_open_availability_modal")[0].click();
                            $("#btn_cancel").css('display','block');
                            $("#btn_add").css('display','block');
                            $("#btn_update").css('display','none');
                            $("#btn_delete").css('display','none');

                            advance_option();
                        },

                        eventDrop : function( event, delta, revertFunc )
                        {
                            /*----------Start Date & Time----------*/
                            var start_js_datetime = event.start.format('DD-MM-YYYY+hh:mm A');
                            var split_start_js_datetime = start_js_datetime.split('+');
                            var start_js_date = split_start_js_datetime[0];
                            var start_js_time = split_start_js_datetime[1];

                            /*----------End Date & Time----------*/
                            var end_js_datetime = event.end.format('DD-MM-YYYY+hh:mm A');
                            var split_end_js_datetime = end_js_datetime.split('+');
                            var end_js_date = split_end_js_datetime[0];
                            var end_js_time = split_end_js_datetime[1];

                            var event_id   = event.id;
                            var start_date = start_js_date;
                            var start_time = start_js_time;
                            var end_date   = end_js_date;
                            var end_time   = end_js_time;

                            advance_option();

                            $.ajax({
                                url     : "{{ $module_url_path }}/update",
                                type    : 'post',
                                data    : { '_token':token, 'event_id':event_id, 'start_date':start_date, 'start_time':start_time, 'end_date':end_date, 'end_time':end_time },
                                success : function(res) {}
                            });
                        },

                        eventResize : function( event, jsEvent, ui, view )
                        {
                            /*----------Start Date & Time----------*/
                            var start_js_datetime       = event.start.format('DD-MM-YYYY+hh:mm A');
                            var split_start_js_datetime = start_js_datetime.split('+');
                            var start_js_date           = split_start_js_datetime[0];
                            var start_js_time           = split_start_js_datetime[1];

                            /*----------End Date & Time----------*/
                            var end_js_datetime       = event.end.format('DD-MM-YYYY+hh:mm A');
                            var split_end_js_datetime = end_js_datetime.split('+');
                            var end_js_date           = split_end_js_datetime[0];
                            var end_js_time           = split_end_js_datetime[1];

                            var event_id   = event.id;
                            var start_date = start_js_date;
                            var start_time = start_js_time;
                            var end_date   = end_js_date;
                            var end_time   = end_js_time;

                            advance_option();

                            $.ajax({
                                url     : "{{ $module_url_path }}/update",
                                type    : 'post',
                                data    : { '_token':token, 'event_id':event_id, 'start_date':start_date, 'start_time':start_time, 'end_date':end_date, 'end_time':end_time },
                                success : function(res) {}
                            });
                        },

                    });

                    $('#availability_modal .close').click(function() {
                        calendar.fullCalendar('unselect');
                    });

                    $("#btn_delete").click(function()
                    {
                        var event_id = $("#event_id").val();

                        $.ajax({
                            url  : "{{ $module_url_path }}/delete",
                            type : 'post',
                            data : { '_token':token, 'event_id':event_id },
                            success:function(res)
                            {
                                calendar.fullCalendar('removeEvents',event_id);

                                hideProcessingOverlay();
                                if(res.status == 'success')
                                {
                                    $("#start_date").val('');
                                    $("#start_time").val('');
                                    $("#end_date").val('');
                                    $("#end_time").val('');

                                    $("#btn_add").attr('disabled','true');

                                    $("#availability_success_msg").html(res.message);
                                    $("#availability_success").css('display','block').delay(2000).fadeOut();

                                    setTimeout(function() { location.reload(); }, 2000);
                                }
                                else
                                {
                                    $("#availability_error_msg").html(res.message);
                                    $("#availability_error").css('display','block').delay(2000).fadeOut();
                                }
                            }
                        });
                    });

                    $("#btn_add").click(function()
                    {
                        var start_date = $("#start_date").val();
                        var start_time = $("#start_time").val();

                        var end_date = $("#end_date").val();
                        var end_time = $("#end_time").val();

                        var start_datetime = moment(start_date+' '+start_time,"DD-MM-YYYY hh:mm A").format();
                        var end_datetime   = moment(end_date+' '+end_time,"DD-MM-YYYY hh:mm A").format();

                        if( start_datetime > end_datetime )
                        {
                            $("#err_datetime").html("Error! End date/time can't be smaller than Start date/time. Please check the date/time again.");
                            return false;
                        }
                        else if( moment(start_time,"hh:mm A").format() > moment(end_time,"hh:mm A").format() )
                        {
                            $("#err_datetime").html("Error! End time can't be smaller than Start time. Please check the time again.");
                            return false;
                        }
                        else
                        {
                            $("#err_datetime").html("");
                        }

                        var for_selected_days = $("#for_selected_days").is(':checked');

                        var mon = '';
                        var tue = '';
                        var wed = '';
                        var thu = '';
                        var fri = '';
                        var sat = '';
                        var sun = '';

                        if( for_selected_days == true )
                        {
                            if( $("#mon").is(':checked') == true )
                            {
                                var mon = $("#mon").val();
                            }

                            if( $("#tue").is(':checked') == true )
                            {
                                var tue = $("#tue").val();
                            }

                            if( $("#wed").is(':checked') == true )
                            {
                                var wed = $("#wed").val();
                            }

                            if( $("#thu").is(':checked') == true )
                            {
                                var thu = $("#thu").val();
                            }

                            if( $("#fri").is(':checked') == true )
                            {
                                var fri = $("#fri").val();
                            }

                            if( $("#sat").is(':checked') == true )
                            {
                                var sat = $("#sat").val();
                            }

                            if( $("#sun").is(':checked') == true )
                            {
                                var sun = $("#sun").val();
                            }

                            if( $("#mon").is(':checked') == false && $("#tue").is(':checked') == false && $("#wed").is(':checked') == false && $("#thu").is(':checked') == false && $("#fri").is(':checked') == false && $("#sat").is(':checked') == false && $("#sun").is(':checked') == false )
                            {
                                $("#err_week_days").html("Error! Select atleast one day.");
                                return false;
                            }
                        }

                        $.ajax({
                            url        : "{{ $module_url_path }}/add",
                            type       : 'post',
                            data       : { '_token':token, 'start_date':start_date, 'start_time':start_time, 'end_date':end_date, 'end_time':end_time, 'for_selected_days':for_selected_days, 'mon':mon, 'tue':tue, 'wed':wed, 'thu':thu, 'fri':fri, 'sat':sat, 'sun':sun },
                            beforeSend : showProcessingOverlay(),
                            success    : function(res)
                            {
                                hideProcessingOverlay();
                                if(res.status == 'success')
                                {
                                    $("#start_date").val('');
                                    $("#start_time").val('');
                                    $("#end_date").val('');
                                    $("#end_time").val('');

                                    $("#btn_add").attr('disabled','true');

                                    $("#availability_success_msg").html(res.message);
                                    $("#availability_success").css('display','block').delay(2000).fadeOut();

                                    setTimeout(function() { location.reload(); }, 2000);
                                }
                                else
                                {
                                    $("#availability_error_msg").html(res.message);
                                    $("#availability_error").css('display','block').delay(2000).fadeOut();
                                }
                            }
                        });
                    });

                    $("#btn_update").click(function()
                    {
                        var event_id   = $('#event_id').val();
                        var start_date = $("#start_date").val();
                        var start_time = $("#start_time").val();
                        var end_date   = $("#end_date").val();
                        var end_time   = $("#end_time").val();

                        var start_datetime = moment(start_date+' '+start_time,"DD-MM-YYYY hh:mm A").format();
                        var end_datetime   = moment(end_date+' '+end_time,"DD-MM-YYYY hh:mm A").format();

                        if( start_datetime > end_datetime )
                        {
                            $("#err_datetime").html("Error! End date/time can't be smaller than Start date/time. Please check the date/time again.");
                            return false;
                        }
                        else
                        {
                            $("#err_datetime").html("");
                        }

                        $.ajax({
                            url        : "{{ $module_url_path }}/update",
                            type       : 'post',
                            data       : { '_token':token, 'event_id':event_id, 'start_date':start_date, 'start_time':start_time, 'end_date':end_date, 'end_time':end_time },
                            beforeSend : showProcessingOverlay(),
                            success    : function(res)
                            {
                                hideProcessingOverlay();
                                if(res.status == 'success')
                                {
                                    $("#start_date").val('');
                                    $("#start_time").val('');
                                    $("#end_date").val('');
                                    $("#end_time").val('');

                                    $("#btn_add").attr('disabled','true');

                                    $("#availability_success_msg").html(res.message);
                                    $("#availability_success").css('display','block').delay(2000).fadeOut();

                                    setTimeout(function() { location.reload(); }, 2000);
                                }
                                else
                                {
                                    $("#availability_error_msg").html(res.message);
                                    $("#availability_error").css('display','block').delay(2000).fadeOut();
                                }
                            }
                        });
                    });

                    $('#small_datepicker').on('changeDate', function()
                    {
                        $('#selectedDate').val(
                            $('#small_datepicker').datepicker('getFormattedDate'),
                        );

                        calendar.fullCalendar( 'gotoDate', $('#selectedDate').val() );
                    });
                }
            }
        });
        /*----------------calendar endss----------------*/

        $("#start_date").change(function(){
            advance_option();
        });

        $("#end_date").change(function(){
            advance_option();
        });

        $("#for_selected_days").change(function(){
            var for_selected_days = $("#for_selected_days").is(':checked');
            
            if( $.trim(for_selected_days) == 'true' )
            {
                $("#days_block").css('display','block');
            }
            else
            {
                $("#days_block").css('display','none');
            }
        });

        function advance_option()
        {
            var start_date = $("#start_date").val();
            var end_date   = $("#end_date").val();
            var event_id   = $("#event_id").val();

            if( moment(start_date,"DD-MM-YYYY").format() < moment(end_date,"DD-MM-YYYY").format() )
            {
                $("#advance_option").css('display','block');
            }
            else
            {
                $("#advance_option").css('display','none');
            }
        }

        /*------------------------------------ initialize the external events ------------------------------------*/

        $('#external-events div.external-event').each(function() {
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0, //  original position after the drag
            });
        });

    });
</script>

@endsection