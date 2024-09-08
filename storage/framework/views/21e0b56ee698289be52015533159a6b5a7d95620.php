<?php $__env->startSection('main_content'); ?>
<body>
	
    <div class="home-banner-section about-banner-section">
        <div class="container">
            <div class="breadcrumb-section">
                <ul>
                    <li><a href="<?php echo e(url('/')); ?>">Home <i class="fa fa-angle-right"></i></a> </li>
                    <li><a class="active" href="#">For Business</a> </li>
                </ul>

            </div>
            <div class="about-banner-title">For Business</div>

        </div>
    </div>


    <div class="business-bck-section">
        <div class="container">
            <div class="mobidoctor-services-box">
                <div class="mobidoctor-services-title">Mobidoctor Services</div>
                <div class="mobidoctor-services-txt">Occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum distinctio.</div>
                <div class="services-mobi-doctor-bx">
                    <div class="services-mobi-doctor-img">
                        <img src="<?php echo e(url('/')); ?>/public/front/images/service-1.png" alt="service" />
                    </div>
                    <div class="services-mobi-title">Medical Advisory Services</div>
                </div>
                <div class="services-mobi-doctor-bx">
                    <div class="services-mobi-doctor-img">
                        <img src="<?php echo e(url('/')); ?>/public/front/images/service-2.png" alt="service" />
                    </div>
                    <div class="services-mobi-title">Report Aquisition</div>
                </div>
                <div class="services-mobi-doctor-bx">
                    <div class="services-mobi-doctor-img">
                        <img src="<?php echo e(url('/')); ?>/public/front/images/service-3.png" alt="service" />
                    </div>
                    <div class="services-mobi-title">Health Check</div>
                </div>
                <div class="services-mobi-doctor-bx">
                    <div class="services-mobi-doctor-img">
                        <img src="<?php echo e(url('/')); ?>/public/front/images/service-4.png" alt="service" />
                    </div>
                    <div class="services-mobi-title">Bespoke Medical Products</div>
                </div>
                <div class="services-mobi-doctor-bx">
                    <div class="services-mobi-doctor-img">
                        <img src="<?php echo e(url('/')); ?>/public/front/images/service-5.png" alt="service" />
                    </div>
                    <div class="services-mobi-title">Occupational Health Service</div>
                </div>
            </div>
        </div>

        <div class="sickness-inpact-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-7 col-md-7 col-lg-7">
                        <div class="sickness-left-bx">
                            <div class="sickness-title-txt">Sickness in the workplace is inevitable, but by
                                proactively implementing MobiDoctor for you
                                r business, you oryour clients can manage and
                                reduce its impact. </div>
                            <div class="sickness-txt">Occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum . </div>



                        </div>
                    </div>

                    <div class="col-sm-5 col-md-5 col-lg-5">
                        <div class="sickness-right-img">
                            <img src="<?php echo e(url('/')); ?>/public/front/images/inpact-img.png" alt="imge" />
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div class="healthy-happy-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="healthy-happy-left">
                            <img src="<?php echo e(url('/')); ?>/public/front/images/happy-healty.png" alt="happy" />
                        </div>

                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="healthy-happy-right">
                            <div class="healthy-happy-title">HEALTHY. HAPPY. PROFITABLE.</div>
                            <div class="healthy-happy-point"><i class="fa fa-check"></i> Mobi Doctor is open 365 days a year and your employees or clients
                                can book an appointment 24/7</div>

                            <div class="healthy-happy-point"><i class="fa fa-check"></i> No need to waste time scheduling doctors' appointments and taking
                                time off to attend them</div>
                            <div class="healthy-happy-point"><i class="fa fa-check"></i> Prescriptions can be sent instantly, enabling treatment to get under
                                way as quickly as possible</div>
                            <div class="healthy-happy-point"><i class="fa fa-check"></i> Our on-demand service lets employees or customers see a doctor
                                within an average of in minutes</div>
                            <div class="healthy-happy-point"><i class="fa fa-check"></i> Mobi Doctor GPs can issue referrals for testing, diagnostics or speci
                                alist treatment within minutes</div>

                            <div class="healthy-happy-point"><i class="fa fa-check"></i> We can help employees change their lives for the better, whether
                                they're unwell right now, have a specific personal health goal or just
                                a quick question</div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="business-contact-section">
            <div class="container-fluid">
                <div class="row">

                    <form name="frm_for_business" id="frm_for_business" method="post" action="<?php echo e(url('/')); ?>/for_business/store">
                        <?php echo e(csrf_field()); ?>

                        <div class="col-sm-12 col-md-7 col-lg-7">
                            <div class="contact-business-bx">
                                <?php echo $__env->make('front.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <div class="contact-business-title"> contact form </div>
                                <div class="contact-sms-img"><img src="<?php echo e(url('/')); ?>/public/front/images/msg.png" alt="sms" /> </div>
                                <div class="clearfix"></div>

                                <div class="form-group">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" placeholder="Company Name" name="company_name" id="company_name" maxlength="100" />
                                    <div class="error" id="err_company_name"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" placeholder="Email Address" id="company_email" name="email" />
                                    <div class="error" id="err_company_email"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" placeholder="Phone Number" id="phone_no" name="phone_no" />
                                    <div class="error" id="err_phone_no"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Employees </label>
                                    <select id="employee" name="employee">
                                        <option value="">--Select--</option>
                                        <option value="10-20">10-20</option>
                                        <option value="20-40">20-40</option>
                                        <option value="40-60">40-60</option>
                                        <option value="60-80">60-80</option>
                                        <option value="80-100">80-100</option>
                                        <option value="100+">100+</option>
                                    </select>
                                    <div class="error" id="err_employee"></div>
                                </div>
                                
                                 <div class="form-group">
                                    <label class="form-label">Yearly Cost Due</label>
                                    <select id="cost_due" name="cost_due">
                                        <option value="">--Select--</option>
                                        <option value="100,000-500,000">100,000-500,000</option>
                                        <option value="500,000-1,000,000">500,000-1,000,000</option>
                                        <option value="1,000,000+">1,000,000+</option> 
                                    </select>
                                    <div class="error" id="err_cost_due"></div>
                                </div>
                                
                                <div class="from-sub-btn">
                                    <button type="button" id="btn_for_business" class="green-btn">Contact</button>
                                </div>

                            </div>
                        </div>
                    </form>

                    <div class="col-sm-12 col-md-5 col-lg-5">
                        <div class="contact-business-right"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $("#btn_for_business").click(function()
    {
        var company_name    = $("#company_name").val();
        var email           = $("#company_email").val();
        var phone_no        = $("#phone_no").val();
        var employee        = $("#employee").val();
        var cost_due        = $("#cost_due").val();
        var phone_no_filter = /^[- +()0-9]*$/;
        var email_filter    = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if($.trim(company_name) == '')
        {
            $('#company_name').focus();
            $('#err_company_name').show();
            $('#err_company_name').html('Please enter first name.');
            $('#err_company_name').fadeOut(4000);
            return false;
        }  
        else if($.trim(email) == '')
        {
            $('#company_email').focus();
            $('#err_company_email').show();
            $('#err_company_email').html('Please enter email id.');
            $('#err_company_email').fadeOut(4000);
          return false;  
        }
        else if(!email_filter.test(email))
        {
            $('#company_email').focus();
            $('#err_company_email').show();
            $('#err_company_email').html('Please enter valid email id.');
            $('#err_company_email').fadeOut(4000);
            return false;  
        }
        else if($.trim(phone_no) == '')
        {
            $('#phone_no').focus();
            $('#err_phone_no').show();
            $('#err_phone_no').html('Please enter phone no.');
            $('#err_phone_no').fadeOut(4000);
            return false; 
        }
        else if($.trim(phone_no) != '' && (!phone_no_filter.test(phone_no) || $.trim(phone_no).length < 7))
        {
            $('#phone_no').focus();
            $('#err_phone_no').show();
            $('#err_phone_no').html('Please enter valid phone no.');
            $('#err_phone_no').fadeOut(4000);
            return false;
        }
        else if($.trim(phone_no) != '' && (!phone_no_filter.test(phone_no) || $.trim(phone_no).length > 16))
        {
            $('#phone_no').focus();
            $('#err_phone_no').show();
            $('#err_phone_no').html('Please enter valid phone no.');
            $('#err_phone_no').fadeOut(4000);
            return false;
        }
        else if($.trim(employee) == '')
        {
            $('#employee').focus();
            $('#err_employee').show();
            $('#err_employee').html('Please select employees.');
            $('#err_employee').fadeOut(4000);
            return false; 
        }
        else if($.trim(cost_due) == '')
        {
            $('#cost_due').focus();
            $('#err_cost_due').show();
            $('#err_cost_due').html('Please select yearly cost due.');
            $('#err_cost_due').fadeOut(4000);
            return false; 
        }
        else
        {
            var form = $('#frm_for_business')[0];
            var formData = new FormData(form);
            $.ajax({
                url         : '<?php echo e(url('/')); ?>/for_business/store',
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>