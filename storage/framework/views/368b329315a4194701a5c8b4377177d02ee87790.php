<?php $admin_path = config('app.project.admin_panel_slug'); ?>

<?php
    $admin_type = '';
    $user = Sentinel::check();
    if($user->inRole(config('app.project.admin_panel_slug')))
    {
        $admin_type = 'ADMIN';
    }
    
    if ($user->inRole('sub-admin')) 
    {
        $admin_type = 'SUB-ADMIN';
    }
?>

<div id="sidebar" class="navbar-collapse collapse">
   <!-- BEGIN Navlist -->
    <ul class="nav nav-list">
        
        <?php if($admin_type == 'ADMIN' || $admin_type == 'SUB-ADMIN'): ?>
        <li class="<?php  if(Request::segment(2) == 'dashboard'){ echo 'active'; } ?>">
            <a href="<?php echo e(url('/').'/'.$admin_path.'/dashboard'); ?>">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <?php endif; ?>

        <?php if($admin_type == 'ADMIN' || $admin_type == 'SUB-ADMIN'): ?>
        <li class="<?php if(Request::segment(2) == 'account_settings' || Request::segment(2) == 'socialsettings' || Request::segment(2) == 'siteSettings' ){ echo 'active'; } ?>">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="fa fa-wrench"></i>
                <span>Settings</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
                <li style="display: block;"><a href="<?php echo e(url($admin_path.'/account_settings')); ?>">Profile</a></li>
                <?php if($admin_type == 'ADMIN'): ?>
                    <li style="display: block;"><a href="<?php echo e(url($admin_path.'/socialsettings')); ?>">Social Settings</a></li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        <?php if($admin_type == 'ADMIN'): ?>

        <li class="<?php if(Request::segment(2) == 'sub_admin'){ echo 'active'; } ?>">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="fa fa-users"></i>
                <span>Sub Admin</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
                <li style="display: block;" class="<?php if(Request::segment(2) == 'sub_admin'){ echo 'active'; } ?>"><a href="<?php echo e(url($admin_path.'/sub_admin')); ?>">Manage</a> </li>
            </ul>
        </li>

        <li class="<?php if(Request::segment(2) == 'patient'){ echo 'active'; } ?>">
            <a href="<?php echo e(url($admin_path.'/patient')); ?>">
                <i class="fa fa-user"></i>
                <span>Patient</span>
            </a>
        </li>

        <li class="<?php if(Request::segment(2) == 'doctor'){ echo 'active'; } ?>">
            <a href="<?php echo e(url($admin_path.'/doctor')); ?>">
                <i class="fa fa-user-md"></i>
                <span>Doctor</span>
            </a>
        </li>

        <li class="<?php if(Request::segment(2) == 'consultation'){ echo 'active'; } ?>">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="fa fa-medkit"></i>
                <span>Consultation</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
                <li style="display: block;" class="<?php if(Request::segment(2) == 'consultation' && Request::segment(3) == 'setting'){ echo 'active'; } ?>"><a href="<?php echo e(url($admin_path.'/consultation/setting')); ?>">Setting</a></li>
                
                <li style="display: block;" class="<?php if(Request::segment(2) == 'consultation' && Request::segment(3) == 'upcoming'){ echo 'active'; } ?>"><a href="<?php echo e(url($admin_path.'/consultation/upcoming')); ?>">Upcoming</a></li>
                
                <li style="display: block;" class="<?php if(Request::segment(2) == 'consultation' && Request::segment(3) == 'completed'){ echo 'active'; } ?>"><a href="<?php echo e(url($admin_path.'/consultation/completed')); ?>">Completed</a></li>
            </ul>
        </li>

        <li class="<?php if(Request::segment(2) == 'transactions'){ echo 'active'; } ?>">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="fa fa-money"></i>
                <span>Transactions</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
                <li style="display: block;" class="<?php if(Request::segment(2) == 'transactions' && Request::segment(3) == 'subscription_transactions'){ echo 'active'; } ?>"><a href="<?php echo e(url($admin_path.'/transactions/subscription_transactions')); ?>">Subscription Transaction</a></li>
                
                <li style="display: block;" class="<?php if(Request::segment(2) == 'transactions' && Request::segment(3) == 'consultation_transactions'){ echo 'active'; } ?>"><a href="<?php echo e(url($admin_path.'/transactions/consultation_transactions')); ?>">Consultation Transaction</a></li>
            </ul>
        </li>

        <li class="<?php if(Request::segment(2) == 'doctor'){ echo 'calendar'; } ?>">
            <a href="<?php echo e(url($admin_path.'/calendar')); ?>">
                <i class="fa fa-calendar"></i>
                <span>Calendar</span>
            </a>
        </li>

        <li class="<?php if(Request::segment(2) == 'stripe'){ echo 'active'; } ?>">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="fa fa-cc-stripe"></i>
                <span>Stripe</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
                <li style="display: block;" class="<?php if(Request::segment(2) == 'stripe' && Request::segment(3) == 'setting'){ echo 'active'; } ?>"><a href="<?php echo e(url($admin_path.'/stripe/setting')); ?>">Settings</a></li>
            </ul>
        </li>

        <li class="<?php if(Request::segment(2) == 'subscription_plan'){ echo 'active'; } ?>">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="fa fa-shopping-cart"></i>
                <span>Subscription Plan</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
                <li style="display: block;" class="<?php if(Request::segment(2) == 'subscription_plan'){ echo 'active'; } ?>"><a href="<?php echo e(url($admin_path.'/subscription_plan')); ?>">Manage</a> </li>
            </ul>
        </li>

        <li class="<?php if(Request::segment(2) == 'email_template'){ echo 'active'; } ?>">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="fa fa-envelope" ></i>
                <span>Email Template</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
                <li style="display: block;"><a href="<?php echo e(url($admin_panel_slug.'/email_template')); ?>">Manage</a> </li>
            </ul>
        </li>

        <li class="<?php if(Request::segment(2) == 'faq'){ echo 'active'; } ?>">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="fa fa-envelope" ></i>
                <span>Faq</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
                <li style="display: block;"><a href="<?php echo e(url($admin_panel_slug.'/faq')); ?>">Manage</a> </li>
                <li style="display: block;"><a href="<?php echo e(url($admin_path.'/faq/create')); ?>">Create</a></li>
            </ul>
        </li>

        <li class="<?php if(Request::segment(2) == 'newsletter_subscriber'){ echo 'active'; } ?>">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="fa fa-newspaper-o"></i>
                <span>Newsletter</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
                <li style="display: block;"><a href="<?php echo e(url($admin_panel_slug.'/newsletter_subscriber')); ?>">Manage </a></li>
            </ul>
        </li>

        <li class="<?php if(Request::segment(2) == 'contact_enquiry'){ echo 'active'; } ?>">
            <a href="<?php echo e(url($admin_path.'/contact_enquiry')); ?>">
                <i class="fa fa-phone"></i>
                <span>Contact Enquiry</span>
            </a>
        </li>

        <li class="<?php if(Request::segment(2) == 'contact_for_business'){ echo 'active'; } ?>">
            <a href="<?php echo e(url($admin_path.'/contact_for_business')); ?>">
                <i class="fa fa-building-o"></i>
                <span>Contact For Business</span>
            </a>
        </li>

        <li class="<?php if(Request::segment(2) == 'discount_code'){ echo 'active'; } ?>">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="fa fa-gift"></i>
                <span>Discount Code</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
                <li style="display: block;"><a href="<?php echo e(url($admin_path.'/discount_code')); ?>">Manage</a></li>
                <li style="display: block;"><a href="<?php echo e(url($admin_path.'/discount_code/create')); ?>">Create</a></li>
            </ul>
        </li>

        <li class="<?php if(Request::segment(2) == 'invitation'){ echo 'active'; } ?>">
            <a href="<?php echo e(url($admin_path.'/invitation')); ?>">
                <i class="fa fa-user-plus"></i>
                <span>Invitation</span>
            </a>
        </li>

         <!-- 
        <li class="<?php if(Request::segment(2) == 'medical_general'){ echo 'active'; } ?>">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="fa fa-medkit"></i>
                <span>Medical General</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
                <li style="display: block;"><a href="<?php echo e(url($admin_path.'/medical_general')); ?>">Manage</a></li>
            </ul>
        </li>
     -->
     
        <?php endif; ?>

        <?php if($admin_type == 'ADMIN' || $admin_type == 'SUB-ADMIN'): ?>
        <li class="<?php if(Request::segment(2) == 'blog'){ echo 'active'; } ?>">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="fa  fa-sitemap"></i>
                <span>Blog</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
                <li style="display: block;"><a href="<?php echo e(url($admin_path.'/blog')); ?>">Manage</a></li>
                <li style="display: block;"><a href="<?php echo e(url($admin_path.'/blog/category')); ?>">Category</a></li>
            </ul>
        </li>

        <li class="<?php if(Request::segment(2) == 'cms_pages'){ echo 'active'; } ?>">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="fa fa-file"></i>
                <span>What we treat</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
                <li style="display: block;"><a href="<?php echo e(url($admin_path.'/cms_pages/category')); ?>">Category</a></li>
                <li style="display: block;"><a href="<?php echo e(url($admin_path.'/cms_pages/sub_category')); ?>">Subcategory</a></li>
                <li style="display: block;"><a href="<?php echo e(url($admin_path.'/cms_pages/sub_category_details')); ?>">Sub Category Details</a></li>
            </ul>
        </li>

        <?php endif; ?>

        <?php if($admin_type == 'ADMIN'): ?>
        <li class="<?php if(Request::segment(2) == 'backup'){ echo 'active'; } ?>">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="fa fa-cloud-download"></i>
                <span>Backup</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
                <li style="display: block;" class="<?php if(Request::segment(2) == 'backup'){ echo 'active'; } ?>"><a href="<?php echo e(url($admin_path.'/backup')); ?>">Manage</a></li>
                <li style="display: block;" class="<?php if(Request::segment(2) == 'backup' && Request::segment(3) == 'database'){ echo 'active'; } ?>"><a href="<?php echo e(url($admin_path.'/backup/database')); ?>">Database</a></li>
                <li style="display: block;" class="<?php if(Request::segment(2) == 'backup' && Request::segment(3) == 'files'){ echo 'active'; } ?>"><a href="<?php echo e(url($admin_path.'/backup/files')); ?>">Files</a></li>
                <li style="display: block;" class="<?php if(Request::segment(2) == 'backup' && Request::segment(3) == 'backup_all'){ echo 'active'; } ?>"><a href="<?php echo e(url($admin_path.'/backup/backup_all')); ?>">Backup All</a></li>
            </ul>
        </li>


        <li class="<?php if(Request::segment(2) == 'reports'){ echo 'active'; } ?>">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="fa fa-file-text"></i>
                <span>Reports</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
                <li style="display: block;" class="<?php if(Request::segment(2) == 'reports' && Request::segment(3) == 'patient'){ echo 'active'; } ?>"><a href="<?php echo e(url($admin_path.'/reports/patient')); ?>">Patient</a></li>
                <li style="display: block;" class="<?php if(Request::segment(2) == 'reports' && Request::segment(3) == 'doctor'){ echo 'active'; } ?>"><a href="<?php echo e(url($admin_path.'/reports/doctor')); ?>">Doctor</a></li>
                <li style="display: block;" class="<?php if(Request::segment(2) == 'reports' && Request::segment(3) == 'subscription_transactions'){ echo 'active'; } ?>"><a href="<?php echo e(url($admin_path.'/reports/subscription_transactions')); ?>">Subscription Transaction</a></li>
                <li style="display: block;" class="<?php if(Request::segment(2) == 'reports' && Request::segment(3) == 'consultation_transactions'){ echo 'active'; } ?>"><a href="<?php echo e(url($admin_path.'/reports/consultation_transactions')); ?>">Consultation Transaction</a></li>
            </ul>
        </li>

         <li class="<?php if(Request::segment(2) == 'rating'){ echo 'active'; } ?>">
            <a href="<?php echo e(url($admin_path.'/rating')); ?>">
                <i class="fa fa-star"></i>
                <span>Review & Rating</span>
            </a>
        </li>

        <?php endif; ?>

    </ul>
    <!-- END Navlist -->

    <!-- BEGIN Sidebar Collapse Button -->
    <div id="sidebar-collapse" class="visible-lg">
        <i class="fa fa-angle-double-left"></i>
    </div>
   
</div>


