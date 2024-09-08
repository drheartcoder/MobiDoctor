<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

	// Clear all cache
	Route::get('cache_clear', function () {
		\Artisan::call('cache:clear');
		//  Clears route cache
		\Artisan::call('route:clear');
		\Cache::flush();
		\Artisan::call('optimize');
		exec('composer dump-autoload');

		dd("Cache cleared!");
	});


	$admin_path = config('app.project.admin_panel_slug');


	/*--------------------------------------------------------------------------*/


	Route::group([],function() use($admin_path)
	{
		/* Admin Routes */
		Route::group(['prefix' => $admin_path,'middleware' => ['admin_general']], function () 
		{
			$route_slug        = "admin_auth_";
			$module_controller = "Admin\AuthController@";

			/* Admin Auth Routes Starts */
			Route::get('/',                ['as' => $route_slug.'login',            'uses' => $module_controller.'login']);
			Route::get('login',            ['as' => $route_slug.'login',            'uses' => $module_controller.'login']);
			Route::any('process_login',    ['as' => $route_slug.'process_login',    'uses' => $module_controller.'process_login']);
			Route::any('otp_verification', ['as' => $route_slug.'otp_verification', 'uses' => $module_controller.'otp_verification']);
			Route::any('verify_otp',       ['as' => $route_slug.'verify_otp',       'uses' => $module_controller.'verify_otp']);
			Route::any('resend_otp',       ['as' => $route_slug.'resend_otp',       'uses' => $module_controller.'resend_otp']);
			
			// Change Password
			Route::get('change_password',  ['as' => $route_slug.'change_password', 'uses' => $module_controller.'change_password']);
			Route::post('update_password', ['as' => $route_slug.'update_password', 'uses' => $module_controller.'update_password']);

			// Forget Password OTP Verification
			/*Route::any('forget_password/resend_otp',        ['as' => $route_slug.'forget_password_resend_otp', 'uses' => $module_controller.'forget_password_resend_otp']);
			Route::any('/forget_password/verify_otp',       ['as' => $route_slug.'verify_otp',                 'uses' => $module_controller.'forget_password_verify_otp']);
			Route::any('/forget_password/otp_verification', ['as' => $route_slug.'verify_otp',                 'uses' => $module_controller.'forget_password_otp_verification']);
			Route::any('/patient/send_otp_by_ajax',         ['as' => $route_slug.'send_otp_by_ajax',           'uses' => $module_controller.'send_otp_by_ajax']);
			Route::any('/verify_otp_by_ajax',               ['as' => $route_slug.'verify_otp_by_ajax',         'uses' => $module_controller.'verify_otp_by_ajax']);*/

			// Reset Password
			Route::post('forgot_password',         ['as' => $route_slug.'forgot_password',       'uses' => $module_controller.'forgot_password']);
			/*Route::get('reset_password/{token}',   ['as' => $route_slug.'reset_password',        'uses' => $module_controller.'reset_password']);
			Route::post('reset_password/{enc_id}', ['as' => $route_slug.'update_reset_password', 'uses' => $module_controller.'update_reset_password']);*/

			Route::get('/reset_password_link/{enc_id}/{enc_reminder_code}', ['as' => $route_slug.'reset_password_link', 'uses' => $module_controller.'reset_password_link']);
			Route::post('/reset_password',                                  ['as' => $route_slug.'reset_password',      'uses' => $module_controller.'reset_password']);

			Route::group(['middleware' => ['authadmin']], function () 
			{
				$route_slug        = "admin_auth_";
				$module_controller = "Admin\AuthController@";

				/* Dashboard */
				Route::get('/dashboard', ['as' => $route_slug.'dashboard', 'uses' => 'Admin\DashboardController@index', 'sub_admin_module' => 'YES']);
				Route::get('/logout',    ['as' => $route_slug.'logout',    'uses' => $module_controller.'logout', 'sub_admin_module' => 'YES']);

				/*Account Settings*/
				$account_controller = "Admin\AccountSettingsController@";

				Route::get('account_settings',                  ['as' => $route_slug.'account_settings_show',   'uses' => $account_controller.'index', 'sub_admin_module' => 'YES']);
				Route::post('account_settings/update/{enc_id}', ['as' => $route_slug.'account_settings_update', 'uses' => $account_controller.'update', 'sub_admin_module' => 'YES']);

				/*Social links Settings*/
				$social_controller = "Admin\SocialLinksController@";
				Route::get('socialsettings',         ['as' => $route_slug.'account_social_settings',        'uses' => $social_controller.'index','sub_admin_module' => 'NO']);
				Route::post('socialsettings/update', ['as' => $route_slug.'account_social_settings_update', 'uses' => $social_controller.'update','sub_admin_module' => 'NO']);

				/*Site Settings*/
				$site_controller = "Admin\SiteSettingsController@";
				Route::get('siteSettings',         ['as' => $route_slug.'site_settings',                'uses' => $site_controller.'index','sub_admin_module' => 'NO']);
				Route::post('siteSettings/update', ['as' => $route_slug.'account_site_settings_update', 'uses' => $site_controller.'update','sub_admin_module' => 'NO']);


				/*--------------------------------------Email Template--------------------------------------------------*/

				Route::group(array('prefix' => '/email_template'), function()
				{	
					$route_slug        = "admin_email_template_";
					$module_controller = "Admin\EmailTemplateController@";

					Route::get('/',                ['as' => $route_slug.'index',  'uses' => $module_controller.'index','sub_admin_module'=>'NO']);
					Route::get('create/',          ['as' => $route_slug.'create', 'uses' => $module_controller.'create','sub_admin_module'=>'NO']);
					Route::post('store/',          ['as' => $route_slug.'store',  'uses' => $module_controller.'store','sub_admin_module'=>'NO']);
					Route::get('edit/{enc_id}',    ['as' => $route_slug.'edit',   'uses' => $module_controller.'edit','sub_admin_module'=>'NO']);
					Route::get('view/{enc_id}',    ['as' => $route_slug.'edit',   'uses' => $module_controller.'view','sub_admin_module'=>'NO']);
					Route::post('update/{enc_id}', ['as' => $route_slug.'update', 'uses' => $module_controller.'update','sub_admin_module'=>'NO']);
				});

				/*--------------------------------------Faq's--------------------------------------------------*/

				Route::group(array('prefix' => '/faq'), function()
				{	
					$route_slug        = "admin_faq_";
					$module_controller = "Admin\FaqController@";

					Route::get('/',                   ['as' => $route_slug.'index',  'uses' => $module_controller.'index','sub_admin_module'=>'NO']);
					Route::get('create/',             ['as' => $route_slug.'create', 'uses' => $module_controller.'create','sub_admin_module'=>'NO']);
					Route::post('store/',             ['as' => $route_slug.'store',  'uses' => $module_controller.'store','sub_admin_module'=>'NO']);
					Route::get('edit/{enc_id}',       ['as' => $route_slug.'edit',   'uses' => $module_controller.'edit','sub_admin_module'=>'NO']);
					Route::post('update/{enc_id}', 	  ['as' => $route_slug.'update', 'uses' => $module_controller.'update','sub_admin_module'=>'NO']);
					Route::get('activate/{enc_id}',   ['as' => $route_slug.'activate',     'uses' => $module_controller.'activate',     'sub_admin_module' => 'NO']);
					Route::get('deactivate/{enc_id}', ['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate',   'sub_admin_module' => 'NO']);
					Route::post('multi_action',       ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'sub_admin_module' => 'NO']);
					Route::get('delete/{enc_id}',     ['as' => $route_slug.'delete',       'uses' => $module_controller.'delete',       'sub_admin_module' => 'NO']);
				});


				/*----------------------------------Subscription Plan ----------------------------------------------*/

				Route::group(array('prefix' => 'subscription_plan'), function()
				{
					$route_slug         = "subscription_plan";
					$module_controller  = "Admin\SubscriptionController@";

					Route::get('/', ['as' => $route_slug.'index', 'uses' => $module_controller.'index','sub_admin_module'=>'NO']);
					Route::get('/edit/{enc_id}', ['as' => $route_slug.'edit', 'uses' => $module_controller.'edit','sub_admin_module'=>'NO']);
					Route::post('/update/{enc_id}', ['as' => $route_slug.'update', 'uses' => $module_controller.'update','sub_admin_module'=>'NO']);
				});


			    /*------------------------------Notification-----------------------------*/

				Route::group(array('prefix' => '/notification'), function()
				{
					$route_slug        = "notification_";
					$module_controller = "Admin\AdminNotificationController@";

					Route::any('/',               ['as' => $route_slug.'list',      'uses' => $module_controller.'index','sub_admin_module'=>'NO']);
					Route::post('get_count',      ['as' => $route_slug.'get_count', 'uses' => $module_controller.'get_count','sub_admin_module'=>'NO']);
					Route::any('delete/{end_id}', ['as' => $route_slug.'delete',    'uses' => $module_controller.'delete','sub_admin_module'=>'NO']);
				});


				/*------------------------------Patient-----------------------------*/

				Route::group(array('prefix' => '/patient'),function()
				{
					$route_slug        = "user_patient_";
					$module_controller = "Admin\PatientController@";

					Route::any('/',                        ['as' => $route_slug.'list',            'uses' => $module_controller.'index','sub_admin_module'=>'NO']);
					Route::get('view/{enc_id}',            ['as' => $route_slug.'edit',            'uses' => $module_controller.'view','sub_admin_module'=>'NO']);
					Route::get('delete/{enc_id}',          ['as' => $route_slug.'delete',          'uses' => $module_controller.'delete','sub_admin_module'=>'NO']);
					Route::get('activate/{enc_id}',        ['as' => $route_slug.'activate',        'uses' => $module_controller.'activate','sub_admin_module'=>'NO']);
					Route::get('deactivate/{enc_id}',      ['as' => $route_slug.'deactivate',      'uses' => $module_controller.'deactivate','sub_admin_module'=>'NO']);
					Route::post('multi_action',            ['as' => $route_slug.'multi_action',    'uses' => $module_controller.'multi_action','sub_admin_module'=>'NO']);
					Route::get('email_unverify/{enc_id}',  ['as' => $route_slug.'email_unverify',  'uses' => $module_controller.'email_unverify','sub_admin_module'=>'NO']);
					Route::get('email_verify/{enc_id}',    ['as' => $route_slug.'email_verify',    'uses' => $module_controller.'email_verify','sub_admin_module'=>'NO']);
					Route::get('mobile_unverify/{enc_id}', ['as' => $route_slug.'mobile_unverify', 'uses' => $module_controller.'mobile_unverify','sub_admin_module'=>'NO']);
					Route::get('mobile_verify/{enc_id}',   ['as' => $route_slug.'mobile_verify',   'uses' => $module_controller.'mobile_verify','sub_admin_module'=>'NO']);

					Route::get('view_family/{enc_id}',   ['as' => $route_slug.'view_family',   'uses' => $module_controller.'view_family','sub_admin_module'=>'NO']);

				});


				/*------------------------------Doctor-----------------------------*/

				Route::group(array('prefix' => '/doctor'),function()
				{
					$route_slug        = "user_doctor_";
					$module_controller = "Admin\DoctorController@";

					Route::any('/',                         ['as' => $route_slug.'list',             'uses' => $module_controller.'index','sub_admin_module'=>'NO']);
					Route::get('view/{enc_id}',             ['as' => $route_slug.'edit',             'uses' => $module_controller.'view','sub_admin_module'=>'NO']);
					Route::get('delete/{enc_id}',           ['as' => $route_slug.'delete',           'uses' => $module_controller.'delete','sub_admin_module'=>'NO']);
					Route::get('activate/{enc_id}',         ['as' => $route_slug.'activate',         'uses' => $module_controller.'activate','sub_admin_module'=>'NO']);
					Route::get('deactivate/{enc_id}',       ['as' => $route_slug.'deactivate',       'uses' => $module_controller.'deactivate','sub_admin_module'=>'NO']);
					Route::post('multi_action',             ['as' => $route_slug.'multi_action',     'uses' => $module_controller.'multi_action','sub_admin_module'=>'NO']);
					Route::get('email_unverify/{enc_id}',   ['as' => $route_slug.'email_unverify',   'uses' => $module_controller.'email_unverify','sub_admin_module'=>'NO']);
					Route::get('email_verify/{enc_id}',     ['as' => $route_slug.'email_verify',     'uses' => $module_controller.'email_verify','sub_admin_module'=>'NO']);
					Route::get('mobile_unverify/{enc_id}',  ['as' => $route_slug.'mobile_unverify',  'uses' => $module_controller.'mobile_unverify','sub_admin_module'=>'NO']);
					Route::get('mobile_verify/{enc_id}',    ['as' => $route_slug.'mobile_verify',    'uses' => $module_controller.'mobile_verify','sub_admin_module'=>'NO']);
					Route::get('admin_verified/{enc_id}',   ['as' => $route_slug.'admin_verified',   'uses' => $module_controller.'admin_verified','sub_admin_module'=>'NO']);
					Route::get('admin_unverified/{enc_id}', ['as' => $route_slug.'admin_unverified', 'uses' => $module_controller.'admin_unverified','sub_admin_module'=>'NO']);
				});


				/*------------------------------Newsletter Subscriber-----------------------------*/

				Route::group(array('prefix' => '/newsletter_subscriber'),function()
				{
					$route_slug        = "newsletter_subscriber_";
					$module_controller = "Admin\NewsletterController@";

					Route::get('/',                ['as' => $route_slug.'list',   'uses' => $module_controller.'index',  'sub_admin_module' => 'NO']);
					Route::any('/delete/{enc_id}', ['as' => $route_slug.'delete', 'uses' => $module_controller.'delete', 'sub_admin_module' => 'NO']);
				});

				/*---------------------------Contact Enquiry------------------------------------*/

				Route::group(array('prefix' => '/contact_enquiry'),function()
				{
					$route_slug        = "contact_enquiry_";
					$module_controller = "Admin\ContactEnquiryController@";

					Route::get('/',              ['as' => $route_slug.'list', 'uses' => $module_controller.'index', 'sub_admin_module' => 'NO']);
					Route::get('/view/{enc_id}', ['as' => $route_slug.'view', 'uses' => $module_controller.'view',  'sub_admin_module' => 'NO']);
				});

				/*---------------------------Contact For Business------------------------------------*/

				Route::group(array('prefix' => '/contact_for_business'),function()
				{
					$route_slug        = "contact_for_business_";
					$module_controller = "Admin\ContactForBusinessController@";

					Route::get('/',              ['as' => $route_slug.'list', 'uses' => $module_controller.'index', 'sub_admin_module' => 'NO']);
					Route::get('/view/{enc_id}', ['as' => $route_slug.'view', 'uses' => $module_controller.'view',  'sub_admin_module' => 'NO']);
				});


				/*------------------------------Discount Code---------------------------*/

				Route::group(array('prefix' => '/discount_code'),function()
				{
					$route_slug        = "discount_code_";
					$module_controller = "Admin\DiscountCodeController@";
					
					Route::get('/',                   ['as' => $route_slug.'list',         'uses' => $module_controller.'index',        'sub_admin_module' => 'NO']);
					Route::get('/create',             ['as' => $route_slug.'create',       'uses' => $module_controller.'create',       'sub_admin_module' => 'NO']);
					Route::post('/store',             ['as' => $route_slug.'store',        'uses' => $module_controller.'store',        'sub_admin_module' => 'NO']);
					Route::get('activate/{enc_id}',   ['as' => $route_slug.'activate',     'uses' => $module_controller.'activate',     'sub_admin_module' => 'NO']);
					Route::get('deactivate/{enc_id}', ['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate',   'sub_admin_module' => 'NO']);
					Route::post('multi_action',       ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'sub_admin_module' => 'NO']);
					Route::get('edit/{enc_id}',       ['as' => $route_slug.'edit',         'uses' => $module_controller.'edit',         'sub_admin_module' => 'NO']);
					Route::post('update/{enc_id}',    ['as' => $route_slug.'update',       'uses' => $module_controller.'update',       'sub_admin_module' => 'NO']);
					Route::get('delete/{enc_id}',     ['as' => $route_slug.'delete',       'uses' => $module_controller.'delete',       'sub_admin_module' => 'NO']);
					Route::get('view/{enc_id}',       ['as' => $route_slug.'view',         'uses' => $module_controller.'view',         'sub_admin_module' => 'NO']);
				});


				/*---------------------------CMS Pages------------------------------------*/

				Route::group(array('prefix' => '/cms_pages'),function()
				{
					$route_slug        = "cms_pages_";
					$module_controller = "Admin\CMSPagesController@";


					/*----------------Category----------------------------------*/

					Route::get('/category',                     ['as' => $route_slug.'category_list',   'uses' => $module_controller.'category',              'sub_admin_module' => 'YES']);
					Route::get('/category/create',              ['as' => $route_slug.'category_list',   'uses' => $module_controller.'create_category',       'sub_admin_module' => 'YES']);
					Route::post('/category/store',              ['as' => $route_slug.'category_list',   'uses' => $module_controller.'store_category',        'sub_admin_module' => 'YES']);
					Route::get('/category/activate/{enc_id}',   ['as' => $route_slug.'category_list',   'uses' => $module_controller.'activate_category',     'sub_admin_module' => 'YES']);
					Route::get('/category/deactivate/{enc_id}', ['as' => $route_slug.'category_list',   'uses' => $module_controller.'deactivate_category',   'sub_admin_module' => 'YES']);
					Route::post('/category/multi_action',       ['as' => $route_slug.'multi_action',    'uses' => $module_controller.'multi_action_category', 'sub_admin_module' => 'YES']);
					Route::get('/category/edit/{enc_id}',       ['as' => $route_slug.'edit_category',   'uses' => $module_controller.'edit_category',         'sub_admin_module' => 'YES']);
					Route::post('/category/update/{enc_id}',    ['as' => $route_slug.'update_category', 'uses' => $module_controller.'update_category',       'sub_admin_module' => 'YES']);


					/*----------------Sub Category----------------------------------*/

					Route::get('/sub_category',                     ['as' => $route_slug.'sub_category_list',   'uses' => $module_controller.'sub_category',              'sub_admin_module' => 'YES']);
					Route::get('/sub_category/create',              ['as' => $route_slug.'sub_category_list',   'uses' => $module_controller.'create_sub_category',       'sub_admin_module' => 'YES']);
					Route::post('/sub_category/store',              ['as' => $route_slug.'sub_category_list',   'uses' => $module_controller.'store_sub_category',        'sub_admin_module' => 'YES']);
					Route::get('/sub_category/activate/{enc_id}',   ['as' => $route_slug.'sub_category_list',   'uses' => $module_controller.'activate_sub_category',     'sub_admin_module' => 'YES']);
					Route::get('/sub_category/deactivate/{enc_id}', ['as' => $route_slug.'sub_category_list',   'uses' => $module_controller.'deactivate_sub_category',   'sub_admin_module' => 'YES']);
					Route::post('/sub_category/multi_action',       ['as' => $route_slug.'multi_action',        'uses' => $module_controller.'multi_action_sub_category', 'sub_admin_module' => 'YES']);
					Route::get('/sub_category/edit/{enc_id}',       ['as' => $route_slug.'edit_sub_category',   'uses' => $module_controller.'edit_sub_category',         'sub_admin_module' => 'YES']);
					Route::post('/sub_category/update/{enc_id}',    ['as' => $route_slug.'update_sub_category', 'uses' => $module_controller.'update_sub_category']);

					/*-----------------------Categoy Details-----------------------------*/
					
					Route::get('/category_details',             ['as' => $route_slug.'category_details_list',   'uses' => $module_controller.'category_details',              'sub_admin_module' => 'YES']);
					Route::get('/category_details/create',     ['as' => $route_slug.'category_details_list',   'uses' => $module_controller.'create_category_details',       'sub_admin_module' => 'YES']);
					Route::post('/category_details/store',   ['as' => $route_slug.'store_category_details',   'uses' => $module_controller.'store_category_details',        'sub_admin_module' => 'YES']);
					Route::get('/category_details/edit/{enc_id}', ['as' => $route_slug.'edit_category_details',   'uses' => $module_controller.'edit_category_details',         'sub_admin_module' => 'YES']);
					Route::post('/category_details/update/{enc_id}',['as' => $route_slug.'update_category_details', 'uses' => $module_controller.'update_category_details']);

					/*------------------------Sub Category Details---------------------*/
					
					Route::get('/sub_category_details/get_subcategory',  ['as' => $route_slug.'get_subcategory',   'uses' => $module_controller.'get_subcategory',              'sub_admin_module' => 'YES']);

					Route::get('/sub_category_details',  ['as' => $route_slug.'category_details_list',   'uses' => $module_controller.'sub_category_details',              'sub_admin_module' => 'YES']);
					Route::get('/sub_category_details/create',     ['as' => $route_slug.'sub_category_details_list',   'uses' => $module_controller.'create_sub_category_details',       'sub_admin_module' => 'YES']);
					Route::post('/sub_category_details/store',   ['as' => $route_slug.'store_sub_category_details',   'uses' => $module_controller.'store_sub_category_details',        'sub_admin_module' => 'YES']);
					Route::get('/sub_category_details/edit/{enc_id}', ['as' => $route_slug.'edit_sub_category_details',   'uses' => $module_controller.'edit_sub_category_details',         'sub_admin_module' => 'YES']);
					Route::post('/sub_category_details/update',['as' => $route_slug.'update_sub_category_details', 'uses' => $module_controller.'update_sub_category_details','sub_admin_module' => 'YES']);
					Route::get('/sub_category_details/view_details/{cat_id}/{sub_cat_id}',  ['as' => $route_slug.'view_investigation_details',   'uses' => $module_controller.'view_investigation_details',              'sub_admin_module' => 'YES']);

					Route::get('/sub_category_details/delete/{enc_id}',  ['as' => $route_slug.'sub_category_details_delete',   'uses' => $module_controller.'sub_category_details_delete',              'sub_admin_module' => 'YES']);
					Route::get('/sub_category_details/delete_tab/{enc_id}',  ['as' => $route_slug.'delete_tab',   'uses' => $module_controller.'delete_tab',              'sub_admin_module' => 'YES']);
					
				});

				/*---------------------Invitation------------------------------------*/

				Route::group(array('prefix' => '/invitation'),function()
				{
					$route_slug        = "invitation_";
					$module_controller = "Admin\InvitationController@";

					Route::get('/', ['as' => $route_slug.'list', 'uses' => $module_controller.'index', 'sub_admin_module' => 'NO']);
				});


				/*----------------------------------Blog-------------------------------------*/

				Route::group(array('prefix' => 'blog'), function()
				{
					$route_slug         = "blog_";
					$module_controller  = "Admin\BlogController@";
					
					Route::get('/',                    ['as' => $route_slug.'blog_list',     'uses' => $module_controller.'blog',              'sub_admin_module' => 'YES']);
					Route::get('/create',              ['as' => $route_slug.'blog_list',     'uses' => $module_controller.'create',            'sub_admin_module' => 'YES']);
					Route::post('/store',              ['as' => $route_slug.'blog_list',     'uses' => $module_controller.'store',             'sub_admin_module' => 'YES']);
					Route::get('/activate/{enc_id}',   ['as' => $route_slug.'category_list', 'uses' => $module_controller.'activate_blog',     'sub_admin_module' => 'YES']);
					Route::get('/deactivate/{enc_id}', ['as' => $route_slug.'category_list', 'uses' => $module_controller.'deactivate_blog',   'sub_admin_module' => 'YES']);
					Route::post('/multi_action',       ['as' => $route_slug.'multi_action',  'uses' => $module_controller.'multi_action_blog', 'sub_admin_module' => 'YES']);
					Route::get('/edit/{enc_id}',       ['as' => $route_slug.'edit_blog',     'uses' => $module_controller.'edit_blog',         'sub_admin_module' => 'YES']);
					Route::post('/update/{enc_id}',    ['as' => $route_slug.'update_blog',   'uses' => $module_controller.'update_blog',       'sub_admin_module' => 'YES']);
					Route::get('delete/{enc_id}',      ['as' => $route_slug.'delete',        'uses' => $module_controller.'delete_blog',       'sub_admin_module' => 'YES']);


					/*-----------------------------Comments---------------------------------------*/
					Route::get('comment/{enc_id}',             ['as' => $route_slug.'delete',         'uses' => $module_controller.'comment',              'sub_admin_module' => 'YES']);
					Route::get('comment/view/{enc_id}',        ['as' => $route_slug.'delete',         'uses' => $module_controller.'view_comment',         'sub_admin_module' => 'YES']);
					Route::get('/comment/activate/{enc_id}',   ['as' => $route_slug.'comment_list',   'uses' => $module_controller.'activate_comment',     'sub_admin_module' => 'YES']);
					Route::get('/comment/deactivate/{enc_id}', ['as' => $route_slug.'comment_list',   'uses' => $module_controller.'deactivate_comment',   'sub_admin_module' => 'YES']);
					Route::post('/comment/multi_action',       ['as' => $route_slug.'multi_action',   'uses' => $module_controller.'multi_action_comment', 'sub_admin_module' => 'YES']);
					Route::get('/comment/delete/{enc_id}',     ['as' => $route_slug.'comment_delete', 'uses' => $module_controller.'delete_comment',       'sub_admin_module' => 'YES']);


					/*-------------------------Blog Category--------------------------------*/

					Route::get('/category',                     ['as' => $route_slug.'category_list',   'uses' => $module_controller.'category',              'sub_admin_module' => 'YES']);
					Route::get('/category/create',              ['as' => $route_slug.'category_list',   'uses' => $module_controller.'create_category',       'sub_admin_module' => 'YES']);
					Route::post('/category/store',              ['as' => $route_slug.'category_list',   'uses' => $module_controller.'store_category',        'sub_admin_module' => 'YES']);
					Route::get('/category/activate/{enc_id}',   ['as' => $route_slug.'category_list',   'uses' => $module_controller.'activate_category',     'sub_admin_module' => 'YES']);
					Route::get('/category/deactivate/{enc_id}', ['as' => $route_slug.'category_list',   'uses' => $module_controller.'deactivate_category',   'sub_admin_module' => 'YES']);
					Route::post('/category/multi_action',       ['as' => $route_slug.'multi_action',    'uses' => $module_controller.'multi_action_category', 'sub_admin_module' => 'YES']);
					Route::get('/category/edit/{enc_id}',       ['as' => $route_slug.'edit_category',   'uses' => $module_controller.'edit_category',         'sub_admin_module' => 'YES']);
					Route::post('/category/update/{enc_id}',    ['as' => $route_slug.'update_category', 'uses' => $module_controller.'update_category',       'sub_admin_module' => 'YES']);
				});


				/*-------------------------------staic Pages(Seema)-----------------------------------------*/

				Route::group(array('prefix' => '/static_pages'), function()
				{
					$route_slug        = "static_pages_";
					$module_controller = "Admin\StaticPagesController@";

					Route::get('/',                   ['as' => $route_slug.'manage',       	'uses' => $module_controller.'index',        'sub_admin_module' => 'YES']);
					Route::get('create',              ['as' => $route_slug.'create',       	'uses' => $module_controller.'create',       'sub_admin_module' => 'YES']);
					Route::post('store',              ['as' => $route_slug.'store',         'uses' => $module_controller.'store',        'sub_admin_module' => 'YES']);
					Route::get('edit/{enc_id}',       ['as' => $route_slug.'edit',          'uses' => $module_controller.'edit',         'sub_admin_module' => 'YES']);
					Route::post('update/{enc_id}',    ['as' => $route_slug.'update',        'uses' => $module_controller.'update',       'sub_admin_module' => 'YES']);
					Route::get('delete/{enc_id}',     ['as' => $route_slug.'delete',        'uses' => $module_controller.'delete',       'sub_admin_module' => 'YES']);
					Route::get('activate/{enc_id}',   ['as' => $route_slug.'activate',      'uses' => $module_controller.'activate',     'sub_admin_module' => 'YES']);
					Route::get('deactivate/{enc_id}', ['as' => $route_slug.'deactivate',    'uses' => $module_controller.'deactivate',   'sub_admin_module' => 'YES']);
					Route::post('multi_action',       ['as' => $route_slug.'multi_action',  'uses' => $module_controller.'multi_action', 'sub_admin_module' => 'YES']);
				});


				/*--------------------------------------Consultation--------------------------------------------------*/

				Route::group(array('prefix' => 'consultation'), function()
				{	
					$route_slug        = "admin_consultation_";
					$module_controller = "Admin\ConsultationController@";

					Route::get('/setting',          ['as' => $route_slug.'setting',         'uses' => $module_controller.'setting',         'sub_admin_module' => 'NO']);
					Route::post('/setting/process', ['as' => $route_slug.'setting_process', 'uses' => $module_controller.'setting_process', 'sub_admin_module' => 'NO']);

					Route::get('/upcoming',               ['as' => $route_slug.'upcoming',         'uses' => $module_controller.'upcoming',         'sub_admin_module' => 'NO']);
					Route::get('/upcoming/details/{enc_id}', ['as' => $route_slug.'upcoming_details', 'uses' => $module_controller.'upcoming_details', 'sub_admin_module' => 'NO']);

					Route::get('/completed',               ['as' => $route_slug.'completed',         'uses' => $module_controller.'completed',         'sub_admin_module' => 'NO']);
					Route::get('/completed/details/{enc_id}', ['as' => $route_slug.'completed_details', 'uses' => $module_controller.'completed_details', 'sub_admin_module' => 'NO']);
				});


				/*------------------------------Reports-----------------------------*/

				Route::group(array('prefix' => '/transactions'),function()
				{
					$route_slug        = "transactions_";
					$module_controller = "Admin\TransactionController@";
					
					Route::any('/subscription_transactions',  				   			['as' => $route_slug.'subscription_transactions', 'uses' => $module_controller.'subscription_transactions',  'sub_admin_module' => 'NO']);
					
					Route::any('/consultation_transactions',  				   			['as' => $route_slug.'consultation_transactions', 'uses' => $module_controller.'consultation_transactions',  'sub_admin_module' => 'NO']);
					
				});


				/*--------------------------------------Stripe--------------------------------------------------*/

				Route::group(array('prefix' => 'stripe'), function()
				{	
					$route_slug        = "admin_stripe_";
					$module_controller = "Admin\StripeController@";

					Route::get('/setting',          ['as' => $route_slug.'setting',         'uses' => $module_controller.'setting',         'sub_admin_module' => 'NO']);
					Route::post('/setting/process', ['as' => $route_slug.'setting_process', 'uses' => $module_controller.'setting_process', 'sub_admin_module' => 'NO']);
				});


				/*-------------------------Sub Admin----------------------------------------*/

				Route::group(array('prefix' => 'sub_admin'), function()
				{
					$route_slug         = "sub_admin_";
					$module_controller  = "Admin\SubAdminController@";
					
					Route::get('/',                    ['as' => $route_slug.'blog_list',        'uses' => $module_controller.'index',        'sub_admin_module' => 'NO']);
					Route::get('/create',              ['as' => $route_slug.'sub_admin_list',   'uses' => $module_controller.'create',       'sub_admin_module' => 'NO']);
					Route::post('/store',              ['as' => $route_slug.'sub_admin_list',   'uses' => $module_controller.'store',        'sub_admin_module' => 'NO']);
					Route::get('/activate/{enc_id}',   ['as' => $route_slug.'category_list',    'uses' => $module_controller.'activate',     'sub_admin_module' => 'NO']);
					Route::get('/deactivate/{enc_id}', ['as' => $route_slug.'category_list',    'uses' => $module_controller.'deactivate',   'sub_admin_module' => 'NO']);
					Route::post('/multi_action',       ['as' => $route_slug.'multi_action',     'uses' => $module_controller.'multi_action', 'sub_admin_module' => 'NO']);
					Route::get('/edit/{enc_id}',       ['as' => $route_slug.'edit_sub_admin',   'uses' => $module_controller.'edit',         'sub_admin_module' => 'NO']);
					Route::post('/update/{enc_id}',    ['as' => $route_slug.'update_sub_admin', 'uses' => $module_controller.'update',       'sub_admin_module' => 'NO']);
				});


				/*------------------------------Medical General---------------------------*/

				Route::group(array('prefix' => '/medical_general'),function()
				{
					$route_slug        = "medical_general_";
					$module_controller = "Admin\MedicalGeneralController@";
					
					Route::get('/',                   ['as' => $route_slug.'list',         'uses' => $module_controller.'index',        'sub_admin_module' => 'NO']);
					Route::get('/create',             ['as' => $route_slug.'create',       'uses' => $module_controller.'create',       'sub_admin_module' => 'NO']);
					Route::post('/store',             ['as' => $route_slug.'store',        'uses' => $module_controller.'store',        'sub_admin_module' => 'NO']);
					Route::get('activate/{enc_id}',   ['as' => $route_slug.'activate',     'uses' => $module_controller.'activate',     'sub_admin_module' => 'NO']);
					Route::get('deactivate/{enc_id}', ['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate',   'sub_admin_module' => 'NO']);
					Route::post('multi_action',       ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'sub_admin_module' => 'NO']);
					Route::get('edit/{enc_id}',       ['as' => $route_slug.'edit',         'uses' => $module_controller.'edit',         'sub_admin_module' => 'NO']);
					Route::post('update/{enc_id}',    ['as' => $route_slug.'update',       'uses' => $module_controller.'update',       'sub_admin_module' => 'NO']);
				});


				/*------------------------------Backup---------------------------*/

				Route::group(array('prefix' => '/backup'),function()
				{
					$route_slug        = "backup_";
					$module_controller = "Admin\BackupController@";
					
					Route::get('/',                ['as' => $route_slug.'list',       'uses' => $module_controller.'index',      'sub_admin_module' => 'NO']);
					Route::get('/database',        ['as' => $route_slug.'database',   'uses' => $module_controller.'database',   'sub_admin_module' => 'NO']);
					Route::get('/files',           ['as' => $route_slug.'files',      'uses' => $module_controller.'files',      'sub_admin_module' => 'NO']);
					Route::get('/backup_all',      ['as' => $route_slug.'backup_all', 'uses' => $module_controller.'backup_all', 'sub_admin_module' => 'NO']);

					Route::get('/download/{name}', ['as' => $route_slug.'download',   'uses' => $module_controller.'download',   'sub_admin_module' => 'NO']);
					Route::get('/delete/{name}',   ['as' => $route_slug.'delete',     'uses' => $module_controller.'delete',     'sub_admin_module' => 'NO']);
				});

				/*------------------------------Calendar---------------------------*/
					
				Route::group(array('prefix' => '/calendar'),function()
				{
					$route_slug        = "calendar_";
					$module_controller = "Admin\CalendarController@";
					
					Route::get('/',          ['as' => $route_slug.'index',     'uses' => $module_controller.'index',     'sub_admin_module' => 'NO']);
					Route::get('/all_dates', ['as' => $route_slug.'all_dates', 'uses' => $module_controller.'all_dates', 'sub_admin_module' => 'NO']);
				});


				/*------------------------------Reports-----------------------------*/

				Route::group(array('prefix' => '/reports'),function()
				{
					$route_slug        = "reports_";
					$module_controller = "Admin\ReportsController@";

					Route::any('/patient',        ['as' => $route_slug.'patient', 'uses' => $module_controller.'patient',        'sub_admin_module' => 'NO']);
					Route::any('/patient/export', ['as' => $route_slug.'export',  'uses' => $module_controller.'patient_export', 'sub_admin_module' => 'NO']);

					Route::any('/doctor',         ['as' => $route_slug.'doctor',  'uses' => $module_controller.'doctor',         'sub_admin_module' => 'NO']);
					Route::any('/doctor/export',  ['as' => $route_slug.'export',  'uses' => $module_controller.'doctor_export',  'sub_admin_module' => 'NO']);
					
					Route::any('/subscription_transactions',         ['as' => $route_slug.'subscription_transactions', 'uses' => $module_controller.'subscription_transactions',         'sub_admin_module' => 'NO']);
					Route::any('/subscription_transactions/export',  ['as' => $route_slug.'export',      'uses' => $module_controller.'subscription_transactions_export',  'sub_admin_module' => 'NO']);
					
					Route::any('/consultation_transactions',         ['as' => $route_slug.'consultation_transactions', 'uses' => $module_controller.'consultation_transactions',         'sub_admin_module' => 'NO']);
					Route::any('/consultation_transactions/export',  ['as' => $route_slug.'export',      'uses' => $module_controller.'consultation_transactions_export',  'sub_admin_module' => 'NO']);
				});

				/*------------------------------Review & Rating---------------------------*/

				Route::group(array('prefix' => '/rating'),function()
				{
					$route_slug        = "rating_";
					$module_controller = "Admin\RatingController@";
					
					Route::get('/',                   ['as' => $route_slug.'list',         'uses' => $module_controller.'index',        'sub_admin_module' => 'NO']);
					Route::get('activate/{enc_id}',   ['as' => $route_slug.'activate',     'uses' => $module_controller.'activate',     'sub_admin_module' => 'NO']);
					Route::get('deactivate/{enc_id}', ['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate',   'sub_admin_module' => 'NO']);
					Route::post('multi_action',       ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'sub_admin_module' => 'NO']);
					Route::get('delete/{enc_id}',   ['as' => $route_slug.'delete',     'uses' => $module_controller.'delete',     'sub_admin_module' => 'NO']);
					Route::get('view/{enc_id}',   ['as' => $route_slug.'view',     'uses' => $module_controller.'view',     'sub_admin_module' => 'NO']);
					
				});

				

			});
		});
	});


	/******************************************************Front******************************************************************/


	@include_once(app_path('Http/Routes/front.php'));

	@include_once(app_path('Http/Routes/patient.php'));

	@include_once(app_path('Http/Routes/doctor.php'));

