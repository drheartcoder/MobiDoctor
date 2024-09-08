
@include('front.login')
@include('front.forgot_password')
@include('front.verify_mobile')
@include('front.enter_mobile')
@include('front.otp_verify')

@include('virgil.virgil')
@include('google.googleapi')

<footer>
    <div class="container">
        <div class="footer-top-block">
            
            <form name="frm_subscribe" id="frm_subscribe" method="post" action="{{url('/')}}/subscribe_newsletter">
            {{csrf_field()}}
                <div class="email-wrapper">
                    {{-- <div id="newsletter_op_status" style="display: none">
                        <div class="alert alert-success" id="status_holder"></div>
                    </div> --}}
                    <input type="text" name="subscribe_email_id" id="subscribe_email_id" placeholder="Email Address"/>
                    <div class="error" id="err_subscribe_email_id"></div>
                    <div class="error" id="success_subscribe_email_id"></div>
                    <button type="button" id="btn_subscriber"><i class="fa fa-arrow-circle-o-right"></i></button>
                </div>
            </form>
            
            <?php
                $facebook_link  = isset($social_links['facebook_link']) ? $social_links['facebook_link'] : '';
                $twitter_link   = isset($social_links['twitter_link']) ? $social_links['twitter_link'] : '';
                $pinterest_link = isset($social_links['pinterest_link']) ? $social_links['pinterest_link'] : '';
                $linkedin_link  = isset($social_links['linkedin_link']) ? $social_links['linkedin_link'] : '';
                $google_link  = isset($social_links['google_link']) ? $social_links['google_link'] : '';
            ?>


            <div class="social-list">
                <ul>
                    @if( !empty( $facebook_link ) && $facebook_link != null )
                        <li><a href="{{ $facebook_link or 'javascript:void(0)' }}" target="_blank" ><i class="fa fa-facebook"></i></a></li>
                    @endif

                    @if( !empty( $twitter_link ) && $twitter_link != null )
                        <li><a href="{{ $twitter_link or 'javascript:void(0)' }}" target="_blank" ><i class="fa fa-twitter"></i></a></li>
                    @endif

                     @if( !empty( $google_link ) && $google_link != null )
                        <li><a href="{{ $google_link or 'javascript:void(0)' }}" target="_blank" ><i class="fa fa-google-plus"></i></a></li>
                    @endif

                    @if( !empty( $pinterest_link ) && $pinterest_link != null )
                        <li><a href="{{ $pinterest_link or 'javascript:void(0)' }}" target="_blank" ><i class="fa fa-pinterest-p"></i></a></li>
                    @endif

                    @if( !empty( $linkedin_link ) && $linkedin_link != null )
                        <li><a href="{{ $linkedin_link or 'javascript:void(0)' }}" target="_blank" ><i class="fa fa-linkedin"></i></a></li>
                    @endif
                </ul>
            </div>
            <div class="clearfix"></div>
           <div class="count-wrapper">
               {{--  <ul>
                    <li>
                        <div class="count-block">
                            <p>{{ isset( $user_count['patient'] ) ? $user_count['patient'] : 0 }}</p>
                            <span>Registered User</span>
                        </div>
                    </li>
                    <li>
                        <div class="count-block reg-doctor">
                            <p>{{ isset( $user_count['doctor'] ) ? $user_count['doctor'] : 0 }}</p>
                            <span>Registered Doctor</span>
                        </div>
                    </li>
                    <li>
                        <div class="count-block">
                            <p>{{ isset( $user_count['subscribers'] ) ? $user_count['subscribers'] : 0 }}</p>
                            <span>Subscribers</span>
                        </div>
                    </li>
                </ul>
                <div class="clearfix"></div> --}}
            </div>
           
         
        </div>
    </div>
    
    <div class="footer-menu">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-5 col-lg-4">
                    <p>&copy; 2019 <a href="{{url('/')}}">MobiDoctor</a>. All rights reserved.</p>
                </div>
                <div class="col-sm-6 col-md-7 col-lg-8">
                    <ul>
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('/')}}/about_us">About Us</a></li>
                        <li><a href="{{url('/')}}/blog">Blog</a></li>
                        <li><a href="{{url('/')}}/for_doctor">For Doctor</a></li>
                        <li><a href="{{url('/')}}/for_business">For Business</a></li>
                        <li><a href="{{url('/')}}/pregnancy">Pregnancy</a></li>
                        <li><a href="{{url('/')}}/how_it_work">How it Works</a></li>
                        <li><a href="{{url('/')}}/contact_us">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
        
    <a class="cd-top hidden-xs hidden-sm" href="#0"><i class="fa fa-angle-up"></i></a>
</footer>

<script>
/*back to top arrow*/
jQuery(document).ready(function($){
    // browser window scroll (in pixels) after which the "back to top" link is shown
    var offset = 300,
        //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
        offset_opacity = 1200,
        //duration of the top scrolling animation (in ms)
        scroll_top_duration = 700,
        //grab the "back to top" link
        $back_to_top = $('.cd-top');

    //hide or show the "back to top" link
    $(window).scroll(function(){
        ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
        if( $(this).scrollTop() > offset_opacity ) { 
            $back_to_top.addClass('cd-fade-out');
        }
    });

    //smooth scroll to top
    $back_to_top.on('click', function(event){
        event.preventDefault();
        $('body,html').animate({
            scrollTop: 0 ,
            }, scroll_top_duration
        );
    });

});    
</script>
<script type="text/javascript">
    $(document).ready(function()
    {
        $('#frm_subscribe').submit(function(e){
            e.preventDefault();
            $("#btn_subscriber").click();
        });

        $("#btn_subscriber").click(function() {
            var subscribe_email_id = $("#subscribe_email_id").val();
            var pemail_filter    = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if($.trim(subscribe_email_id) == '')
            {
                $('#subscribe_email_id').focus();
                $('#err_subscribe_email_id').show();
                $('#err_subscribe_email_id').html('Please enter email address.');
                $('#err_subscribe_email_id').fadeOut(4000);
              return false;  
            }
            else if(!pemail_filter.test(subscribe_email_id))
            {
                $('#subscribe_email_id').focus();
                $('#err_subscribe_email_id').show();
                $('#err_subscribe_email_id').html('Please enter valid email address.');
                $('#err_subscribe_email_id').fadeOut(4000);
                return false;  
            }
            else
            {
                var url = "{{ url('/') }}";
                $.ajax({
                    url      : url+"/subscribe_newsletter",
                    type     : 'POST',
                    data     : $("#frm_subscribe").serialize(),
                    dataType : 'json',
                    success:function(response)
                    {
                        $("#frm_subscribe")[0].reset();
                        if(response.status=="SUCCESS")
                        {
                            $("#success_subscribe_email_id").html(response.msg);
                            $('#success_subscribe_email_id').fadeOut(4000);
                            /*$("#status_holder").removeClass("alert-danger").addClass('alert-success');
                            $("#status_holder").html(response.msg);
                            $("#newsletter_op_status").fadeIn();*/
                        }
                        else
                        {
                            $("#err_subscribe_email_id").html(response.msg);
                            $('#err_subscribe_email_id').fadeOut(4000);
                           /* $("#status_holder").removeClass("alert-success").addClass('alert-danger');
                            $("#status_holder").html(response.msg);
                            $("#newsletter_op_status").fadeIn();*/
                        }

                      /*  setTimeout(function()
                        {
                            $("#newsletter_op_status").fadeOut();
                            $("#status_holder").html("");
                        },5000);*/
                    }
                });
             
            }
        });
    });
</script>
</html>