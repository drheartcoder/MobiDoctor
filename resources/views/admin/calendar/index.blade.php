@extends('admin.layout.master')    
@section('main_content')

    <link href="{{ url('/') }}/public/fullcalendar/css/fullcalendar.css" rel="stylesheet" />
    <link href="{{ url('/') }}/public/fullcalendar/css/fullcalendar.print.css" rel='stylesheet' media='print' />

    <script src="{{ url('/') }}/public/fullcalendar/lib/moment.js"></script>
    <!-- <script src="{{ url('/') }}/public/fullcalendar/lib/jquery.js"></script> -->
    <script src="{{ url('/') }}/public/fullcalendar/js/fullcalendar.js"></script>

    <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>

        </div>
    </div>
    <!-- END Page Title -->

    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
            </li>
            <span class="divider">
                <i class="fa fa-angle-right"></i>
            </span> 
            <li class="active"><i class="fa fa-calendar"></i>{{ isset($page_title) ? $page_title : "" }}</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-blue">
                <div class="box-title">
                    <h3><i class="fa fa-calendar"></i>{{ isset($page_title) ? $page_title : "" }} </h3>
                    <div class="box-tool">
                    </div>
                </div>

                <div class="box-content">
                    
                    @include('admin.layout._operation_status')

                    <form method="post" action="{{ url($module_url_path.'/update' )}}" class="form-horizontal" enctype="multipart/form-data" id="validation-form">
                    {{ csrf_field() }}

                        <div class="col-sm-4 col-md-3 col-lg-3">
                            <div id="small_datepicker"></div>
                            <input type="hidden" id="selectedDate">
                        </div>

                        <div class="col-sm-8 col-md-9 col-lg-9">
                            <a href="#availability_modal" id="btn_open_availability_modal" data-backdrop="static" data-keyboard="false" data-toggle="modal" class="green-trans-btn" style="display: none;"></a>
                            <div id='calendar'></div>
                        </div>

                    </form>
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
                        <h4 id="doc_name"></h4>
                        <div class="Availability-form">

                            <div class="form-group">
                                <input type="hidden" id="event_id" name="event_id" />
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label>Start Date : </label> <span id="start_date"></span>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label>Start Time : </label><span id="start_time"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label>End Date : </label> <span id="end_date"></span>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label>End Time : </label> <span id="end_time"></span>
                                </div>
                            </div>

                            <div class="form-group" id="err_datetime" style="color:red;font-size:12px;"></div>
                            
                            <button class="green-btn close_btn" data-dismiss="modal" id="btn_close" style="display: none;">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <!--availability modal end-->
    
    <!-- END Main Content -->

    <!--datepicker start-->
    <script type="text/javascript" src="{{ url('/') }}/public/front/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/front/css/bootstrap-datepicker.min.css"/>
    <!--datepicker end-->

    <script type="text/javascript">
        $(document).ready(function(){

            $('#selectedDate').val( moment().toDate() );
            var token = "{{ csrf_token() }}";


            /*----------------datepicker starts----------------*/
            $('#small_datepicker').datepicker({
                todayHighlight : true,
                todayBtn       : true,
            });
            /*----------------datepicker ends----------------*/
            

            /*----------------calendar starts----------------*/
            var calendar;
            var events = '';

            $.ajax({
                url  :"{{ $module_url_path }}/all_dates",
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

                            defaultDate       : $('#selectedDate').val(), // by default start date
                            defaultView       : 'agendaWeek', // by default view
                            navLinks          : false,
                            selectable        : false,
                            selectHelper      : false,
                            eventLimit        : false,
                            loading           : true,
                            selectMinDistance : 1,
                            editable          : false,
                            disableDragging   : true,
                            disableResizing   : true,
                            events            : events,

                            eventClick : function( event, element )
                            {
                                $("#event_id").val(event.id);

                                /*----------Start Date & Time----------*/
                                var start_js_datetime = event.start.format('DD-MM-YYYY+hh:mm A');
                                var split_start_js_datetime = start_js_datetime.split('+');

                                $("#start_date").html(split_start_js_datetime[0]);
                                $('#start_time').html(split_start_js_datetime[1]);

                                /*----------End Date & Time----------*/
                                var end_js_datetime = event.end.format('DD-MM-YYYY+hh:mm A');
                                var split_end_js_datetime = end_js_datetime.split('+');

                                $("#end_date").html(split_end_js_datetime[0]);
                                $('#end_time').html(split_end_js_datetime[1]);

                                $("#doc_name").html(event.dr_name);

                                $("#btn_open_availability_modal")[0].click();
                                $("#btn_close").css('display','block');
                            },


                        });

                        $('#small_datepicker').on('changeDate', function() {
                            $('#selectedDate').val(
                                $('#small_datepicker').datepicker('getFormattedDate'),
                            );

                            calendar.fullCalendar( 'gotoDate', $('#selectedDate').val() );
                        });
                    }
                }
            });
            /*----------------calendar endss----------------*/


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