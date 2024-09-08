@extends('front.layout.master')
@section('main_content')

<!-- Changes done by Amol -->
<body>

	<div class="home-banner-section">
        <div class="container">
            <div class="banner-content">
                <h2>Appointments to suit your schedule</h2>
                <h1><span>Mobi</span>doctor</h1>
                <h5>We're open 8 am - 8 pm, 7 days a week</h5>
                <p>Download our free APP </p>
                <ul class="app-btns">
                    <li>
                        <a href="javascript:void(0)"><img src="{{ url('/') }}/public/front/images/app-store-img.png" class="img-responsive" alt="MobiDoctor"/></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{ url('/') }}/public/front/images/google-play-img.png" class="img-responsive" alt="MobiDoctor"/></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="banner-bootom-strip">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="bottom-strip-block">
                        <div class="icon-block bg-img">&nbsp;</div>
                        <div class="content-block">
                            <p>The UK'S </p>
                            <p>Number 1 online Doctor</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="bottom-strip-block"><img src="{{url('/')}}/public/front/images/trust-pilot.png" class="img-responsive" alt="MobiDoctor"/></div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="bottom-strip-block secure">
                        <div class="icon-block bg-img">&nbsp;</div>
                        <div class="content-block">
                            <p>CQC regulated, Secure, Private </p>
                            <p>fully-encrypted video consultations</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="membership-section">
        <div class="container">
            <div class="relative-block">
                <div class="row">
                    <div class="col-md-7 col-lg-7">
                        <div class="membership-content">
                            <h4>Membership</h4>
                            <p>Our service is open to members and non-members. Membership provides numerous options, including up to 50% off your appointment today.  You also get reduced prices on a number of services, access to exclusive offers, and premium content to help with your ongoing good health and well-being.</p>
                            <p>What's more, our membership subscription price is incredibly affordable.  It works out to a few pence a day, which is some of the best money you can possibly spend.  Our membership helps you to save money on routine medical care, and keep you at your best - physically and mentally - every day.</p>
                            <a class="green-btn" href="javascript:void(0)">Find Out More</a>
                        </div>
                    </div>
                </div>
                <div class="membership-img"><img src="{{url('/')}}/public/front/images/doctor-img1.jpg" class="img-responsive" alt="MobiDoctor"/></div>
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
                        <h5>Book an appointment</h5>
                        <p>You can queue up to see a doctor in just minutes, or schedule an appointment for a pre-set time that works for you and your busy schedule.</p>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="how-it-block see-doctor">
                        <div class="how-it-img bg-img">&nbsp;</div>
                        <h5>See a doctor online</h5>
                        <p>Using our app or our website, you can talk face-to-face with a certified and licensed UK-based GP.  All video chats are fully encrypted,</p>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="how-it-block feeling-better">
                        <div class="how-it-img bg-img">&nbsp;</div>
                        <h5>Start feeling better</h5>
                        <p>Using our app or our website, you can talk face-to-face with a certified and licensed UK-based GP.  All video chats are fully encrypted,</p>
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
                            <a href="javascript:void(0)" class="review-user-img"><img src="{{url('/')}}/public/front/images/user-img1.png" class="img-responsive" alt="MobiDoctor"/><span class="view-more">View More</span></a>
                            <p>Katherine's story</p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
                        <div class="review-user">
                            <a href="javascript:void(0)" class="review-user-img"><img src="{{url('/')}}/public/front/images/user-img2.png" class="img-responsive" alt="MobiDoctor"/><span class="view-more">View More</span></a>
                            <p>Katherine's story</p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
                        <div class="review-user">
                            <a href="javascript:void(0)" class="review-user-img"><img src="{{url('/')}}/public/front/images/user-img3.png" class="img-responsive" alt="MobiDoctor"/><span class="view-more">View More</span></a>
                            <p>Emily's story</p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
                        <div class="review-user">
                            <a href="javascript:void(0)" class="review-user-img"><img src="{{url('/')}}/public/front/images/user-img4.png" class="img-responsive" alt="MobiDoctor"/><span class="view-more">View More</span></a>
                            <p>Natalie's story</p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
                        <div class="review-user">
                            <a href="javascript:void(0)" class="review-user-img"><img src="{{url('/')}}/public/front/images/user-img5.png" class="img-responsive" alt="MobiDoctor"/><span class="view-more">View More</span></a>
                            <p>Edward's story</p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
                        <div class="review-user">
                            <a href="javascript:void(0)" class="review-user-img"><img src="{{url('/')}}/public/front/images/user-img6.png" class="img-responsive" alt="MobiDoctor"/><span class="view-more">View More</span></a>
                            <p>Charlie's story</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="membership-package-section home-section">
        <div class="container">
            <h2>Compare the Benefits of an All-inclusive Membership Package</h2>
            <div class="package-left-section">
                <h5>Save up to 50% off your appointment today.Access exclusive offers and premium well-being content.</h5>
                <div class="prescription">Prescription Admin Fee</div>
            </div>
            <div class="package-right-section">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <a href="javascript:void(0)" class="membership-block">
                            <h4>Your Member benefits</h4>
                            <span class="price-block">
                                <b>£3</b>
                                <span>per month</span>
                            </span>
                            <p>£20 Appointments</p>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <a href="javascript:void(0)" class="membership-block">
                            <h4>Non-Member costs</h4>
                            <span class="price-block">
                                <b>£30</b>
                                <span>per month</span>
                            </span>
                            <p>£30 Appointments</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="online-doctor-section home-section">
        <div class="container">
            <div class="title">
                <h2>See an online doctor in minutes</h2>
                <p>Join the thousands of people just like you who use Push Doctor's online service.  You can get medical advice, prescriptions, and more, all from the comfort of your home or office.  And since all of our GPs are fully licensed and certified, you know you're getting quality care. It's just like going to a doctor's office, only quicker and easier.  There's no travelling, no waiting, and no hanging around with a bunch of sick people. It's health care for the 21st century!</p>
            </div>
            <div class="mobile-img visible-xs visible-sm"><img src="{{url('/')}}/public/front/images/mobile-img.jpg" class="img-responsive" alt="MobiDoctor"/></div>
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
                    <div class="mobile-img"><img src="{{url('/')}}/public/front/images/mobile-img.jpg" class="img-responsive" alt="MobiDoctor"/></div>
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
            <a href="javascript:void(0)" class="green-btn">See Doctor Online</a>
        </div>
    </div>

    <div class="app-section">
        <div class="container">
            <div class="relative-block">
                <div class="row">
                    <div class="col-md-4 col-lg-4">&nbsp;</div>
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <div class="app-content">
                            <h2>See a <span>Doctor Today,</span> Wherever you are</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque varius gravida neque, at cursus nisi ullamcorper sit amet. </p>
                            <a href="javascript:void(0)" class="green-btn">See Doctor Now</a>
                            <h5>Or download our free APP </h5>
                            <ul class="app-btns">
                                <li><a href="javascript:void(0)"><img src="{{url('/')}}/public/front/images/app-store-img.png" class="img-responsive" alt="MobiDoctor"></a></li>
                                <li><a href="javascript:void(0)"><img src="{{url('/')}}/public/front/images/google-play-img.png" class="img-responsive" alt="MobiDoctor"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <a class="app-img" data-toggle="modal" href="#video_modal"><img src="{{url('/')}}/public/front/images/mobile-img2.png" class="img-responsive" alt=""/></a>
            </div>
        </div>
    </div>

    <div class="call-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <h4><i class="fa fa-phone"></i> If you Have Any Questions Call Us On <span>(010)123-456-7890</span></h4>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <a href="javascript:void(0)" class="black-btn">Read more</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade video-modal" id="video_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal"><img src="{{url('/')}}/public/front/images/close.png" class="img-responsive" alt=""/></button>
                <div class="modal-body">
                    <div class="vodeo-wrapper">
                        <div class="home-video"> 
                            <video controls><source src="{{url('/')}}/public/front/videos/sample-video.mp4" type="video/mp4">Your browser does not support HTML5 video. </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--model popup end here--> 

</body>

@endsection