<?php $__env->startSection('main_content'); ?>

<?php
    $browser_country_code = $browser_address = $user_type = '';

    $user_browser_data = get_browser_data();
    if( isset($user_browser_data) && !empty($user_browser_data) )
    {
        $browser_country_code = isset( $user_browser_data['location']->countryCode ) ? $user_browser_data['location']->countryCode : '';
        $browser_address = isset( $user_browser_data['address'] ) ? $user_browser_data['address'] : '';
    }

    $is_valid_user_login = false;

    $obj_user = Sentinel::check(); 
    $user_type = isset($obj_user->user_type)?$obj_user->user_type:'';

    if(isset($obj_user->user_type) && ($obj_user->user_type == 'patient' || $obj_user->user_type == 'doctor')){
        $is_valid_user_login = true;
    }

?>

<body>

    <div class="home-banner-section">
        <div class="container">
            <div class="banner-content">
                <h2>Full online GP service,</h2>
                <h2>including prescriptions in minutes</h2>
                <h5>We’re open 8 am – 9 pm, 7 days a week</h5>
                <div class="mobi-appoint-btn">
                    <?php if(!$is_valid_user_login): ?>
                        <a href="#login_modal" data-toggle="modal">Book Online Appointment</a>
                    <?php elseif($user_type == 'patient'): ?>
                        <a href="<?php echo e(url('/')); ?>/patient/consultation">Book Online Appointment</a>
                    <?php else: ?>
                        <a href="#login_modal" data-toggle="modal">Book Online Appointment</a>
                    <?php endif; ?>
                </div>

                <div class="mobi-appoint-btn mobi-how-work">
                    <a href="<?php echo e(url('/')); ?>/how_it_work">How it Work</a>
                </div>

                <p>Download our free APP </p>
                <ul class="app-btns">
                    <li>
                        <a href="javascript:void(0)"><img src="<?php echo e(url('/')); ?>/public/front/images/app-store-img.png" class="img-responsive" alt="MobiDoctor" /></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="<?php echo e(url('/')); ?>/public/front/images/google-play-img.png" class="img-responsive" alt="MobiDoctor" /></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="membership-section">
        <div class="container">
            <div class="relative-block">
                <div class="row">
                    <div class="col-md-7 col-lg-7">
                        <div class="membership-content">
                            <h4>MEMBERSHIP</h4>
                            <p>Our service is open to members and non-members. Membership provides numerous options, including up to 50% off your appointment today. You also get reduced prices on a number of services, access to exclusive offers, and premium content to help with your ongoing good health and well-being.</p>
                            <p>What’s more, our membership subscription price is incredibly affordable. It works out to a few cents a day, which is some of the best money you can possibly spend. Our membership helps you to save money on routine medical care, and keep you at your best - physically and mentally - every day.</p>
                            <a class="green-btn" href="<?php echo e(url('/')); ?>/membership">Find Out More</a>
                        </div>
                    </div>
                </div>
                <div class="membership-img"><img src="<?php echo e(url('/')); ?>/public/front/images/doctor-img1.jpg" class="img-responsive" alt="MobiDoctor" /></div>
            </div>
        </div>
    </div>

    <div class="home-how-it-section home-section">
        <div class="container">
            <h2></h2>
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="how-it-block">
                        <div class="how-it-img bg-img">&nbsp;</div>
                        <h5>BOOK AN APPOINTMENT</h5>
                        <p>You can queue up to see a doctor in just minutes, or schedule an appointment for a pre-set time that works for you and your busy schedule. Don’t wait hours or days for a regular office visit, see a doctor online, now!</p>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="how-it-block see-doctor">
                        <div class="how-it-img bg-img">&nbsp;</div>
                        <h5>SEE A DOCTOR ONLINE</h5>
                        <p>Using our app or our website, you can talk face-to-face with a certified and licensed Malta-based GP. All video chats are fully encrypted, private, and secure.</p>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="how-it-block feeling-better">
                        <div class="how-it-img bg-img">&nbsp;</div>
                        <h5>START FEELING BETTER</h5>
                        <p>Our online appointments offer all the features of an in-office visit. You’ll receive a diagnosis, medical advice and feedback, prescriptions, referrals, and doctor’s notes for work or school.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="review-section home-section">
        <div class="container">
            <div class="review-content">
                <h2>Our Most Watched Customer Reviews</h2>
                <div class="row">
                    <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
                        <div class="review-user">
                            <a href="javascript:void(0)" class="review-user-img"><img src="<?php echo e(url('/')); ?>/public/front/images/user-img1.png" class="img-responsive" alt="MobiDoctor" /><span class="view-more">View More</span></a>
                            <p>Katherine's story</p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
                        <div class="review-user">
                            <a href="javascript:void(0)" class="review-user-img"><img src="<?php echo e(url('/')); ?>/public/front/images/user-img2.png" class="img-responsive" alt="MobiDoctor" /><span class="view-more">View More</span></a>
                            <p>Katherine's story</p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
                        <div class="review-user">
                            <a href="javascript:void(0)" class="review-user-img"><img src="<?php echo e(url('/')); ?>/public/front/images/user-img3.png" class="img-responsive" alt="MobiDoctor" /><span class="view-more">View More</span></a>
                            <p>Emily's story</p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
                        <div class="review-user">
                            <a href="javascript:void(0)" class="review-user-img"><img src="<?php echo e(url('/')); ?>/public/front/images/user-img4.png" class="img-responsive" alt="MobiDoctor" /><span class="view-more">View More</span></a>
                            <p>Natalie's story</p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
                        <div class="review-user">
                            <a href="javascript:void(0)" class="review-user-img"><img src="<?php echo e(url('/')); ?>/public/front/images/user-img5.png" class="img-responsive" alt="MobiDoctor" /><span class="view-more">View More</span></a>
                            <p>Edward's story</p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
                        <div class="review-user">
                            <a href="javascript:void(0)" class="review-user-img"><img src="<?php echo e(url('/')); ?>/public/front/images/user-img6.png" class="img-responsive" alt="MobiDoctor" /><span class="view-more">View More</span></a>
                            <p>Charlie's story</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="Compare-benefit-section">
        <div class="container">
            <div class="Compare-benefit-title">Compare the Benefits of an All-inclusive Membership Package</div>
            <div class="row">
                <div class="member-ship-section-bx">
                    <div class="col-sm-6 col-md-6 col-lg-4 col-lg-offset-2  ">
                        <div class="month-membership-bx">
                            <div class="your-member-bx">
                                <div class="your-member-title"><?php echo e(isset($arr_subscription_plan[0]['name'])?$arr_subscription_plan[0]['name']:''); ?></div>
                                <div class="clearfix"></div>
                                <div class="member-ship-price"><?php echo e(isset($arr_subscription_plan[0]['consultation_price']) ? $arr_subscription_plan[0]['consultation_price'].'&#128;' : ''); ?>

                                    <h3>per consultation</h3>
                                </div>
                                <div class="member-ship-price"><?php echo e(isset($arr_subscription_plan[0]['monthly_price']) ? $arr_subscription_plan[0]['monthly_price'].'&#128;' : ''); ?>

                                    <h3>per month</h3>
                                </div>
                            </div>
                            <div class="membership-description">
                                <ul>
                                    <li>Prescription fee <span><?php echo e(isset($arr_subscription_plan[0]['prescription_fee']) ? $arr_subscription_plan[0]['prescription_fee'].'&#128;' : ''); ?></span></li>
                                    <li>Sicknote <span><?php echo e(isset($arr_subscription_plan[0]['sick_note']) ? $arr_subscription_plan[0]['sick_note'].'&#128;' : ''); ?></span></li>
                                    <li>Referrals <span><?php echo e(isset($arr_subscription_plan[0]['referrals']) ? $arr_subscription_plan[0]['referrals'].'&#128;' : ''); ?></span></li>
                                    <li>Membership discounts <span><?php if(isset($arr_subscription_plan[0]['is_membership_discount']) && $arr_subscription_plan[0]['is_membership_discount'] == 'Yes'): ?> <i class="fa fa-check"></i> <?php else: ?> <i class="fa fa-times"></i><?php endif; ?></span></li>
                                </ul>
                            </div>
                            <div class="member-book-btn">
                                <?php if(!$is_valid_user_login): ?>
                                   <a class="book-now-btn" href="#login_modal" data-toggle="modal">Become a member</a>
                                <?php elseif($user_type == 'patient'): ?>
                                    <a class="book-now-btn" href="<?php echo e(url('/')); ?>/patient/consultation">Become a member</a>
                                <?php else: ?>
                                    <a class="book-now-btn" href="#login_modal" data-toggle="modal">Become a member</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="month-membership-bx member-block">
                            <div class="your-member-bx">
                                <div class="your-member-title"><?php echo e(isset($arr_subscription_plan[1]['name']) ? $arr_subscription_plan[1]['name'] : ''); ?></div>
                                <div class="member-ship-price"><?php echo e(isset($arr_subscription_plan[1]['consultation_price']) ? $arr_subscription_plan[1]['consultation_price'].'&#128;' : ''); ?>

                                    <h3>per consultation</h3>
                                </div>
                                <div class="member-ship-price"><?php echo e(isset($arr_subscription_plan[1]['monthly_price']) ? $arr_subscription_plan[1]['monthly_price'].'&#128;' : ''); ?>

                                    <h3>per month</h3>
                                </div>
                            </div>

                            <div class="membership-description">
                                <ul>
                                    <li>Prescription fee <span><?php echo e(isset($arr_subscription_plan[1]['prescription_fee']) ? $arr_subscription_plan[1]['prescription_fee'].'&#128;' : ''); ?></span></li>
                                    <li>Sicknote <span><?php echo e(isset($arr_subscription_plan[1]['sick_note']) ? $arr_subscription_plan[1]['sick_note'].'&#128;' : ''); ?></span></li>
                                    <li>Referrals <span><?php echo e(isset($arr_subscription_plan[1]['referrals']) ? $arr_subscription_plan[1]['referrals'].'&#128;' : ''); ?></span></li>
                                    <li>Membership discounts <span><?php if(isset($arr_subscription_plan[0]['is_membership_discount']) && $arr_subscription_plan[0]['is_membership_discount'] == 'No'): ?> <i class="fa fa-times"></i> <?php else: ?> <i class="fa fa-times"></i><?php endif; ?></span></li>
                                </ul>
                            </div>
                            <div class="member-book-btn">
                                <?php if(!$is_valid_user_login): ?>
                                   <a class="book-now-btn" href="#login_modal" data-toggle="modal">Book an appointment</a>
                                <?php elseif($user_type == 'patient'): ?>
                                    <a class="book-now-btn" href="<?php echo e(url('/')); ?>/patient/consultation">Book an appointment</a>
                                <?php else: ?>
                                    <a class="book-now-btn" href="#login_modal" data-toggle="modal">Book an appointment</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="online-doctor-section home-section">
        <div class="container">
            <div class="title">
                <h2>See an online doctor in minutes</h2>
                <p>Join the thousands of people just like you who use Mobidoctor’s online service. You can get medical advice, prescriptions, and more, all from the comfort of your home or office. And since all of our Malta based GPs are fully licensed and certified, you know you’re getting quality care. It’s just like going to a doctor’s office, only quicker and easier. There’s no travelling, no waiting, and no hanging around with a bunch of sick people. It’s health care for the 21st century!</p>
            </div>
            <div class="mobile-img visible-xs visible-sm"><img src="<?php echo e(url('/')); ?>/public/front/images/mobile-img.jpg" class="img-responsive" alt="MobiDoctor" /></div>
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4 pad-r-0">
                    <div class="online-left-section">
                        <a href="javascript:void(0)" class="feature-block one">
                            <span class="feature-img resp-icon"><span class="bg-img">&nbsp;</span></span>
                            <span class="content">
                                <span class="sub-title">GPs available 8am - 8pm</span>
                                <span class="para">Our doctors are available for appointments 7 days a..</span>
                            </span>
                            <span class="feature-img hidden-xs hidden-sm"><span class="bg-img">&nbsp;</span></span>
                        </a>
                        <a href="javascript:void(0)" class="feature-block two">
                            <span class="feature-img resp-icon"><span class="bg-img">&nbsp;</span></span>
                            <span class="content">
                                <span class="sub-title">Fully encrypted</span>
                                <span class="para">Mobidoctor is fully encrypted end to end and complies...</span>
                            </span>
                            <span class="feature-img hidden-xs hidden-sm"><span class="bg-img">&nbsp;</span></span>
                        </a>
                        <a href="javascript:void(0)" class="feature-block three">
                            <span class="feature-img resp-icon"><span class="bg-img">&nbsp;</span></span>
                            <span class="content">
                                <span class="sub-title">Share with your doctor</span>
                                <span class="para">If desired, you can share your medical records,...</span>
                            </span>
                            <span class="feature-img hidden-xs hidden-sm"><span class="bg-img">&nbsp;</span></span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 hidden-xs hidden-sm">
                    <div class="mobile-img"><img src="<?php echo e(url('/')); ?>/public/front/images/mobile-img.jpg" class="img-responsive" alt="MobiDoctor" /></div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 pad-l-0">
                    <div class="online-right-section">
                        <a href="javascript:void(0)" class="feature-block four">
                            <span class="feature-img"><span class="bg-img">&nbsp;</span></span>
                            <span class="content">
                                <span class="sub-title">Access to a UK GP</span>
                                <span class="para">Whether you're on a laptop, tablet, or mobile device...</span>
                            </span>
                        </a>
                        <a href="javascript:void(0)" class="feature-block five">
                            <span class="feature-img"><span class="bg-img">&nbsp;</span></span>
                            <span class="content">
                                <span class="sub-title">Same-day prescriptions</span>
                                <span class="para">If you require a prescription following your Mobidoctor...</span>
                            </span>
                        </a>
                        <a href="javascript:void(0)" class="feature-block six">
                            <span class="feature-img"><span class="bg-img">&nbsp;</span></span>
                            <span class="content">
                                <span class="sub-title">Be seen in minutes</span>
                                <span class="para">You can choose to wait in the queue (no more than a few...</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <?php if(!$is_valid_user_login): ?>
                <a href="#login_modal" data-toggle="modal" class="green-btn">See Doctor Online</a>
            <?php elseif($user_type == 'patient'): ?>
                <a class="green-btn" href="<?php echo e(url('/')); ?>/patient/consultation">See Doctor Online</a>
            <?php else: ?>
                <a href="#login_modal" data-toggle="modal" class="green-btn">See Doctor Online</a>
            <?php endif; ?>
           
        </div>
    </div>

    <?php if(!$is_valid_user_login || $user_type == 'doctor'): ?>
    <div class="make-appointment-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="appointment-frm">
                        <div class="appointment-title">Make an Appointment</div>
                        <div class="appoit-txt">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod </div>
                        <div class="title-line make-line "></div>
                        <div class="lets-stated-title">Let's Get Started</div>
                        <div class="started-sign-in">
                            <a class="login-btn" href="#login_modal" data-toggle="modal">Sign In</a>
                        </div>

                        <div class="clearfix"></div>

                        <form method="POST" name="hpatient_signup_form" id="hpatient_signup_form" autocomplete="off" action="<?php echo e(url('/')); ?>/patient/signup/store">
                            <?php echo e(csrf_field()); ?>


                            <div class="make-appointment-from">

                                <!-- Registration Status Starts -->
                                <div class="alert alert-success" id="hpatient_signup_success" style="display: none;">
                                    <strong>Success!</strong> <span id="hpatient_signup_success_msg"></span>
                                </div>

                                <div class="alert alert-danger" id="hpatient_signup_error" style="display: none;">
                                    <strong>Error!</strong> <span id="hpatient_signup_error_msg"></span>
                                </div>
                                <!-- Registration Status Ends -->

                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-sm-6">
                                        <div class="form-group" id="hfname_div">
                                            <!-- <i class="fa fa-user-o"></i> -->
                                            <input type="text" name="first_name" id="hfirst_name" placeholder="First Name" maxlength="50" />
                                            <div class="info-popup">Enter Your First Name</div>
                                            <div class="error" id="err_hfirst_name"></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-sm-6">
                                        <div class="form-group" id="hlname_div">
                                            <!-- <i class="fa fa-user-o"></i> -->
                                            <input type="text" placeholder="Last Name" name="last_name" id="hlast_name" maxlength="50" />
                                            <div class="info-popup">Enter Your Last Name</div>
                                            <div class="error" id="err_hlast_name"></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-sm-12">
                                        <div class="form-group" id="hemail_div">
                                            <!-- <i class="fa fa-envelope-o"></i> -->
                                            <input type="email" placeholder="Email" name="email" id="hemail" maxlength="80" />
                                            <div class="info-popup">Enter Your Email ID</div>
                                            <div class="error" id="err_hemail"></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-sm-12">
                                        <div class="phone-code-block info-msg">
                                            <div class="row">
                                                <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3 pad-r-0">
                                                    <div class="form-group i-size">
                                                        <!-- <i class="fa fa-mobile"></i> -->

                                                        <select name="phone_code" id="hphone_code">
                                                            <option value="">Code</option>
                                                            <?php if(!empty($mobcode_data) && isset($mobcode_data)): ?>
                                                            <?php foreach($mobcode_data as $mobcode): ?>
                                                            <option value="<?php echo e($mobcode['phonecode']); ?>" <?php if( $browser_country_code==$mobcode['iso'] ): ?> selected <?php endif; ?>>+<?php echo e($mobcode['phonecode']); ?> (<?php echo e($mobcode['iso3']); ?>)</option>
                                                            <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                        <div class="error" id="err_hphone_code"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-8 col-sm-9 col-md-9 col-lg-9">
                                                    <div class="form-group i-size">
                                                        <input type="text" placeholder="Mobile Number" id="hmobile_no" name="mobile_no" />
                                                        <div class="info-popup">We strongly recommend adding a phone number. This will help verify your account and keep it safe.</div>
                                                        <div class="error info-note" id="err_hmobile_no"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-sm-12">
                                        <div class="form-group i-size lock-size" id="hpassword_div">
                                            <!-- <i class="fa fa-lock"></i> -->
                                            <input type="password" placeholder="Password" id="hpassword" name="password" />
                                            <div class="error" id="err_hpassword"></div>
                                            <div class="info-popup">Create password you have never used before.this will help to keep your account safe</div>
                                            <div class="password-error-list" id="pass_error" style="display: none;">
                                                <ul>
                                                    <li id="ppass_length"><span>&nbsp;</span>Use 8 or more characters</li>
                                                    <li id="ppass_upper"><span>&nbsp;</span>Use upper case letters (e.g. ABC)</li>
                                                    <li id="ppass_lower"><span>&nbsp;</span>Use lower case letters (e.g. abc)</li>
                                                    <li id="ppass_number"><span>&nbsp;</span>Use a number (e.g. 1234)</li>
                                                    <li id="ppass_symbol"><span>&nbsp;</span>Use a symbol (e.g. !@#$) </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-sm-12">
                                        <div class="form-group i-size lock-size" id="hconfirm_password_div">
                                            <!-- <i class="fa fa-lock"></i> -->
                                            <input type="password" placeholder="Confirm Password" id="hconfirm_password" name="confirm_password" />
                                            <div class="error" id="err_hconfirm_password"></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-sm-12">
                                        <div class="form-group i-size lock-size">
                                            <!-- <i class="fa fa-map-marker"></i> -->
                                            <input type="text" class="haddress" placeholder="Address" name="address" id="autocomplete" value="<?php echo e(isset($browser_address) ? $browser_address : ''); ?>" maxlength="300" />
                                            <div class="error" id="err_haddress"></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-sm-12">
                                        <div class="form-group" id="hreferral_code_div" >
                                            <input type="text" placeholder="Referral Code" name="referral_code" id="hreferral_code" maxlength="10" />
                                            <div class="info-popup">Enter Referral Code</div>
                                            <div class="error" id="err_hreferral_code"></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-sm-12">
                                        <div class="form-group gender-margin">
                                            <label>Gender</label>
                                            <div class="radio-btns">
                                                <div class="radio-btn">
                                                    <input class="gender" type="radio" name="gender" id="male" value="Male" />
                                                    <label for="male">Male</label>
                                                    <div class="check"></div>
                                                </div>
                                                <div class="radio-btn">
                                                    <input class="gender" type="radio" name="gender" id="female" value="Female" />
                                                    <label for="female">Female</label>
                                                    <div class="check"></div>
                                                </div>
                                                <div class="error" id="err_hgender"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-sm-12">
                                        <div class="check-box">
                                            <input class="filled-in" id="hterms_condition" name="terms_condition" type="checkbox" required />
                                            <label for="hterms_condition">Agree Terms &amp; Conditions</label>
                                            <div class="error" id="err_hterms_condition"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="virgil_private_key" id="hpvirgil_private_key">
                                    <input type="hidden" name="refer_user_id" id="refer_user_id">
                                    
                                    <div class="col-sm-12 col-md-12 col-sm-12">
                                        <div class="from-sub-btn">
                                            <button type="button" class="green-btn" id="hbtn_submit_patient_signup">Create Account</button>

                                        </div>
                                        <div class="note" style="margin-top:8px;">By clicking Create Account, you agree to our <a href="javascript:void(0)">License Agreement</a> and have read and acknowledge our <a href="javascript:void(0)">Privacy Statement.</a></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="make-appointment-img">
                        <img src="<?php echo e(url('/')); ?>/public/front/images/appoint.png" alt="app" />
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

</body>

<script type="text/javascript">
    $(document).ready(function() {

        $('#hfirst_name').on('keyup blur', function() {
            $('#err_hfirst_name').show();
            $('#err_hfirst_name').html('');

            $("#hfname_div").addClass("valid");
            $("#hfname_div").removeClass("invalid");

            var hfirst_name = $(this).val();
            var alpha = /^[a-zA-Z]*$/;

            if ($.trim(hfirst_name) != '') {
                if (!alpha.test(hfirst_name)) {
                    $('#err_hfirst_name').html('Please enter valid first name.');

                    $("#hfname_div").addClass("invalid");
                    $("#hfname_div").removeClass("valid");
                    return false;
                } else {
                    $('#err_hfirst_name').html('');

                    $("#hfname_div").addClass("valid");
                    $("#hfname_div").removeClass("invalid");
                    return true;
                }
            }
        });

        $('#hlast_name').on('keyup blur', function() {
            $('#err_hlast_name').show();
            $('#err_hlast_name').html('');

            $("#hlname_div").addClass("valid");
            $("#hlname_div").removeClass("invalid");

            var hlast_name = $(this).val();
            var alpha = /^[a-zA-Z]*$/;

            if ($.trim(hlast_name) != '') {
                if (!alpha.test(hlast_name)) {
                    $('#err_hlast_name').html('Please enter valid last name.');

                    $("#hlname_div").addClass("invalid");
                    $("#hlname_div").removeClass("valid");
                    return false;
                } else {
                    $('#err_hlast_name').html('');

                    $("#hlname_div").addClass("valid");
                    $("#hlname_div").removeClass("invalid");
                    return true;
                }
            }
        });

        $('#hemail').on('blur keyup', function() {
            $('#err_hemail').show();
            $('#err_hemail').html('');
            var hemail = $(this).val();
            var hemail_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if ($.trim(hemail) != '') {
                if (!hemail_filter.test(hemail)) {
                    $('#err_hemail').html('Please enter valid email id.');

                    $("#hemail_div").addClass("invalid");
                    $("#hemail_div").removeClass("valid");
                    $("#hemail_div").removeClass("info-msg");
                    return false;
                }

                var token = $('input[name="_token"]').val();

                $.ajax({
                    url: "<?php echo e(url('/')); ?>/check_duplicate_email",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        _token: token,
                        email_id: hemail
                    },
                    success: function(res) {
                        if ($.trim(res.status) == 'error') {
                            $('#err_hemail').html('Account with this email already exists');
                            $('#hbtn_submit_patient_signup').attr('disabled', true);

                            $("#hemail_div").addClass("info-msg");
                            $("#hemail_div").removeClass("valid");
                            $("#hemail_div").removeClass("invalid");
                            return false;
                        } else if ($.trim(res.status) == 'success') {
                            $('#hbtn_submit_patient_signup').attr('disabled', false);

                            $("#hemail_div").addClass("valid");
                            $("#hemail_div").removeClass("invalid");
                            $("#hemail_div").removeClass("info-msg");
                            return true;
                        } else {
                            $('#err_hemail').html('Something has get wrong please try again later.');

                            $("#hemail_div").addClass("info-msg");
                            $("#hemail_div").removeClass("valid");
                            $("#hemail_div").removeClass("invalid");
                            return false;
                        }
                    }
                });
            }
        });

        $('#hreferral_code').on('blur keyup',function()
        {
            $('#err_hreferral_code').show();
            $('#err_hreferral_code').html('');
            var hreferral_code = $(this).val();
           
            if($.trim(hreferral_code) != '')
            {
            
                var token = $('input[name="_token"]').val();
                var refer_user_id = 0;
                
                $.ajax({
                    url      : "<?php echo e(url('/')); ?>/check_referral_code",
                    type     : "POST",
                    dataType : 'json',
                    data     : {_token:token, referral_code:hreferral_code},
                    success  : function(res)
                    {
                        if($.trim(res.status) == 'error')
                        {
                            $('#err_hreferral_code').html('Please enter valid referral code.');
                            $('#hbtn_submit_patient_signup').attr('disabled',true);

                            $("#hreferral_code_div").addClass("info-msg");
                            $("#hreferral_code_div").removeClass("valid");
                            $("#hreferral_code_div").removeClass("invalid");
                            return false; 
                        }
                        else if($.trim(res.status) == 'success')
                        {
                            $('#err_hreferral_code').html('');
                            $('#hbtn_submit_patient_signup').attr('disabled',false);

                            $('#refer_user_id').val(res.refer_user_id);

                            $("#hreferral_code_div").addClass("valid");
                            $("#hreferral_code_div").removeClass("invalid");
                            $("#hreferral_code_div").removeClass("info-msg");
                            return true;
                        }
                        else
                        {
                            $('#err_hreferral_code').html('Something has get wrong please try again later.');

                            $("#hreferral_code_div").addClass("info-msg");
                            $("#hreferral_code_div").removeClass("valid");
                            $("#hreferral_code_div").removeClass("invalid");
                            return false;
                        }
                    }
                });
            }
        });

        $('#hmobile_no').on('blur keyup', function() {
            $('#err_hmobile_no').show();
            $('#err_hmobile_no').html('');
            var hmobile_no = $(this).val();
            var pnumeric = /^[0-9]*$/;

            if ($.trim(hmobile_no) != '') {
                if (!pnumeric.test(hmobile_no)) {
                    $('#err_hmobile_no').html('Please enter valid mobile no.');

                    $("#hphone_div").addClass("invalid");
                    $("#hphone_div").removeClass("valid");
                    $("#hphone_div").removeClass("info-msg");
                    return false;
                }

                var token = $('input[name="_token"]').val();

                $.ajax({
                    url: "<?php echo e(url('/')); ?>/check_duplicate_mobile",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        _token: token,
                        mobile_no: hmobile_no
                    },
                    success: function(res) {
                        if ($.trim(res.status) == 'error') {
                            $('#err_hmobile_no').html('Mobile number already exists.');
                            $('#hbtn_submit_patient_signup').attr('disabled', true);

                            $("#hphone_div").addClass("info-msg");
                            $("#hphone_div").removeClass("valid");
                            $("#hphone_div").removeClass("invalid");
                            return false;
                        } else if ($.trim(res.status) == 'success') {
                            $('#hbtn_submit_patient_signup').attr('disabled', false);

                            $("#hphone_div").addClass("valid");
                            $("#hphone_div").removeClass("invalid");
                            $("#hphone_div").removeClass("info-msg");
                            return true;
                        } else {
                            $('#err_hmobile_no').html('Something went to wrong please try again later.');

                            $("#hphone_div").addClass("info-msg");
                            $("#hphone_div").removeClass("valid");
                            $("#hphone_div").removeClass("invalid");
                            return false;
                        }
                    }
                });
            }
        });

        $('#hpassword').on('keyup blur click', function() {
            $("#pass_error").css('display', 'block');

            $("#hpassword_div").removeClass("valid");
            $("#hpassword_div").removeClass("invalid");

            $("#ppass_length").addClass("invalid");
            $("#ppass_length").removeClass("valid");

            $("#ppass_upper").addClass("invalid");
            $("#ppass_upper").removeClass("valid");

            $("#ppass_lower").addClass("invalid");
            $("#ppass_lower").removeClass("valid");

            $("#ppass_number").addClass("invalid");
            $("#ppass_number").removeClass("valid");

            $("#ppass_symbol").addClass("invalid");
            $("#ppass_symbol").removeClass("valid");

            var hpassword = $(this).val();
            var pupper = /[A-Z]/g;
            var plower = /[a-z]/g;
            var pnumeric = /[0-9]/g;
            var psymbol = /[!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~]/g;

            if ($.trim(hpassword) != '') {
                if (hpassword.length >= 8) {
                    $("#ppass_length").addClass("valid");
                    $("#ppass_length").removeClass("invalid");
                } else {
                    $("#ppass_length").addClass("invalid");
                    $("#ppass_length").removeClass("valid");
                }

                if (hpassword.match(pupper)) {
                    $("#ppass_upper").addClass("valid");
                    $("#ppass_upper").removeClass("invalid");
                } else {
                    $("#ppass_upper").addClass("invalid");
                    $("#ppass_upper").removeClass("valid");
                }

                if (hpassword.match(plower)) {
                    $("#ppass_lower").addClass("valid");
                    $("#ppass_lower").removeClass("invalid");
                } else {
                    $("#ppass_lower").addClass("invalid");
                    $("#ppass_lower").removeClass("valid");
                }

                if (hpassword.match(pnumeric)) {
                    $("#ppass_number").addClass("valid");
                    $("#ppass_number").removeClass("invalid");
                } else {
                    $("#ppass_number").addClass("invalid");
                    $("#ppass_number").removeClass("valid");
                }

                if (hpassword.match(psymbol)) {
                    $("#ppass_symbol").addClass("valid");
                    $("#ppass_symbol").removeClass("invalid");
                } else {
                    $("#ppass_symbol").addClass("invalid");
                    $("#ppass_symbol").removeClass("valid");
                }

                if (hpassword.length >= 8 && hpassword.match(pupper) && hpassword.match(plower) && hpassword.match(pnumeric) && hpassword.match(psymbol)) {
                    $("#hpassword_div").addClass("valid");
                    $("#hpassword_div").removeClass("invalid");
                } else {
                    $("#hpassword_div").addClass("invalid");
                    $("#hpassword_div").removeClass("valid");
                }
            }
        });

        $('#hconfirm_password').on('keyup blur', function() {
            $('#err_hconfirm_password').show();
            $('#err_hconfirm_password').html('');

            $("#hconfirm_password_div").removeClass("valid");
            $("#hconfirm_password_div").removeClass("invalid");

            var hpassword = $("#hpassword").val();
            var hconfirm_password = $("#hconfirm_password").val();

            if ($.trim(hconfirm_password) != '') {
                if ($.trim(hpassword) != $.trim(hconfirm_password)) {
                    $('#err_hconfirm_password').html('Password & Confirm Password does not match.');

                    $("#hconfirm_password_div").addClass("invalid");
                    $("#hconfirm_password_div").removeClass("valid");
                } else {
                    $('#err_hconfirm_password').html('');

                    $("#hconfirm_password_div").addClass("valid");
                    $("#hconfirm_password_div").removeClass("invalid");
                }
            }
        });

        $("#hbtn_submit_patient_signup").click(function() {
            PatientHomeSignupValidationCheck();
        });

        $("#hfirst_name, #hlast_name, #hemail, #hmobile_no, #hphone_code, #hpassword, #hconfirm_password, .haddress, .gender").on('keypress', function(event) {
            var keycode = event.keyCode || event.which;
            if (keycode == '13') {
                PatientHomeSignupValidationCheck();
            }
        });

        function PatientHomeSignupValidationCheck() {
            var hfirst_name = $('#hfirst_name').val();
            var hlast_name = $('#hlast_name').val();
            var hemail = $('#hemail').val();
            var hmobile_no = $('#hmobile_no').val();
            var hphone_code = $('#hphone_code').val();
            var haddress = $('.haddress').val();
            var hpassword = $('#hpassword').val();
            var hconfirm_password = $('#hconfirm_password').val();
            var hgender = $('.gender').is(':checked');
            var hgender_value = $("input[name='gender']:checked").val();
            var hterms_condition = $("#hterms_condition").is(":checked");
            var hemail_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var alpha = /^[a-zA-Z]*$/;
            var numeric = /^[0-9]*$/;

            if ($.trim(hfirst_name) == '') {
                $('#hfirst_name').focus();
                $('#err_hfirst_name').show();
                $('#err_hfirst_name').html('Please enter first name.');
                $('#err_hfirst_name').fadeOut(4000);
                return false;
            } else if (!alpha.test(hfirst_name)) {
                $('#hfirst_name').focus();
                $('#err_hfirst_name').show();
                $('#err_hfirst_name').html('Please enter valid first name.');
                $('#err_hfirst_name').fadeOut(4000);
                return false;
            } else if ($.trim(hlast_name) == '') {
                $('#hlast_name').focus();
                $('#err_hlast_name').show();
                $('#err_hlast_name').html('Please enter last name.');
                $('#err_hlast_name').fadeOut(4000);
                return false;
            } else if (!alpha.test(hlast_name)) {
                $('#hlast_name').focus();
                $('#err_hlast_name').show();
                $('#err_hlast_name').html('Please enter valid last name.');
                $('#err_hlast_name').fadeOut(4000);
                return false;
            } else if ($.trim(hemail) == '') {
                $('#hemail').focus();
                $('#err_hemail').show();
                $('#err_hemail').html('Please enter email id.');
                $('#err_hemail').fadeOut(4000);
                return false;
            } else if (!hemail_filter.test(hemail)) {
                $('#hemail').focus();
                $('#err_hemail').show();
                $('#err_hemail').html('Please enter valid email id.');
                $('#err_hemail').fadeOut(4000);
                return false;
            } else if ($.trim(hphone_code) == '') {
                $('#hphone_code').focus();
                $('#err_hphone_code').show();
                $('#err_hphone_code').html('Please select mobile code.');
                $('#err_hphone_code').fadeOut(4000);
                return false;
            } else if ($.trim(hmobile_no) == '') {
                $('#hmobile_no').focus();
                $('#err_hmobile_no').show();
                $('#err_hmobile_no').html('Please enter mobile number.');
                $('#err_hmobile_no').fadeOut(4000);
                return false;
            } else if (!numeric.test(hmobile_no)) {
                $('#hmobile_no').focus();
                $('#err_hmobile_no').show();
                $('#err_hmobile_no').html('Please enter valid mobile.');
                $('#err_hmobile_no').fadeOut(4000);
                return false;
            } else if ($.trim(hpassword) == '') {
                $('#hpassword').focus();
                $('#err_hpassword').show();
                $('#err_hpassword').html('Please enter Password.');
                $('#err_hpassword').fadeOut(4000);
                return false;
            } else if ($.trim(hpassword).length < 8) {
                $('#hpassword').focus();
                $('#err_hpassword').show();
                $('#err_hpassword').html('For better security, use a password 8 characters long.');
                $('#err_hpassword').fadeOut(4000);
                return false;
            } else if ($.trim(hconfirm_password) == '') {
                $('#hconfirm_password').focus();
                $('#err_hconfirm_password').show();
                $('#err_hconfirm_password').html('Please enter Confirm Password.');
                $('#err_hconfirm_password').fadeOut(4000);
                return false;
            } else if ($.trim(hpassword) != $.trim(hconfirm_password)) {
                $('#hconfirm_password').focus();
                $('#err_hconfirm_password').show();
                $('#err_hconfirm_password').html('Password & Confirm Password does not match.');
                $('#err_hconfirm_password').fadeOut(4000);
                return false;
            } else if ($.trim(haddress) == '') {
                $('.haddress').focus();
                $('#err_haddress').show();
                $('#err_haddress').html('Please enter address.');
                $('#err_haddress').fadeOut(4000);
                return false;
            } else if ($.trim(hgender) == 'false') {
                $('#hgender').focus();
                $('#err_hgender').show();
                $('#err_hgender').html('Please select gender.');
                $('#err_hgender').fadeOut(4000);
                return false;
            } else if (hterms_condition == '' && hterms_condition == false) {
                $('#hterms_condition').focus();
                $('#err_hterms_condition').show();
                $('#err_hterms_condition').html('Please check terms & condition.');
                $('#err_hterms_condition').fadeOut(4000);
                return false;
            } else {
                var card_data = create_card(hemail);
                if ($.trim(card_data[1]) == 'success') {
                    $("#hpvirgil_private_key").val(card_data[0]);

                    var form = $('#hpatient_signup_form')[0];
                    var formData = new FormData(form);

                    $.ajax({
                        url: '<?php echo e(url("/")); ?>/patient/signup/store',
                        type: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function(res) {
                            hideProcessingOverlay();
                            if (res.status == 'success') {
                                // reset signup form
                                $('#hpatient_signup_form')[0].reset();

                                $("#pass_error").css('display', 'none');

                                $("#hpatient_signup_success_msg").html(res.message);
                                $("#hpatient_signup_success").css('display', 'block').delay(4000).fadeOut();
                                $('#user_id_otp').val(res.user_id);

                                setTimeout(function() {
                                    $('#otp_verify_modal').modal('show');
                                }, 4000);
                            } else {
                                $("#hpatient_signup_error_msg").html(res.message);
                                $("#hpatient_signup_error").css('display', 'block').delay(4000).fadeOut();
                            }
                        }
                    });
                } else {
                    hideProcessingOverlay();
                    $("#hpatient_signup_error_msg").html('Something went wrong while registration, Please try again.');
                    $("#hpatient_signup_error").css('display', 'block').delay(4000).fadeOut();
                    return false;
                }
            }
        }

    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>