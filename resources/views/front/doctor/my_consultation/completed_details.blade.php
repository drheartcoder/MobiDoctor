@extends('front.doctor.layout.master')
@section('main_content')

<?php
    $id             = isset( $arr_consultation['id'] ) && !empty( $arr_consultation['id'] ) ? $arr_consultation['id'] : '';
    $consult_id     = isset( $arr_consultation['consultation_id'] ) && !empty( $arr_consultation['consultation_id'] ) ? $arr_consultation['consultation_id'] : '';
    $user_id        = isset( $arr_consultation['user_id'] ) && !empty( $arr_consultation['user_id'] ) ? $arr_consultation['user_id'] : '';
    $who_is_patient = isset( $arr_consultation['who_is_patient'] ) && !empty( $arr_consultation['who_is_patient'] ) ? $arr_consultation['who_is_patient'] : '';
    $patient_id     = isset( $arr_consultation['patient_id'] ) && !empty( $arr_consultation['patient_id'] ) ? $arr_consultation['patient_id'] : '';
    $doctor_id      = isset( $arr_consultation['doctor_id'] ) && !empty( $arr_consultation['doctor_id'] ) ? $arr_consultation['doctor_id'] : '';
    $consult_date   = isset( $arr_consultation['date'] ) && !empty( $arr_consultation['date'] ) ? $arr_consultation['date'] : '';
    $consult_time   = isset( $arr_consultation['time'] ) && !empty( $arr_consultation['time'] ) ? $arr_consultation['time'] : '';
    $illness        = isset( $arr_consultation['category_name']['name'] ) && !empty( $arr_consultation['category_name']['name'] ) ? decrypt_value( $arr_consultation['category_name']['name'] ) : '';
    $description    = isset( $arr_consultation['description'] ) && !empty( $arr_consultation['description'] ) ? $arr_consultation['description'] : '';
    $image          = isset( $arr_consultation['image'] ) && !empty( $arr_consultation['image'] ) ? $arr_consultation['image'] : '';
    $notes          = isset( $arr_consultation['notes'] ) && !empty( $arr_consultation['notes'] ) ? $arr_consultation['notes'] : '';

    $consult_datetime = date("h:i A, l d F, Y", strtotime( $consult_date.' '.$consult_time ));

    $user_fname   = isset( $arr_consultation['user_details']['first_name'] ) && !empty( $arr_consultation['user_details']['first_name'] ) ? decrypt_value( $arr_consultation['user_details']['first_name'] ) : '';
    $user_lname   = isset( $arr_consultation['user_details']['last_name'] ) && !empty( $arr_consultation['user_details']['last_name'] ) ? decrypt_value( $arr_consultation['user_details']['last_name'] ) : '';
    $patient_dump_id      = isset( $arr_consultation['user_details']['dump_id'] ) && !empty( $arr_consultation['user_details']['dump_id'] ) ? $arr_consultation['user_details']['dump_id'] : '';
    $patient_dump_session = isset( $arr_consultation['user_details']['dump_session'] ) && !empty( $arr_consultation['user_details']['dump_session'] ) ? $arr_consultation['user_details']['dump_session'] : '';
    
    if( $who_is_patient == 'family' ):
        $patient_fname = isset( $arr_consultation['family']['first_name'] ) && !empty( $arr_consultation['family']['first_name'] ) ? decrypt_value( $arr_consultation['family']['first_name'] ) : '';
        $patient_lname = isset( $arr_consultation['family']['last_name'] ) && !empty( $arr_consultation['family']['last_name'] ) ? decrypt_value( $arr_consultation['family']['last_name'] ) : '';
    else:
        $patient_fname = $user_fname;
        $patient_lname = $user_lname;
    endif;
?>

	<div class="page-wrapper">
		<div class="container">
			<div class="consultation-back-page">
				<a href="{{ $module_url_path }}/completed">Back</a>
			</div>

			<div class="row">
                <div class="col-sm-8 col-md-9 col-lg-9">

                    <!-- Form Status Starts -->
                    <div class="alert alert-success" id="consultation_details_form_success" style="display: none;">
                        <strong>Success!</strong> <span id="consultation_details_form_success_msg"></span>
                    </div>
                    
                    <div class="alert alert-danger" id="consultation_details_form_error" style="display: none;">
                        <strong>Error!</strong> <span id="consultation_details_form_error_msg"></span>
                    </div>
                    <!-- Form Status Ends -->
                    
                    <div class="upcoming-consultation-details-box" id="view_consultation_details">

                        <div class="upcoming-main-details-title-strip">
                            <div class="upcoming-main-details-title">Upcoming Consultation Details</div>
                            <div class="upcoming-con-edit"> <a href="javascript:void(0);" id="edit_notes"><i class="fa fa-pencil-square-o"></i></a></div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="consultation-id-section">
                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="consultation-id-box">
                                        <div class="consultation-id-num">{{ $consult_id }}</div>
                                        <div class="consultation-id-num-txt">Consultation ID</div>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="consultation-id-box">
                                        <div class="consultation-id-num">{{ $patient_fname.' '.$patient_lname }}</div>
                                        <div class="consultation-id-num-txt">Consulting Patient</div>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="consultation-id-box">
                                        <div class="consultation-id-num">Completed</div>
                                        <div class="consultation-id-num-txt">Status</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="doctor-note-section">
                            <div class="doctor-note-title">Doctor Consultation Notes</div>
                            <div class="doctor-note-txt" id="dec_view_notes"></div>
                        </div>

                        <div class="doctor-note-section presciption-sect">
                            <div class="doctor-note-title">Prescription</div>
                            <div class="clearfix"></div>

                            <!-- <div class="prescrip-pdf-section">
                                <div class="prescrip-pdf-strip ">
                                    <div class="presciption-name">Prescription 1.pdf</div>
                                    <div class="presciption-view-dlt-bx">
                                        <div class="presciption-view-icon"> <a href="#"><i class="fa fa-eye"></i></a></div>
                                        <div class="presciption-view-icon"> <a href="#"><i class="fa fa-download"></i></a></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div> -->

                        </div>

                    </div>

                    <div class="upcoming-consultation-details-box" id="edit_consultation_details" style="display: none;">

                        <form name="frm_doc_consult_details" id="frm_doc_consult_details" method="post" action="{{ $current_url_path }}/update" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="upcoming-main-details-title-strip">
                                <div class="upcoming-main-details-title">Edit Upcoming Consultation Details</div>
                                <div class="upcoming-con-edit"> <a href="javascript:void(0);" id="save_notes"><i class="fa fa-floppy-o"></i></a></div>
                                <div class="upcoming-con-edit"> <a href="javascript:void(0);" id="cancel_notes"><i class="fa fa-times"></i></a></div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="consultation-id-section">
                                <div class="row">
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <div class="consultation-id-box">
                                            <div class="consultation-id-num">{{ $consult_id }}</div>
                                            <div class="consultation-id-num-txt">Consultation ID</div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <div class="consultation-id-box">
                                            <div class="consultation-id-num">{{ $patient_fname.' '.$patient_lname }}</div>
                                            <div class="consultation-id-num-txt">Consulting Patient</div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <div class="consultation-id-box">
                                            <div class="consultation-id-num">Completed</div>
                                            <div class="consultation-id-num-txt">Status</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="doctor-note-section">
                                <div class="doctor-note-title">Doctor Consultation Notes</div>
                                <br/>
                                <textarea name="consult_notes" id="edit_consult_notes" rows="3" required style="width: 100%;"></textarea>
                                <div class="error" id="err_edit_consult_notes"></div>
                            </div>

                            <div class="doctor-note-section presciption-sect">
                                <div class="doctor-note-title">Prescription
                                    <div class="doctor-add-pre">
                                        <a href="#availability_modal" data-backdrop="static" data-keyboard="false" data-toggle="modal">+ Add Prescription</a>
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <!-- <div class="prescrip-pdf-section">
                                    <div class="prescrip-pdf-strip ">
                                        <div class="presciption-name">Prescription 1.pdf</div>
                                        <div class="presciption-view-dlt-bx">
                                            <div class="presciption-view-icon"> <a href="javascript:void(0);" id="delete_presciption"><i class="fa fa-trash"></i></a></div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div> -->
                            </div>

                        </form>

                    </div>

                    <div class="upcoming-consultation-details-box">
                        <div class="upcoming-main-details-title-strip">
                            <div class="upcoming-main-details-title">Consultation Details</div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="purpose-consultation-section">
                            <div class="doctor-note-title">Illness</div>
                            <div class="doctor-note-txt" id="dec_illness"></div>
                        </div>

                        <div class="doctor-note-section">
                            <div class="doctor-note-title">Description</div>
                            <div class="doctor-note-txt" id="dec_description"></div>
                        </div>

                        <div class="doctor-note-section presciption-sect">
                            <div class="doctor-note-title">Image</div>
                            <div class="clearfix"></div>
                            <div class="prescrip-pdf-section">
                                <div class="prescrip-pdf-strip ">
                                    <div class="presciption-name">{{ $image }}</div>
                                    <div class="presciption-view-dlt-bx">
                                        <?php
                                            if(isset($image) && !empty($image) && File::exists($illness_img_base_path.'/'.$image)):
                                                $image_file = $illness_img_public_path.'/'.$image;
                                                ?>
                                                    <div class="presciption-view-icon">
                                                        <a  id="dec_image" data-name="image" data-file="{{ $image }}" data-path="{{ $image_file }}" href="" download><i class="fa fa-download"></i></a>
                                                    </div>
                                                <?php
                                            endif;
                                        ?>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>

                <div class="col-sm-4 col-md-3 col-lg-3">
                    <div class="upcoming-consultation-details-box right-date">
                        <div class="upcoming-main-details-title-strip">
                            <div class="upcoming-main-details-title">Time</div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="time-calendar-section">
                            <div class="caledar-img-box"> <img src="{{ url('/') }}/public/front/images/calendar-img.png" alt="caledar" /> </div>
                            <div class="caledar-txt-box">
                                <div class="cal-confirmed-date">{{ $consult_datetime }}</div>
                                <div class="cal-confirmed-time">Confirmed Time</div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="video-consult-btn">
                            <!-- <button type="button" id="btn_start_video"><i class="fa fa-video-camera"></i>Video Consult</button> -->
                            <a href="{{ $current_url_path }}/video"><i class="fa fa-video-camera"></i>Video Consult</a>
                        </div>
                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>

        </div>
	</div>

    <!--forgot password modal start-->
	    <div class="modal fade availability-modal" id="availability_modal" role="dialog">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <button type="button" class="close close_btn" data-dismiss="modal">
                        <img src="{{ url('/') }}/public/front/images/close.png" class="img-responsive" alt="" />
                    </button>
	                
                    <form method="post" id="add_prescription_form" name="add_prescription_form" action="{{ $current_url_path }}/prescription/store" enctype="multipart/form-data">
                    {{ csrf_field() }}

                        <div class="modal-body">
    	                    <h4>Add Prescription</h4>
    	                    <div class="Availability-form">

    	                        <div class="form-group">
    	                            
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
    	                                <div class="input-group">
    	                                    <div class="form-inputs uneditable-input">
    	                                        <span class="fileupload-preview for-color">
    	                                        </span>
    	                                    </div>
    	                                    
                                            <div class="input-group-btn">
    	                                        <div class="btn btn-file">
    	                                            <span class="fileupload-new">Choose File</span>
    	                                            <span class="fileupload-exists change-btn">Change</span>
                                                    <input type="file" class="file-input" id="file_prescription_image" data-name="prescription_image" />
    	                                        </div>
    	                                        <a href="#" class="btn fileupload-exists remove-file" data-dismiss="fileupload">Remove</a>
    	                                    </div>
    	                                </div>
    	                            </div>
    	                            
                                    <div class="error" id="err_prescription_image"></div>
    	                        </div>

    	                        <div class="form-group">
                                    <input type="text" id="repeats" name="repeats" placeholder="Repeats" />
                                    <div class="error" id="err_repeats"></div>
                                </div>

    	                        <div class="form-group">
    	                        	<input type="text" id="direction" name="direction" placeholder="Direction" />
                                    <div class="error" id="err_direction"></div>
    	                        </div>

    	                        <button class="green-btn full-width" id="btn_save_prescription">Save</button>
    	                    </div>
    	                </div>

                    </form>

	            </div>
	        </div>
	    </div>
    <!--forgot password modal end-->

    <script type="text/javascript">
        var card_id = "{{ $patient_dump_id }}";
        var userkey = "{{ $patient_dump_session }}";

        var form     = $('#frm_doc_consult_details')[0];
        var formData = new FormData(form);

        var add_prescription_form = $('#add_prescription_form')[0];
        var formPrescriptionData  = new FormData(add_prescription_form);

        $(document).ready(function()
        {
            /*--------------------------Decrypt Data and files Starts--------------------------*/

            $("#dec_view_notes").html( decrypt( "{{ $notes or '' }}" ) );
            $("#edit_consult_notes").val( decrypt( "{{ $notes or '' }}" ) );
            $("#dec_illness").html( "{{ $illness or '' }}" );
            $("#dec_description").html( decrypt( "{{ $description or '' }}" ) );

            if( $("#dec_image").length )
            {
                var name = $("#dec_image").data('name');
                var file = $("#dec_image").data('file');
                var path = $("#dec_image").data('path');

                decrypt_file(name, file, path);
            }

            /*--------------------------Decrypt Data and files Ends--------------------------*/

            $("#view_consultation_details").css('display','block');
            $("#edit_consultation_details").css('display','none');

            $("#edit_notes").click(function()
            {
                $("#view_consultation_details").css('display','none');
                $("#edit_consultation_details").css('display','block');
            });

            $("#cancel_notes").click(function()
            {
                $("#view_consultation_details").css('display','block');
                $("#edit_consultation_details").css('display','none');
            });

            $('#file_prescription_image').on('change', function()
            {
                encrypt_file( $(this).data('name'), formData );
            });

            $("#save_notes").click(function()
            {
                form_validation();
            });

            $("#btn_save_prescription").click(function()
            {
                form_prescription_validation();
            });

        });

        function form_validation()
        {
            var edit_consult_notes = $("#edit_consult_notes").val();

            if( $.trim(edit_consult_notes) == '' )
            {
                $('#err_edit_consult_notes').show();
                $('#err_edit_consult_notes').html('Please enter consultation notes.');
                $('#err_edit_consult_notes').fadeOut(4000);
                return false;
            }
            else
            {
                showProcessingOverlay();

                // get User's card(s)
                api.cards.get(card_id).then(function (cards)
                {
                    var _token = '{{ csrf_token() }}';

                    formData.append('_token',_token);
                    formData.append('consult_notes', encrypt(api, edit_consult_notes, cards));
                   
                    $.ajax({
                        url         : "{{ $current_url_path }}/update",
                        type        : 'post',
                        data        : formData,
                        processData : false,
                        contentType : false,
                        cache       : false,
                        success     : function(res)
                        {
                            hideProcessingOverlay();
                            if(res.status == 'success')
                            {
                                $("#consultation_details_form_success_msg").html(res.msg);
                                $("#consultation_details_form_success").css('display','block').delay(4000).fadeOut();

                                $("#view_consultation_details").css('display','block');
                                $("#edit_consultation_details").css('display','none');

                                setTimeout(function()
                                {
                                    location.reload();
                                }, 1000);
                            }
                            else
                            {
                                $("#consultation_details_form_error_msg").html(res.msg);
                                $("#consultation_details_form_error").css('display','block').delay(4000).fadeOut();
                            }
                        }
                    });
                })
                .then(null, function (error)
                {
                    hideProcessingOverlay();
                    $("#btn_open_function_output_modal")[0].click();
                    $("#function_output_msg").html(error);
                })
                .catch(function(error)
                {
                    hideProcessingOverlay();
                    $("#btn_open_function_output_modal")[0].click();
                    $("#function_output_msg").html(error);
                });
            }
        }

        function form_prescription_validation()
        {
            var repeats   = $("#repeats").val();
            var direction = $("#direction").val();

            if( $.trim(repeats) == '' )
            {
                $('#err_repeats').show();
                $('#err_repeats').html('Please enter repeats.');
                $('#err_repeats').fadeOut(4000);
                return false;
            }
            else if( $.trim(direction) == '' )
            {
                $('#err_direction').show();
                $('#err_direction').html('Please enter direction.');
                $('#err_direction').fadeOut(4000);
                return false;
            }
            else
            {
                showProcessingOverlay();

                // get User's card(s)
                api.cards.get(card_id).then(function (cards)
                {
                    var _token = '{{ csrf_token() }}';

                    formPrescriptionData.append('_token',_token);
                    formPrescriptionData.append('repeats', encrypt(api, repeats, cards));
                    formPrescriptionData.append('direction', encrypt(api, direction, cards));
                   
                    $.ajax({
                        url         : "{{ $current_url_path }}/prescription/store",
                        type        : 'post',
                        data        : formPrescriptionData,
                        processData : false,
                        contentType : false,
                        cache       : false,
                        success     : function(res)
                        {
                            hideProcessingOverlay();
                            if(res.status == 'success')
                            {
                                /*$("#consultation_details_form_success_msg").html(res.msg);
                                $("#consultation_details_form_success").css('display','block').delay(4000).fadeOut();*/

                                /*$("#view_consultation_details").css('display','block');
                                $("#edit_consultation_details").css('display','none');*/

                                setTimeout(function()
                                {
                                    //location.reload();
                                }, 1000);
                            }
                            else
                            {
                                /*$("#consultation_details_form_error_msg").html(res.msg);
                                $("#consultation_details_form_error").css('display','block').delay(4000).fadeOut();*/
                            }
                        }
                    });
                })
                .then(null, function (error)
                {
                    hideProcessingOverlay();
                    $("#btn_open_function_output_modal")[0].click();
                    $("#function_output_msg").html(error);
                })
                .catch(function(error)
                {
                    hideProcessingOverlay();
                    $("#btn_open_function_output_modal")[0].click();
                    $("#function_output_msg").html(error);
                });
            }
        }
    </script>

    @include('virgil.patient_virgil')

    <!--fileupload start-->
    <script src="{{ url('/') }}/public/front/js/bootstrap-fileupload.js"></script>
    <link href="{{ url('/') }}/public/front/css/bootstrap-fileupload.css" rel=stylesheet type="text/css" />
    <!--fileupload end-->

@endsection