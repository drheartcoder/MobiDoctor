<?php $__env->startSection('main_content'); ?>
<style type="text/css">
    .pati-new-tab li a.active{color: #189108;border-bottom: 1px solid #189108;}
</style>
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                <?php echo $__env->make('front.doctor.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                <?php echo $__env->make('front.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              
                  <div class="pati-new-tab">
                        <ul>
                            <li>
                                <a class="active" id="patient_history" href="<?php echo e($module_url_path); ?>/patient_history/<?php echo e($patient_user_id); ?>">Patient History</a>
                            </li>
                            <li>
                                <a id="medical_history" href="<?php echo e($module_url_path); ?>/medical_history/<?php echo e($patient_user_id); ?>">Medical History</a>
                            </li>
                            <li>
                                <a id="medical_certificate" href="<?php echo e($module_url_path); ?>/medical_certificate/<?php echo e($patient_user_id); ?>">Medical Certificate</a>
                            </li>
                        </ul>
                      </div>
                    
                    <div class="content">
                            <div class="white-wrapper prescription-wrapper personal-information-new tab-patient">
                                <div class="upcoming-main-details-title-strip">
                                    <div class="upcoming-main-details-title">Personal Information</div>
                                    <div class="upcoming-con-edit">
                                        <?php /* href="<?php echo e($module_url_path); ?>/patient_history/download_personal_information/<?php echo e($patient_user_id); ?>" */ ?>
                                        <a id="btn_download_patient_details" target="_blank" download><i class="fa fa-download"></i></a>
                                        <a href="<?php echo e($module_url_path); ?>/patient_history/edit/<?php echo e($patient_user_id); ?>"><i class="fa fa-pencil-square-o"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="prescription-section">
                                    <div class="personal-info-bx">
                                        <?php
                                            $profile_image = '';
                                            if(isset($arr_patient_details['profile_image']) && $arr_patient_details['profile_image']!='')
                                            {
                                                if(file_exists($patient_image_base_path.'/'.$arr_patient_details['profile_image']))
                                                {
                                                    $profile_image = $patient_image_public_path.'/'.$arr_patient_details['profile_image'];
                                                }
                                                else
                                                {
                                                    $profile_image = $default_img_path.'/profile.jpeg';
                                                }
                                            }
                                            else
                                            {
                                                 $profile_image = $default_img_path.'/profile.jpeg';
                                            }
                                        ?>
                                        <img style="width:170px !important;height:154px !important;" src="<?php echo e($profile_image); ?>" alt="info" />
                                    </div>
                                    <div class="patients-new-con-info">
                                        <div class="patients-info-name-bx">
                                            <div class="patient-history-name">Name</div>
                                            <div class="history-name-patient"><?php echo e(isset($arr_patient_details['first_name'])?decrypt_value($arr_patient_details['first_name']):''); ?> <?php echo e(isset($arr_patient_details['last_name'])?decrypt_value($arr_patient_details['last_name']):'-'); ?></div>
                                        </div>
                                        <div class="patients-info-name-bx">
                                            <div class="patient-history-name">Date of Birth</div>
                                            <div class="history-name-patient"><?php echo e(isset($arr_patient_details['date_of_birth'])?date('d M Y',strtotime($arr_patient_details['date_of_birth'])):'-'); ?></div>

                                        </div>
                                        <div class="patients-info-name-bx">
                                            <div class="patient-history-name">Gender</div>
                                            <div class="history-name-patient"><?php echo e(isset($arr_patient_details['gender'])?$arr_patient_details['gender']:''); ?></div>
                                        </div>
                                        <div class="patients-info-name-bx">
                                            <div class="patient-history-name">Contact No.</div>
                                            <div class="history-name-patient"><?php echo e(isset($arr_patient_details['contact_no'])?$arr_patient_details['contact_no']:'-'); ?></div>
                                        </div>
                                        <div class="patients-info-name-bx">
                                            <div class="patient-history-name">Mobile No.</div>
                                            <div class="history-name-patient">+<?php echo e(isset($arr_patient_details['phone_code'])?$arr_patient_details['phone_code']:''); ?> <?php echo e(isset($arr_patient_details['mobile_no'])?$arr_patient_details['mobile_no']:'-'); ?></div>
                                        </div>
                                        <div class="patients-info-name-bx">
                                            <div class="patient-history-name">Email</div>
                                            <div class="history-name-patient"><?php echo e(isset($arr_patient_details['email'])?$arr_patient_details['email']:'-'); ?></div>
                                        </div>
                                        <div class="patients-info-name-bx">
                                            <div class="patient-history-name">Address</div>
                                            <div class="history-name-patient"><?php echo e(isset($arr_patient_details['address'])?decrypt_value($arr_patient_details['address']):'-'); ?></div>

                                        </div>

                                    </div>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                            <div class="family-member-section">
                                <div class="family-member-title">Family Members</div>
                                <div class="family-add-member"><a href="<?php echo e($module_url_path); ?>/patient_history/family_member/<?php echo e(base64_encode($arr_patient_details['id'])); ?>">+ Add Member</a></div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <?php if(isset($arr_patient_details['family_member']) && sizeof($arr_patient_details['family_member'])>0): ?>
                                    <?php foreach($arr_patient_details['family_member'] as $family_key => $family_member): ?>
                                        <div class="col-sm-6 col-md-4 col-lg-4">
                                            <div class="patient-photo-bx">
                                                <div class="patient-image-new"> <img src="<?php echo e($default_img_path); ?>/profile.jpeg" alt="" /> </div>
                                                <div class="patient-status-name">
                                                     <?php if(isset($arr_patient_details['is_online']) && $arr_patient_details['is_online']!='' && $arr_patient_details['is_online'] == '0'): ?>
                                                        <i class="fa fa-circle grey-dot"></i>
                                                    <?php else: ?>
                                                        <i class="fa fa-circle"></i>
                                                    <?php endif; ?>


                                                    <?php echo e(isset($family_member['first_name'])?decrypt_value($family_member['first_name']):'-'); ?> <?php echo e(isset($family_member['last_name'])?decrypt_value($family_member['last_name']):'-'); ?></div>
                                                <div class="patient-birth-date"><i class="fa fa-birthday-cake"></i><?php echo e(isset($family_member['birth_date']) ? date('d M Y',strtotime($family_member['birth_date'])) : ''); ?></div>
                                                <div class="dot-menu-section">
                                                    <div class="dot-img-icon">
                                                        <img src="<?php echo e(url('/')); ?>/public/front/images/dot-menu.png" alt="" />
                                                        <ul class="hide-dot">
                                                            <li><a onclick="return view_family_member(<?php echo e($family_member['id']); ?>)">View Member</a></li>
                                                            <li><a onclick="return edit_family_member(<?php echo e($family_member['id']); ?>)">Edit Member</a></li>
                                                            <li><a onclick="confirm_action(this,event,'Do you really want to delete family member?')" href="<?php echo e($module_url_path); ?>/patient_history/family_member/delete/<?php echo e(base64_encode($family_member['id'])); ?>">Delete Member</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>
                            </div>
                        
                    </div>
                
            </div>
        </div>
    </div>
</div>


<!--Add Member modal start-->
<div class="modal fade availability-modal add-member-popup" id="edit-family-member" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close close_btn" data-dismiss="modal"><img src="<?php echo e(url('/')); ?>/public/front/images/close.png" class="img-responsive" alt="" /></button>
            <div class="modal-body">
                <h4>Edit Member</h4>
                <form name="frm_edit_family_member" id="frm_edit_family_member" method="post" action="<?php echo e($module_url_path); ?>/patient_history/family_member/update">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="family_member_id" id="family_member_id">
                    <div class="Availability-form">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="text" name="first_name" id="family_member_first_name" placeholder="First name"/>
                                    <div class="error" id="err_family_member_first_name"></div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="text" name="last_name" id="family_member_last_name" placeholder="Last name"/>
                                    <div class="error" id="err_family_member_last_name"></div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="email" id="family_member_email" name="email" placeholder="Email"/>
                                    <div class="error" id="err_family_member_email"></div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <select id="family_member_gender" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <div class="error" id="err_family_member_gender"></div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="text" id="family_member_relation" name="relation" placeholder="Relation" />
                                    <div class="error" id="err_family_member_relation"></div>
                                </div>
                            </div>


                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <div class="date-input relative-block">
                                        <input class="date-input" name="birth_date" id="edit_birth_date" type="text" placeholder="DOB" />
                                        <div class="error" id="err_birth_date"></div>
                                    </div>
                                </div>
                            </div>

                             <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <select name="phone_code" id="family_member_phone_code">
                                    <option value="">Country Code</option>
                                        <?php if(!empty($mobcode_data) && isset($mobcode_data)): ?>
                                            <?php foreach($mobcode_data as $mobcode): ?>
                                                <option value="<?php echo e($mobcode['phonecode']); ?>">+<?php echo e($mobcode['phonecode']); ?> (<?php echo e($mobcode['iso3']); ?>)</option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <div class="error" id="err_family_member_phone_code"></div>
                                </div>
                            </div>


                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="text" name="mobile_no" id="family_member_mobile" placeholder="Mobile Number" />
                                    <div class="error" id="err_family_member_mobile"></div>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="btn_edit_family_member" class="green-btn full-width">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Add Member modal end-->

<!--view Member details modal start-->
<div class="modal fade availability-modal add-member-popup" id="view-family-details" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close close_btn" data-dismiss="modal"><img src="<?php echo e(url('/')); ?>/public/front/images/close.png" class="img-responsive" alt="" /></button>
            <div class="modal-body">
                <h4>Family Member Details</h4>
                <div class="Availability-form">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">

                            <div class="lifestyle-details">
                                <ul>
                                    <li>
                                        <span class="lifestyle-label">Name</span>
                                        <span class="lifestyle-desc" id="member_name"></span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Mobile No</span>
                                        <span class="lifestyle-desc" id="member_mobile"></span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Email</span>
                                        <span class="lifestyle-desc" id="member_email"></span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Birth Date</span>
                                        <span class="lifestyle-desc" id="member_birth_date"></span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Gender</span>
                                        <span class="lifestyle-desc" id="member_gender"></span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Relation</span>
                                        <span class="lifestyle-desc" id="member_relation"></span>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('virgil.patient_virgil', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!--view Member details modal end-->
<!--datepicker strat-->
<?php echo $__env->make('common.datepicker', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!--datepicker end-->

<script type="text/javascript">
    var card_id = "<?php echo e(isset($arr_patient_details['dump_id']) ? $arr_patient_details['dump_id'] : ''); ?>";
    var userkey = "<?php echo e(isset($arr_patient_details['dump_session']) ? $arr_patient_details['dump_session'] : ''); ?>";
</script>

<script>
$(document).ready(function(){
    $('#patient_history').click(function(){
        window.location.href = "<?php echo e($module_url_path); ?>/patient_history/<?php echo e($patient_user_id); ?>";
    });
    $('#medical_history').click(function(){
        window.location.href = "<?php echo e($module_url_path); ?>/medical_history/<?php echo e($patient_user_id); ?>";
    });
    $('#medical_certificate').click(function(){
        window.location.href = "<?php echo e($module_url_path); ?>/medical_certificate/<?php echo e($patient_user_id); ?>";
    });
});
</script>

<script>
$(document).ready(function() {
    $(document).on('responsive-tabs.initialised', function(event, el) {
        //console.log(el);
    });

    $(document).on('responsive-tabs.change', function(event, el, newPanel) {
        //console.log(el);
        //console.log(newPanel);
    });

    $('[data-responsive-tabs]').responsivetabs({
        initialised: function() {
            //console.log(this);
        },

        change: function(newPanel) {
            //console.log(newPanel);
        }
    });
});

$("#datepicker, #datepicker-2, #datepicker-3 ").datepicker({
    todayHighlight: true,
    autoclose: true
});

</script>

<script type="text/javascript">
function view_family_member(id)
{
    var member_id = id;
    $.ajax({
        url         : '<?php echo e($module_url_path); ?>/patient_history/family_member/deails/'+member_id,
        type        : 'get',
        processData : false,
        contentType : false,
        cache       : false,
        beforeSend  : showProcessingOverlay(),
        success     : function (res)
        {
            $("#member_name").html(res.data.member_name);
            $("#member_mobile").html(res.data.mobile_no);
            $("#member_email").html(res.data.email);
            $("#member_birth_date").html(res.data.birth_date);
            $("#member_gender").html(res.data.gender);
            $("#member_relation").html(res.data.relation);

            $("#view-family-details").modal('show');
            hideProcessingOverlay();
        }
    });
}

function edit_family_member(id)
{
    var member_id = id;
    $.ajax({
        url         : '<?php echo e($module_url_path); ?>/patient_history/family_member/deails/'+member_id,
        type        : 'get',
        processData : false,
        contentType : false,
        cache       : false,
        beforeSend  : showProcessingOverlay(),
        success     : function (res)
        {
            $("#family_member_first_name").val(res.data.first_name);
            $("#family_member_last_name").val(res.data.last_name);
            $("#family_member_email").val(res.data.email);


            $('#family_member_gender').val(res.data.gender);
            $("#family_member_phone_code").val(res.data.phone_code);

            $("#family_member_relation").val(res.data.relation);
            $("#edit_birth_date").val(res.data.birth_date);
            
            $("#family_member_mobile").val(res.data.mobile_number);
            $("#family_member_id").val(res.data.member_id);
            
            $('#edit-family-member').modal({backdrop: 'static', keyboard: false});
            $("#edit-family-member").modal('show');



            var today = new Date();
            $('#edit_birth_date').datepicker({
              //  format: 'dd-mm-yyyy',
                autoclose:true,
                endDate: "today",
                maxDate: today
            });

            hideProcessingOverlay();
        }
    });
}

$("#btn_edit_family_member").click(function()
{
    var first_name   = $('#family_member_first_name').val();
    var last_name    = $('#family_member_last_name').val();
    var gender       = $('#family_member_gender').val();
    var relation     = $('#family_member_relation').val();
    var datepicker   = $('#edit_birth_date').val();
    var email        = $('#family_member_email').val();
    var mobile_no    = $('#family_member_mobile').val();
    var phone_code   = $('#family_member_phone_code').val();
    var alpha        = /^[a-zA-Z]*$/;
    var alpha_with_space = /^[a-zA-Z ]*$/;
    var numeric      = /^[0-9]*$/;
    var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if($.trim(first_name) == '')
    {
        $('#family_member_first_name').focus();
        $('#err_family_member_first_name').show();
        $('#err_family_member_first_name').html('Please enter first name.');
        $('#err_family_member_first_name').fadeOut(4000);
        return false;
    }  
    else if(!alpha.test(first_name))
    {
        $('#family_member_first_name').focus();
        $('#err_family_member_first_name').show();
        $('#err_family_member_first_name').html('Please enter valid first name.');
        $('#err_family_member_first_name').fadeOut(4000);
        return false;
    }   
    else if($.trim(last_name) == '')
    {
        $('#family_member_last_name').focus();
        $('#err_family_member_last_name').show();
        $('#err_family_member_last_name').html('Please enter last name.');
        $('#err_family_member_last_name').fadeOut(4000);
        return false;
    }
    else if(!alpha.test(last_name))
    {
        $('#family_member_last_name').focus();
        $('#err_family_member_last_name').show();
        $('#err_family_member_last_name').html('Please enter valid last name.');
        $('#err_family_member_last_name').fadeOut(4000);
        return false;
    }
    else if($.trim(email) != '' && !email_filter.test(email))
    {
        $('#family_member_email').focus();
        $('#err_family_member_email').show();
        $('#err_family_member_email').html('Please enter valid email id.');
        $('#err_family_member_email').fadeOut(4000);
        return false;
    }
    else if($.trim(gender) == '')
    {
        $('#family_member_gender').focus();
        $('#err_family_member_gender').show();
        $('#err_family_member_gender').html('Please select gender.');
        $('#err_family_member_gender').fadeOut(4000);
        return false;  
    }
    else if($.trim(relation) == '')
    {
        $('#family_member_relation').focus();
        $('#err_family_member_relation').show();
        $('#err_family_member_relation').html('Please enter relation.');
        $('#err_family_member_relation').fadeOut(4000);
        return false;  
    }
    else if(!alpha_with_space.test(relation))
    {
        $('#family_member_relation').focus();
        $('#err_family_member_relation').show();
        $('#err_family_member_relation').html('Please enter valid relation.');
        $('#err_family_member_relation').fadeOut(4000);
        return false;
    } 
    else if($.trim(datepicker) == '')
    {
        $('#edit_birth_date').focus();
        $('#err_edit_birth_date').show();
        $('#err_edit_birth_date').html('Please select date of birth.');
        $('#err_edit_birth_date').fadeOut(4000);
        return false;  
    }
    else if($.trim(mobile_no) != '' && !numeric.test(mobile_no))
    {
        $('#family_member_mobile').focus();
        $('#err_family_member_mobile').show();
        $('#err_family_member_mobile').html('Please enter valid mobile.');
        $('#err_family_member_mobile').fadeOut(4000);
        return false;
    }
    else if($.trim(mobile_no) != '' && $.trim(phone_code) == '')
    {
        $('#family_member_phone_code').focus();
        $('#err_family_member_phone_code').show();
        $('#err_family_member_phone_code').html('Please select country code.');
        $('#err_family_member_phone_code').fadeOut(4000);
        return false;  
    }
    else if($.trim(mobile_no) == '' && $.trim(phone_code) != '')
    {
        $('#family_member_mobile').focus();
        $('#err_family_member_mobile').show();
        $('#err_family_member_mobile').html('Please enter mobile no.');
        $('#err_family_member_mobile').fadeOut(4000);
        return false;  
    }
    else
    {
        var form = $('#frm_edit_family_member')[0];
        var formData = new FormData(form);
        $.ajax({
            url         : '<?php echo e($module_url_path); ?>/patient_history/family_member/update',
            type        : 'post',
            data        : formData,
            processData : false,
            contentType : false,
            cache       : false,
            beforeSend : showProcessingOverlay(),
            success     : function (res)
            {
                hideProcessingOverlay();
                location.reload();
            }
        });
    }
});
    
$("#btn_download_patient_details").click(function(){
        var _token = '<?php echo e(csrf_token()); ?>';
     $.ajax({
               url:"<?php echo e($module_url_path); ?>/patient_history/get_medication_details/<?php echo e($patient_user_id); ?>",
               type:'get',
               success:function(response)
               {
                    $.each(response,function(index,value){

                        var dec_medication_name = decrypt(value.name).toString();
                        response[index].dec_medication_name = dec_medication_name;  
                        
                        var dec_frequency = decrypt(value.frequency).toString();
                        response[index].dec_frequency = dec_frequency;  
         
                        var dec_medication_use = decrypt(value.medication_use).toString();
                        response[index].dec_medication_use = dec_medication_use;   

                    });

                     $.ajax({
                        url:"<?php echo e($module_url_path); ?>/patient_history/download_personal_information/<?php echo e($patient_user_id); ?>",
                        type:'post',
                        //beforeSend : showProcessingOverlay(),
                       data:{'arr_data' : response,'_token' : _token},
                       
                       success:function(response)
                       {
                            //hideProcessingOverlay();

                            pdf_url = "<?php echo e($module_url_path); ?>/patient_history/download_personal_information/<?php echo e($patient_user_id); ?>";
                           window.open(pdf_url, '_blank');
                       }

                    });



               }


            });

    
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.doctor.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>