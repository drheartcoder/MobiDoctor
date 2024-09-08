<?php
	Route::group(array('middleware' => 'front_general' ), function () use($route_slug)
	{
		$route_slug        = "front_";
		$module_controller = "Front\HomeController@";
		Route::get('/', ['as' => $route_slug.'home_page', 'uses' => $module_controller.'index']);

		$route_slug        = "front_";
		$module_controller = "Front\NewsletterController@";
		Route::any('/subscribe_newsletter', ['as' => $route_slug.'subscribe_newsletter', 'uses' => $module_controller.'subscribe_newsletter']);


		$route_slug        = "front_";
		$module_controller = "Front\CommonController@";

		Route::post('/check_duplicate_email',  ['as' => $route_slug.'check_duplicate_email',  'uses' => $module_controller.'check_duplicate_email']);
		Route::post('/check_referral_code',  ['as' => $route_slug.'check_referral_code',  'uses' => $module_controller.'check_referral_code']);
		
		Route::post('/check_duplicate_mobile', ['as' => $route_slug.'check_duplicate_mobile', 'uses' => $module_controller.'check_duplicate_mobile']);
		
		Route::post('/login', ['as' => $route_slug.'login',  'uses' => $module_controller.'login']);
		Route::get('/logout', ['as' => $route_slug.'logout', 'uses' => $module_controller.'logout']);

		Route::post('/fblogin', ['as' => $route_slug.'fblogin',  'uses' => $module_controller.'fblogin']);

		Route::get('/change_view', ['as' => $route_slug.'change_view', 'uses' => $module_controller.'change_view']);

		/*--------------------------------------------------------------------------
									Forget Password Starts
		---------------------------------------------------------------------------*/

		Route::post('/forget_password',                                 ['as' => $route_slug.'forget_password',     'uses' => $module_controller.'forget_password']);
		Route::get('/reset_password_link/{enc_id}/{enc_reminder_code}', ['as' => $route_slug.'reset_password_link', 'uses' => $module_controller.'reset_password_link']);
		Route::post('/reset_password',                                  ['as' => $route_slug.'reset_password',      'uses' => $module_controller.'reset_password']);

		/*--------------------------------------------------------------------------
									Forget Password Starts
		---------------------------------------------------------------------------*/



		/*--------------------------------------------------------------------------
									Verify Mobile OTP Starts
		---------------------------------------------------------------------------*/

		Route::post('/otp/enter_mobile',  ['as' => $route_slug.'enter_mobile',  'uses' => $module_controller.'enter_mobile']);
		Route::post('/otp/verify_mobile', ['as' => $route_slug.'verify_mobile', 'uses' => $module_controller.'verify_mobile']);
		Route::post('/otp/verify',        ['as' => $route_slug.'verify_otp',    'uses' => $module_controller.'verify_otp']);
		Route::post('/otp/resend',        ['as' => $route_slug.'resend_otp',    'uses' => $module_controller.'resend_otp']);

		/*--------------------------------------------------------------------------
									Verify Mobile OTP Ends
		---------------------------------------------------------------------------*/




		/*--------------------------------------------------------------------------
									Virgil Function Starts
		---------------------------------------------------------------------------*/

		Route::group(array('prefix' => 'virgil' ), function () use($route_slug)
		{
			$route_slug        = "virgil_";
			$module_controller = "Front\VirgilController@";
			
			Route::post('/publish/card', ['as' => $route_slug.'publish_card', 'uses' => $module_controller.'publish_card']);
		});
		
		/*--------------------------------------------------------------------------
									Virgil Function Ends
		---------------------------------------------------------------------------*/

		Route::group(array('prefix' => 'blog' ), function () use($route_slug)
		{
			$route_slug        = "front_";
			$module_controller = "Front\BlogController@";
			Route::get('/', ['as' => $route_slug.'index', 'uses' => $module_controller.'index']);
			Route::get('/{slug}', ['as' => $route_slug.'details', 'uses' => $module_controller.'details']);
			Route::post('/comment', ['as' => $route_slug.'store_comment', 'uses' => $module_controller.'store_comment']);
			Route::get('/topic/{slug}', ['as' => $route_slug.'topic', 'uses' => $module_controller.'topic']);
		});

		Route::group(array('prefix' => 'what-we-treat'), function () use($route_slug)
		{
			$route_slug        = "front_";
			$module_controller = "Front\WhatWeTreatController@";
			Route::get('/', ['as' => $route_slug.'listing', 'uses' => $module_controller.'index']);
			Route::get('/{slug}', ['as' => $route_slug.'details', 'uses' => $module_controller.'category_details']);
			
			Route::get('/{category_slug}/{sub_category_slug}/{tab_slug?}', ['as' => $route_slug.'details', 'uses' => $module_controller.'sub_category_details']);

			//Route::get('/{category_slug}/{sub_category_slug}/{tab_slug}', ['as' => $route_slug.'details', 'uses' => $module_controller.'sub_category_tab_details']);
		});


		$route_slug        = "front_";
		$module_controller = "Front\StaticPagesController@";
		Route::get('/contact_us', ['as' => $route_slug.'contact_us', 'uses' => $module_controller.'contact_us']);
		Route::get('/about_us', ['as' => $route_slug.'about_us', 'uses' => $module_controller.'about_us']);
		Route::get('/how_it_work', ['as' => $route_slug.'how_it_work', 'uses' => $module_controller.'how_it_work']);
		Route::get('/for_business', ['as' => $route_slug.'for_business', 'uses' => $module_controller.'for_business']);
		Route::get('/pregnancy', ['as' => $route_slug.'pregnancy', 'uses' => $module_controller.'pregnancy']);
		Route::get('/for_doctor', ['as' => $route_slug.'for_doctor', 'uses' => $module_controller.'for_doctor']);
		Route::post('/for_business/store', ['as' => $route_slug.'store_contact_for_business', 'uses' => $module_controller.'store_contact_for_business']);
		Route::get('/membership', ['as' => $route_slug.'membership', 'uses' => $module_controller.'membership']);


	});
?>