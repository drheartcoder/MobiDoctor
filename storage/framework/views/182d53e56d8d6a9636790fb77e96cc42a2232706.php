<?php $__env->startSection('main_content'); ?>
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
               <?php echo $__env->make('front.patient.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                <?php echo $__env->make('front.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="row">
                    <?php if(isset($arr_member) && sizeof($arr_member)>0): ?>
                        <?php foreach($arr_member as $key => $member): ?>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="payment-card family-card">
                                    <h4><b><?php echo e(isset($member['first_name']) ? decrypt_value($member['first_name']) : ''); ?> <?php echo e(isset($member['last_name']) ? decrypt_value($member['last_name']) : ''); ?>

                                    </b> 
                                    <a class="edit-card" href="<?php echo e($module_url_path); ?>/family_member/edit/<?php echo e(base64_encode($member['id'])); ?>"><i class="fa fa-pencil-square-o"></i></a></h4>
                                    <div class="payment-card-details">
                                        <div class="lifestyle-details">
                                            <ul>
                                                <li>
                                                    <span class="lifestyle-label">Email</span>
                                                    <span class="lifestyle-desc"><?php if(isset($member['email']) && $member['email'] != '') echo $member['email']; else echo '-';  ?></span>
                                                </li>
                                                <li>
                                                    <span class="lifestyle-label">Gender</span>
                                                    <span class="lifestyle-desc"><?php echo e(isset($member['gender']) ? decrypt_value($member['gender']) : ''); ?></span>
                                                </li>
                                                <li>
                                                    <span class="lifestyle-label">Relationship</span>
                                                    <span class="lifestyle-desc"><?php echo e(isset($member['relation']) ? decrypt_value($member['relation']) : ''); ?></span>
                                                </li>
                                                <li>
                                                    <span class="lifestyle-label">Date of Birth</span>
                                                    <span class="lifestyle-desc"><?php echo e(isset($member['birth_date']) ? $member['birth_date'] : ''); ?></span>
                                                </li>
                                                <li>
                                                    <span class="lifestyle-label">Mobile No.</span>
                                                    <span class="lifestyle-desc"><?php if(isset($member['mobile_no']) && $member['mobile_no']!='') echo $member['mobile_no']; else echo '-';  ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <a onclick="confirm_action(this,event,'Do you really want to remove this member ?')" href="<?php echo e($module_url_path.'/family_member/remove/'.base64_encode($member['id'])); ?>" class="green-trans-btn full-width">Remove Member</a>
                                            
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="right-btn">
                    <a href="javascript:void(0)" class="add-card-btn green-btn">+ Add a Member</a>
                </div>
                <div class="white-wrapper prescription-wrapper add-card-form">
                    <h2>Add a Member</h2>
                    <form name="frm_add_family_member" id="frm_add_family_member" method="post" action="<?php echo e($module_url_path); ?>/family_member/add">
                        <?php echo e(csrf_field()); ?>

                        <div class="prescription-section">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">First Name<i class="red">*</i></label>
                                        <input type="text" placeholder="Enter First Name" name="first_name" id="first_name" maxlength="50" />
                                        <div class="error" id="err_first_name"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Last Name<i class="red">*</i></label>
                                        <input type="text" placeholder="Enter Last Name" name="last_name" id="last_name" maxlength="50"/>
                                        <div class="error" id="err_last_name"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="email" placeholder="Enter Email" name="email" id="email" maxlength="80"/>
                                        <div class="error" id="err_email"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Gender<i class="red">*</i></label>
                                        <select name="gender" id="gender">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <div class="error" id="err_gender"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Relationship<i class="red">*</i></label>
                                        <input type="text" placeholder="Enter Relationship" name="relation" id="relation" maxlength="50"/>
                                        <div class="error" id="err_relation"></div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Date of Birth<i class="red">*</i></label>
                                        <div class="date-input relative-block">
                                            <input class="date-input" id="datepicker" type="text" placeholder="Select Date of Birth" name="birth_date" />
                                            <div class="error" id="err_datepicker"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label class="form-label">Country Code</label>
                                        <select name="phone_code" id="phone_code">
                                        <option value="">Code</option>
                                            <?php if(!empty($mobcode_data) && isset($mobcode_data)): ?>
                                                <?php foreach($mobcode_data as $mobcode): ?>
                                                    <option value="<?php echo e($mobcode['phonecode']); ?>">+<?php echo e($mobcode['phonecode']); ?> (<?php echo e($mobcode['iso3']); ?>)</option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <div class="error" id="err_phone_code"></div>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label">Mobile Number</label>
                                        <input type="text" placeholder="Enter Mobile no." id="mobile_no" name="mobile_no" maxlength="16" />
                                        <div class="error" id="err_mobile_no"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="save-btn">
                                <button type="button" class="green-trans-btn" id="btn_add_member">Save</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('common.datepicker', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
    $('.add-card-btn').click(function(){
        $('.add-card-form').toggleClass('active');
    });

    $(document).ready(function () {
        var today = new Date();
        $('#datepicker').datepicker({
          //  format: 'dd-mm-yyyy',
            autoclose:true,
            endDate: "today",
            maxDate: today
        });
    });

    $(document).ready(function()
    {
        $("#first_name, #last_name, #gender, #relation, #birth_date").on('keypress',function(event)
        {
            var keycode = event.keyCode || event.which;
            if(keycode == '13')
            {
                AddMemberValidationCheck();
            }
        });

        $('#btn_add_member').click(function() 
        {
            AddMemberValidationCheck();
        });
    });

    function AddMemberValidationCheck()
    {
        var first_name   = $('#first_name').val();
        var last_name    = $('#last_name').val();
        var gender       = $('#gender').val();
        var relation     = $('#relation').val();
        var datepicker   = $('#datepicker').val();
        var email        = $('#email').val();
        var mobile_no    = $('#mobile_no').val();
        var phone_code   = $('#phone_code').val();
        var alpha        = /^[a-zA-Z]*$/;
        var alpha_with_space = /^[a-zA-Z ]*$/;
        var numeric      = /^[0-9]*$/;
        var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if($.trim(first_name) == '')
        {
            $('#first_name').focus();
            $('#err_first_name').show();
            $('#err_first_name').html('Please enter first name.');
            $('#err_first_name').fadeOut(4000);
            return false;
        }  
        else if(!alpha.test(first_name))
        {
            $('#first_name').focus();
            $('#err_first_name').show();
            $('#err_first_name').html('Please enter valid first name.');
            $('#err_first_name').fadeOut(4000);
            return false;
        }   
        else if($.trim(last_name) == '')
        {
            $('#last_name').focus();
            $('#err_last_name').show();
            $('#err_last_name').html('Please enter last name.');
            $('#err_last_name').fadeOut(4000);
            return false;
        }
        else if(!alpha.test(last_name))
        {
            $('#last_name').focus();
            $('#err_last_name').show();
            $('#err_last_name').html('Please enter valid last name.');
            $('#err_last_name').fadeOut(4000);
            return false;
        }
        else if($.trim(email) != '' && !email_filter.test(email))
        {
            $('#email').focus();
            $('#err_email').show();
            $('#err_email').html('Please enter valid email id.');
            $('#err_email').fadeOut(4000);
            return false;
        }
        else if($.trim(gender) == '')
        {
            $('#gender').focus();
            $('#err_gender').show();
            $('#err_gender').html('Please select gender.');
            $('#err_gender').fadeOut(4000);
            return false;  
        }
        else if($.trim(relation) == '')
        {
            $('#relation').focus();
            $('#err_relation').show();
            $('#err_relation').html('Please enter relation.');
            $('#err_relation').fadeOut(4000);
            return false;  
        }
        else if(!alpha_with_space.test(relation))
        {
            $('#relation').focus();
            $('#err_relation').show();
            $('#err_relation').html('Please enter valid relation.');
            $('#err_relation').fadeOut(4000);
            return false;
        } 
        else if($.trim(datepicker) == '')
        {
            $('#datepicker').focus();
            $('#err_datepicker').show();
            $('#err_datepicker').html('Please select date of birth.');
            $('#err_datepicker').fadeOut(4000);
            return false;  
        }
        else if($.trim(mobile_no) != '' && !numeric.test(mobile_no))
        {
            $('#mobile_no').focus();
            $('#err_mobile_no').show();
            $('#err_mobile_no').html('Please enter valid mobile.');
            $('#err_mobile_no').fadeOut(4000);
            return false;
        }
        else if($.trim(mobile_no) != '' && $.trim(phone_code) == '')
        {
            $('#phone_code').focus();
            $('#err_phone_code').show();
            $('#err_phone_code').html('Please select country code.');
            $('#err_phone_code').fadeOut(4000);
            return false;  
        }
        else if($.trim(mobile_no) == '' && $.trim(phone_code) != '')
        {
            $('#mobile_no').focus();
            $('#err_mobile_no').show();
            $('#err_mobile_no').html('Please enter mobile no.');
            $('#err_mobile_no').fadeOut(4000);
            return false;  
        }
        else
        {
            console.log("here");

            var form = $('#frm_add_family_member')[0];
            var formData = new FormData(form);
            $.ajax({
                url         : '<?php echo e($module_url_path); ?>/family_member/add',
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
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.patient.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>