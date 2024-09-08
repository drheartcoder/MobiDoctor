<div class="leftbar">
    <ul>
        <li>
            <a class="<?php if(Request::segment(2) == 'dashboard'){ echo 'active'; } ?>" href="{{ url('/') }}/patient/dashboard">Dashboard</a>
        </li>
        
        <li><a href="{{ url('/') }}/patient/consultation">Book New Consultation</a></li>
        <li><a href="{{ url('/') }}/patient/consultation">Book New Vaccine</a></li>

        <li><a class="has-menu <?php if(Request::segment(2) == 'my_consultation' && Request::segment(3) == 'upcoming' || Request::segment(3) =='completed' ) { echo 'active'; } ?>" href="javascript:void(0)">My Consultation</a>
             <ul class="sub-menu" style="<?php if(Request::segment(2) == 'my_consultation') {echo "display: block";} else {echo "display: none";}?>">
                <li><a class="<?php if(Request::segment(3) == 'upcoming'){ echo 'active'; } ?>" href="{{ url('/') }}/patient/my_consultation/upcoming">-- Upcoming</a></li>
                <li><a class="<?php  if(Request::segment(3) == 'completed'){ echo 'active'; } ?>" href="{{ url('/') }}/patient/my_consultation/completed">-- Completed</a></li>
             </ul>
        </li>

        <li><a class="has-menu <?php if(Request::segment(2) == 'my_health' && Request::segment(3) == 'medical_history' || Request::segment(3) =='medication' || Request::segment(3) =='lifestyle') { echo 'active'; } ?>" href="javascript:void(0)">My Health</a>
             <ul class="sub-menu" style="<?php if(Request::segment(2) == 'my_health') {echo "display: block";} else {echo "display: none";}?>">
                <li><a class="<?php if(Request::segment(3) == 'medical_history' ||  Request::segment(3) =='medication' || Request::segment(3) =='lifestyle' || Request::segment(3) =='medication'){ echo 'active'; } ?>" href="{{ url('/') }}/patient/my_health/medical_history">-- Medical History</a></li>
             </ul>
        </li>

        <li>
            <a class="has-menu <?php if(Request::segment(2) == 'my_account' && Request::segment(3) == 'about_me' || Request::segment(3) == 'change_password' || Request::segment(3) == 'family_member' || Request::segment(3) == 'card'){ echo 'active'; } ?>" href="javascript:void(0)">My Account</a>
            <ul class="sub-menu" style="<?php if(Request::segment(2) == 'my_account') {echo "display: block";} else {echo "display: none";}?>">
                <li>
                    <a class="<?php if(Request::segment(3) == 'about_me'){ echo 'active'; } ?>" href="{{ url('/') }}/patient/my_account/about_me">-- About Me</a>
                </li>
                @if(isset($user_data['social_login']) && $user_data['social_login'] == 'no')
                <li>
                    <a class="<?php if(Request::segment(3) == 'change_password'){ echo 'active'; } ?>" href="{{ url('/') }}/patient/my_account/change_password">-- Change Password</a>
                </li>
                @endif
                <li>
                    <a class="<?php if(Request::segment(3) == 'family_member'){ echo 'active'; } ?>" href="{{ url('/') }}/patient/my_account/family_member">-- Family Member</a>
                </li>
                <li>
                    <a class="<?php if(Request::segment(3) == 'card'){ echo 'active'; } ?>" href="{{ url('/') }}/patient/my_account/card">-- Card Details</a>
                </li>
            </ul>
        </li>

        <li><a class="has-menu <?php if(Request::segment(2) == 'transactions' && Request::segment(3) == 'consultation' || Request::segment(3) =='subscription') { echo 'active'; } ?>" href="javascript:void(0)">My Transactions</a>
             <ul class="sub-menu" style="<?php if(Request::segment(2) == 'transactions') {echo "display: block";} else {echo "display: none";}?>">
                <li><a class="<?php if(Request::segment(3) == 'subscription'){ echo 'active'; } ?>" href="{{ url('/') }}/patient/transactions/subscription">-- Subscription</a></li>
                
                <li><a class="<?php if(Request::segment(3) == 'consultation'){ echo 'active'; } ?>" href="{{ url('/') }}/patient/transactions/consultation">-- Consultation</a></li>
             </ul>
        </li>

        <li><a class="has-menu <?php if(Request::segment(2) == 'documents' && Request::segment(3) == 'prescription' || Request::segment(3) =='medical_certificate') { echo 'active'; } ?>" href="javascript:void(0)">My Documents</a>
             <ul class="sub-menu" style="<?php if(Request::segment(2) == 'documents') {echo "display: block";} else {echo "display: none";}?>">
                <li><a class="<?php if(Request::segment(3) == 'prescription'){ echo 'active'; } ?>" href="{{ url('/') }}/patient/documents/prescription">-- Prescription</a></li>
                
                <li><a class="<?php if(Request::segment(3) == 'medical_certificate'){ echo 'active'; } ?>" href="{{ url('/') }}/patient/documents/medical_certificate">-- Medical Certificate</a></li>
             </ul>
        </li>

        {{-- <li><a href="{{ url('/') }}/patient/transactions">My Transactions</a></li> --}}
        <li><a class="<?php if(Request::segment(2) == 'notification'){ echo 'active'; } ?>" href="{{ url('/') }}/patient/notification">My Notification</a></li>

        <li>
            <a class="has-menu <?php if(Request::segment(2) == 'settings' && Request::segment(3) == 'invitation' || Request::segment(3) == 'contact_us'){ echo 'active'; } ?>" href="javascript:void(0)">Settings</a>
             <ul class="sub-menu" style="<?php if(Request::segment(2) == 'settings') {echo "display: block";} else {echo "display: none";}?>">
                <li>
                    <a class="<?php if(Request::segment(3) == 'invitation'){ echo 'active'; } ?>" href="{{ url('/') }}/patient/settings/invitation">-- Invitation</a>
                </li>
                <li>
                    <a class="<?php if(Request::segment(3) == 'contact_us'){ echo 'active'; } ?>" href="{{ url('/') }}/patient/settings/contact_us">-- Contact Us</a>
                </li>
             </ul>
        </li>

    </ul>
</div>


<script type="text/javascript">
    $('.leftbar li a').click(function(){
        // $(this).toggleClass('active');
        $(this).next('.sub-menu').slideToggle();
        $(this).parent().siblings().children().next('.sub-menu').slideUp();
    });
</script>