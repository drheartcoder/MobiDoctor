<?php $__env->startSection('main_content'); ?>

<style type="text/css">
.pad-r-0{padding-right: 0;}
.pad-l-0{padding-left: 0;}
.pad-rl-0{ padding-left: 0; padding-right: 0; }
</style>

<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                <?php echo $__env->make('front.patient.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                
                <?php echo $__env->make('front.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <div class="row">
                    
                    <?php if( isset( $card_details ) && !empty( $card_details ) ): ?>
                        <?php foreach( $card_details as $card ): ?>

                            <?php
                                $id          = isset($card['id']) ? encrypt_value($card['id']) : '';
                                $customer_id = isset($card['customer_id']) ? $card['customer_id'] : '';
                                $card_id     = isset($card['card_id']) ? $card['card_id'] : '';

                                $card_name   = isset($card['name']) ? $card['name'] : '';
                                $card_type   = isset($card['card_type']) ? $card['card_type']   : '';
                                $card_no     = isset($card['card_no']) ? $card['card_no']     : '';
                                $exp_month   = isset($card['exp_month']) ? $card['exp_month']   : '';
                                $exp_year    = isset($card['exp_year']) ? $card['exp_year']    : '';

                                $card_no     = str_pad( $card_no, 16, "X", STR_PAD_LEFT );
                                $exp_month   = ($exp_month < 10 ? '0'.$exp_month : $exp_month);
                            ?>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="payment-card default-card">
                                    <h4><b><?php echo e($card_type); ?></b> <span><?php echo e($card_name); ?></span></h4>
                                    <div class="payment-card-details">
                                        <div class="card-info">
                                            <p><?php echo e($card_no); ?></p>
                                            <p><?php echo e($exp_month.'/'.$exp_year); ?></p>
                                        </div>
                                        <div class="two-btns">
                                            <div class="half-btns">
                                                <button type="button" class="green-trans-btn btn_remove_card" data-id="<?php echo e($id); ?>" data-customer_id="<?php echo e($customer_id); ?>" data-card_id="<?php echo e($card_id); ?>">Delete</button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>

                <div class="right-btn">
                    <a href="javascript:void(0)" class="add-card-btn green-btn">+ Add Card</a>
                </div>

                <div class="white-wrapper prescription-wrapper add-card-form">
                    <h2>Add Card</h2>
                    
                    <form method="post" name="patient_add_card_form" id="patient_add_card_form" action="<?php echo e(url('/')); ?>/patient/my_account/card/add" autocomplete="off" >
                    <?php echo e(csrf_field()); ?>


                    <div class="prescription-section">
                        <div class="row">
                            
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Name on Card</label>
                                    <input type="text" placeholder="Enter Name on Card" name="card_name" id="card_name" value="" maxlength="100" />
                                    <div class="error" id="err_card_name"></div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Card Number</label>
                                    <input type="password" placeholder="Enter Card Number" name="card_no" id="card_no" value="" maxlength="16" />
                                    <div class="hide-pwd" id="hide_password" style="display: none;"><i class="fa fa-eye"></i></div>
                                    <div class="hide-pwd" id="show_password"><i class="fa fa-eye-slash"></i></div>
                                    <div class="error" id="err_card_no"></div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    
                                    <div class="col-sm-12 col-md-12 col-lg-12 pad-rl-0">
                                        <label class="form-label">Expiry Date</label>
                                    </div>
                                    <div class="sm-6 col-md-6 col-lg-6 pad-rl-0">
                                        <input type="text" placeholder="MM" name="expiry_month" id="expiry_month" value="" maxlength="2" />
                                        <div class="error" id="err_expiry_month"></div>
                                    </div>
                                    <div class="sm-6 col-md-6 col-lg-6 pad-rl-0">
                                        <input type="text" placeholder="YYYY" name="expiry_year" id="expiry_year" value="" maxlength="4" />
                                        <div class="error" id="err_expiry_year"></div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">CVV</label>
                                    <input type="text" placeholder="Enter CVV" name="cvv" id="cvv" value="" maxlength="3" />
                                    <div class="error" id="err_cvv"></div>
                                </div>
                            </div>

                        </div>

                        <div class="save-btn">
                            <button type="button" class="green-trans-btn" id="btn_submit_add_card_form">Save</button>
                        </div>

                        <div class="clearfix"></div>
                    </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.add-card-btn').click(function(){
        $('.add-card-form').toggleClass('active');
    });

    $('#card_no, #cvv, #expiry_month, #expiry_year').keydown(function ()
    {
        $(this).val($(this).val().replace(/[^\d]/, ''));
        $(this).keyup(function ()
        {
            $(this).val($(this).val().replace(/[^\d]/, ''));
        });
    });

    /*--- Hide / Show Password Start ---*/
        $("#hide_password").click(function()
        {
            $("#card_no").attr('type','password');

            $("#hide_password").css('display', 'none');
            $("#show_password").css('display', 'block');
        });

        $("#show_password").click(function()
        {
            $("#card_no").attr('type','text');

            $("#hide_password").css('display', 'block');
            $("#show_password").css('display', 'none');
        });
    /*--- Hide / Show Password End ---*/

    $("#card_name, #card_no, #expiry_month, #expiry_year, #cvv").on('keypress',function(event)
    {
        var keycode = event.keyCode || event.which;
        if(keycode == '13')
        {
            PatientAddCardValidationCheck();
        }
    });

    $("#btn_submit_add_card_form").click(function()
    {
        PatientAddCardValidationCheck();
    });

    function PatientAddCardValidationCheck()
    {
        var card_name    = $("#card_name").val();
        var card_no      = $("#card_no").val();
        var expiry_month = $("#expiry_month").val();
        var expiry_year  = $("#expiry_year").val();
        var cvv          = $("#cvv").val();
        var alpha        = /^[a-zA-Z ]*$/;
        var numeric      = /^[0-9]*$/;

        if( $.trim(card_name) == '' )
        {
            $('#card_name').focus();
            $('#err_card_name').show();
            $('#err_card_name').html('Please enter name');
            $('#err_card_name').fadeOut(4000);
            return false;
        }
        else if(!alpha.test(card_name))
        {
            $('#pfirst_name').focus();
            $('#err_card_name').show();
            $('#err_card_name').html('Please enter valid name.');
            $('#err_card_name').fadeOut(4000);
            return false;
        }
        else if( $.trim(card_no) == '' )
        {
            $('#card_no').focus();
            $('#err_card_no').show();
            $('#err_card_no').html('Please enter card number');
            $('#err_card_no').fadeOut(4000);
            return false;
        }
        else if(!numeric.test(card_no))
        {
            $('#card_no').focus();
            $('#err_card_no').show();
            $('#err_card_no').html('Please enter valid card number.');
            $('#err_card_no').fadeOut(4000);
            return false;
        }
        else if( $.trim(expiry_month) == '' )
        {
            $('#expiry_month').focus();
            $('#err_expiry_month').show();
            $('#err_expiry_month').html('Please enter expiry month');
            $('#err_expiry_month').fadeOut(4000);
            return false;
        }
        else if(!numeric.test(expiry_month))
        {
            $('#expiry_month').focus();
            $('#err_expiry_month').show();
            $('#err_expiry_month').html('Please enter valid expiry month.');
            $('#err_expiry_month').fadeOut(4000);
            return false;
        }
        else if( $.trim(expiry_year) == '' )
        {
            $('#expiry_year').focus();
            $('#err_expiry_year').show();
            $('#err_expiry_year').html('Please enter expiry year');
            $('#err_expiry_year').fadeOut(4000);
            return false;
        }
        else if(!numeric.test(expiry_year))
        {
            $('#expiry_year').focus();
            $('#err_expiry_year').show();
            $('#err_expiry_year').html('Please enter valid expiry year.');
            $('#err_expiry_year').fadeOut(4000);
            return false;
        }
        else if( $.trim(cvv) == '' )
        {
            $('#cvv').focus();
            $('#err_cvv').show();
            $('#err_cvv').html('Please enter cvv');
            $('#err_cvv').fadeOut(4000);
            return false;
        }
        else if(!numeric.test(cvv))
        {
            $('#cvv').focus();
            $('#err_cvv').show();
            $('#err_cvv').html('Please enter valid cvv.');
            $('#err_cvv').fadeOut(4000);
            return false;
        }
        else
        {
            var form = $('#patient_add_card_form')[0];
            var formData = new FormData(form);

            $.ajax({
                url         : '<?php echo e(url("/")); ?>/patient/my_account/card/add',
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
    }

    $(".btn_remove_card").click(function()
    {
        var customer_id = $(this).data('customer_id');
        var card_id     = $(this).data('card_id');
        var id          = $(this).data('id');
        var token       = "<?php echo e(csrf_token()); ?>";
        
        swal({
            title              : "Are you sure ?",
            text               : "Do you really want to delete this card details ?",
            type               : "warning",
            showCancelButton   : true,
            confirmButtonColor : "#DD6B55",
            confirmButtonText  : "Yes",
            cancelButtonText   : "No",
            closeOnConfirm     : true,
            closeOnCancel      : true
        },
        function(isConfirm)
        {
            if(isConfirm==true)
            {
                $.ajax({
                    url        : '<?php echo e(url("/")); ?>/patient/my_account/card/delete',
                    type       : 'post',
                    data       : { _token:token, id:id, customer_id:customer_id, card_id:card_id },
                    dataType   : 'json',
                    beforeSend : showProcessingOverlay(),
                    success    : function (res)
                    {
                        hideProcessingOverlay();
                        location.reload();
                    }
                });
            }
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.patient.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>