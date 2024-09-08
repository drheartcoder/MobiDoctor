<?php

    $admin_verified = isset( $user_data['admin_verified'] ) ? $user_data['admin_verified'] : '0';
    
    if( $admin_verified == '0' ):
        $link_status = ' disabled';

        $upcoming = $completed = $availability = $my_patients = $transactions = $invitation = $contact_us = $faq = 'javascript:void(0)';
    else:
        $link_status  = '';

        $upcoming     = url('/doctor/my_consultation/upcoming');
        $completed    = url('/doctor/my_consultation/completed');
        $availability = url('/doctor/availability');
        $my_patients  = url('/doctor/my_patients');
        $transactions = url('/doctor/transactions');
        $invitation   = url('/doctor/settings/invitation');
        $contact_us   = url('/doctor/settings/contact_us');
        $faq          = url('/doctor/settings/faq');
        
    endif;
?>

<div class="leftbar">
    <ul>
        <li>
            <a class="<?php if(Request::segment(2) == 'dashboard'){ echo 'active'; } ?>" href="<?php echo e(url('/')); ?>/doctor/dashboard">Dashboard</a>
        </li>
        
        <li><a class="has-menu <?php echo e($link_status); ?> <?php if(Request::segment(2) == 'my_consultation' && Request::segment(3) == 'upcoming' || Request::segment(3) == 'completed' ){ echo 'active'; } ?>"" href="javascript:void(0)" >My Consultation</a>
             <ul class="sub-menu" style="<?php if(Request::segment(2) == 'my_consultation') { echo "display: block"; } else { echo "display: none"; } ?>">
                <li>
                    <a class="<?php if(Request::segment(3) == 'upcoming'){ echo 'active'; } echo $link_status; ?>" href="<?php echo e($upcoming); ?>">-- Upcoming</a>
                </li>
                <li>
                    <a class="<?php if(Request::segment(3) == 'completed'){ echo 'active'; } echo $link_status; ?>" href="<?php echo e($completed); ?>">-- Completed</a>
                </li>
             </ul>
        </li>

        <li>
            <a class="<?php if(Request::segment(2) == 'availability'){ echo 'active'; } echo $link_status; ?>" href="<?php echo e($availability); ?>">My Availability</a>
        </li>

        <li>
            <a class="<?php if(Request::segment(2) == 'my_patients'){ echo 'active'; } echo $link_status; ?>" href="<?php echo e(url('/')); ?>/doctor/my_patients">Patients</a>
        </li>

        <li>
            <a class="has-menu <?php if(Request::segment(2) == 'my_account' && Request::segment(3) == 'about_me' || Request::segment(3) == 'change_password' || Request::segment(3) == 'medical_practice' || Request::segment(3) == 'medical_practice' || Request::segment(3) == 'medical_qualifications' || Request::segment(3) == 'document_verification' || Request::segment(3) == 'bank_details' ){ echo 'active'; } ?>" href="javascript:void(0)">My Account</a>
            <ul class="sub-menu" style="<?php if(Request::segment(2) == 'my_account') { echo "display: block"; } else { echo "display: none"; } ?>">
                <li>
                    <a class="<?php if(Request::segment(3) == 'about_me'){ echo 'active'; } ?>" href="<?php echo e(url('/')); ?>/doctor/my_account/about_me">-- About Me</a>
                </li>
                <?php if(isset($user_data['social_login']) && $user_data['social_login'] == 'no'): ?>
                <li>
                    <a class="<?php if(Request::segment(3) == 'change_password'){ echo 'active'; } ?>" href="<?php echo e(url('/')); ?>/doctor/my_account/change_password">-- Change Password</a>
                </li>
                <?php endif; ?>
                <li>
                    <a class="<?php if(Request::segment(3) == 'medical_practice'){ echo 'active'; } ?>" href="<?php echo e(url('/')); ?>/doctor/my_account/medical_practice">-- Medical Practice</a>
                </li>
                <li>
                    <a class="<?php if(Request::segment(3) == 'medical_qualifications'){ echo 'active'; } ?>" href="<?php echo e(url('/')); ?>/doctor/my_account/medical_qualifications">-- Medical Qualifications</a>
                </li>
                <li>
                    <a class="<?php if(Request::segment(3) == 'document_verification'){ echo 'active'; } ?>" href="<?php echo e(url('/')); ?>/doctor/my_account/document_verification">-- Document &amp; Verification</a>
                </li>
                <li>
                    <a class="<?php if(Request::segment(3) == 'bank_details'){ echo 'active'; } ?>" href="<?php echo e(url('/')); ?>/doctor/my_account/bank_details">-- Bank Details</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="<?php if(Request::segment(2) == 'transactions'){ echo 'active'; } echo $link_status; ?>" href="<?php echo e($transactions); ?>">My Transactions</a>
        </li>

        <li>
            <a class="<?php if(Request::segment(2) == 'notification'){ echo 'active'; } ?>" href="<?php echo e(url('/')); ?>/doctor/notification">Notification</a>
        </li>

        <li>
            <a class="has-menu <?php echo e($link_status); ?> <?php if(Request::segment(2) == 'settings' && Request::segment(3) == 'invitation' || Request::segment(3) == 'contact_us'){ echo 'active'; } ?>" href="javascript:void(0)">Settings</a>
             <ul class="sub-menu" style="<?php if(Request::segment(2) == 'settings') { echo "display: block"; } else {echo "display: none";}?>">
                <li>
                    <a class="<?php if(Request::segment(3) == 'invitation'){ echo 'active'; } echo $link_status; ?>" href="<?php echo e($invitation); ?>">-- Invitation</a>
                </li>

                <li>
                    <a class="<?php if(Request::segment(3) == 'faq'){ echo 'active'; } echo $link_status; ?>" href="<?php echo e($faq); ?>">-- FAQ</a>
                </li>

                <li>
                    <a class="<?php if(Request::segment(3) == 'contact_us'){ echo 'active'; } echo $link_status; ?>" href="<?php echo e($contact_us); ?>">-- Contact Us</a>
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