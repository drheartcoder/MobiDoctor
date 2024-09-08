<?php $__env->startSection('main_content'); ?>
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                 <?php echo $__env->make('front.doctor.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
            	<?php echo $__env->make('front.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="white-wrapper prescription-wrapper">
                    <h2>Bank Account Details</h2>
                     <form name="frm_medical_qualification" id="frm_medical_qualification" method="post" action="<?php echo e($module_url_path); ?>/bank_details/update">
                        <?php echo e(csrf_field()); ?>

                        <div class="prescription-section">
                            <div class="row">
                                 <div class="col-sm-12 col-md-12 col-lg-12">
                                     <div class="form-group">
                                         <label class="form-label">Bank Name<i class="red">*</i></label>
                                         <input type="text" name="bank_name" id="bank_name" placeholder="Enter Bank Name" maxlength="50" />
                                         <div class="error" id="err_bank_name"></div>
                                     </div>
                                 </div>
                            </div>
                            <div class="row">
                                 <div class="col-sm-12 col-md-12 col-lg-12">
                                     <div class="form-group">
                                         <label class="form-label">Account Name<i class="red">*</i></label>
                                         <input type="text" name="bank_account_name" id="bank_account_name" placeholder="Enter Bank Account Name" maxlength="25"/>
                                         <div class="error" id="err_bank_account_name"></div>
                                     </div>
                                 </div>
                            </div>
                            <div class="row">
                                 <div class="col-sm-12 col-md-12 col-lg-12">
                                     <div class="form-group">
                                         <label class="form-label">Account No<i class="red">*</i></label>
                                         <input type="text" name="bank_account_no" id="bank_account_no" placeholder="Enter Bank Account Number" maxlength="20"/>
                                         <div class="error" id="err_bank_account_no"></div>
                                     </div>
                                 </div>
                            </div>
                            
                          
                            <div class="save-btn">
                                <button type="button" class="green-trans-btn" id="btn_bank_details">Save</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('virgil.virgil', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
    $(document).ready(function(){
        var bank_name         = '<?php echo e(isset($arr_doctor_details['bank_name'])?$arr_doctor_details['bank_name']:''); ?>';
        var bank_account_name = '<?php echo e(isset($arr_doctor_details['bank_account_name'])?$arr_doctor_details['bank_account_name']:''); ?>';
        var bank_account_no   = '<?php echo e(isset($arr_doctor_details['bank_account_no'])?$arr_doctor_details['bank_account_no']:''); ?>';
        
        $("#bank_name").val( decrypt(bank_name) );
        $("#bank_account_name").val( decrypt(bank_account_name) );
        $("#bank_account_no").val( decrypt(bank_account_no) );
    });

    $("#btn_bank_details").click(function(){
        var bank_name         = $("#bank_name").val();
        var bank_account_name = $("#bank_account_name").val();
        var bank_account_no   = $("#bank_account_no").val();

        var numeric        = /^[0-9]*$/;
        var alphaWithSpace = /^[A-Za-z ]*$/;
        var alphaNumeric   = /^[0-9A-Za-z]*$/;

        if($.trim(bank_name) == '')
        {
            $("#bank_name").focus();
            $("#err_bank_name").show();
            $("#err_bank_name").html('Please enter bank name.');
            $("#err_bank_name").fadeOut(4000);
            return false;
        }
        else if(!alphaWithSpace.test(bank_name))
        {
            $("#bank_name").focus();
            $("#err_bank_name").show();
            $("#err_bank_name").html('Please enter valid bank name.');
            $("#err_bank_name").fadeOut(4000);
            return false;
        }
        else if($.trim(bank_account_name) == '')
        {
            $("#bank_account_name").focus();
            $("#err_bank_account_name").show();
            $("#err_bank_account_name").html('Please enter bank account holder name.');
            $("#err_bank_account_name").fadeOut(4000);
        }
        else if(!alphaWithSpace.test(bank_account_name))
        {
            $("#bank_account_name").focus();
            $("#err_bank_account_name").show();
            $("#err_bank_account_name").html('Please enter valid account name.');
            $("#err_bank_account_name").fadeOut(4000);
            return false;
        }
        else if($.trim(bank_account_no) == '')
        {
            $("#bank_account_no").focus();
            $("#err_bank_account_no").show();
            $("#err_bank_account_no").html('Please enter bank account number.');
            $("#err_bank_account_no").fadeOut(4000);
            return false;
        }
        else if(!alphaNumeric.test(bank_account_no))
        {
            $("#bank_account_no").focus();
            $("#err_bank_account_no").show();
            $("#err_bank_account_no").html('Please enter valid bank account number.');
            $("#err_bank_account_no").fadeOut(4000);
            return false;
        }
        else
        {
            showProcessingOverlay();

           
            // get User's card(s)
            api.cards.get(card_id).then(function (cards)
            {
                var _token                = '<?php echo e(csrf_token()); ?>';
                var enc_bank_name         = encrypt(api, bank_name, cards);
                var enc_bank_account_name = encrypt(api, bank_account_name, cards);
                var enc_bank_account_no   = encrypt(api, bank_account_no, cards);
               
                $.ajax({
                    url  : "<?php echo e($module_url_path); ?>/bank_details/update",
                    type : 'post',
                    data : {
                                _token            : _token,
                                bank_name         : enc_bank_name,
                                bank_account_name : enc_bank_account_name,
                                bank_account_no   : enc_bank_account_no
                            },
                    success : function(res)
                    {
                        hideProcessingOverlay();
                        location.reload();
                    }
                });

            })
            .then(null, function (error)
            {
                $("#btn_open_function_output_modal")[0].click();
                $("#function_output_msg").html(error);
            })
            .catch(function(error)
            {
                $("#btn_open_function_output_modal")[0].click();
                $("#function_output_msg").html(error);
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.doctor.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>