<?php
	
	Route::group(array('middleware' => 'front_general', 'prefix' => 'doctor'), function () use($route_slug)
	{
		$route_slug        = "doctor_";
		$module_controller = "Front\Doctor\AuthController@";

		Route::get('/signup',        ['as' => $route_slug.'signup',       'uses' => $module_controller.'signup']);
		Route::post('/signup/store', ['as' => $route_slug.'signup_store', 'uses' => $module_controller.'signup_store']);

		Route::get('/verify/{enc_id}/{activation_code}', ['as' => $route_slug.'verify_email', 'uses' => $module_controller.'verify_email']);
		


		/*--------------------------------------------------------------------------
									After Login Starts
		---------------------------------------------------------------------------*/
		
		Route::group(array('middleware' => 'auth_doctor'), function () use($route_slug)
		{


			/*--------------------------------------------------------------------------
										Dashboard Starts
			---------------------------------------------------------------------------*/

			Route::group(array('prefix' => 'dashboard'), function () use($route_slug)
			{
				$route_slug        = "doctor_";
				$module_controller = "Front\Doctor\DashboardController@";

				Route::get('/', ['as' => $route_slug.'dashboard', 'uses' => $module_controller.'dashboard']);
			});

			/*--------------------------------------------------------------------------
										Dashboard Ends
			---------------------------------------------------------------------------*/



			/*--------------------------------------------------------------------------
										My Consultation Starts
			---------------------------------------------------------------------------*/

			Route::group(array('prefix' => 'my_consultation'), function () use($route_slug)
			{
				$route_slug        = "my_consultation_";
				$module_controller = "Front\Doctor\MyConsultationController@";

				Route::group(array('prefix' => 'upcoming'), function () use($route_slug, $module_controller)
				{
					Route::get('/', ['as' => $route_slug.'upcoming', 'uses' => $module_controller.'upcoming']);

					Route::group(array('prefix' => '{enc_id}'), function () use($route_slug, $module_controller)
					{
						Route::get('/details', ['as' => $route_slug.'upcoming_details', 'uses' => $module_controller.'upcoming_details']);
						Route::post('/update', ['as' => $route_slug.'upcoming_update', 'uses' => $module_controller.'upcoming_update']);
						Route::post('/prescription/store', ['as' => $route_slug.'add_prescription', 'uses' => $module_controller.'add_prescription']);
						Route::get('/video', ['as' => $route_slug.'video', 'uses' => $module_controller.'video']);

						Route::post('/generate_invoice', ['as' => $route_slug.'generate_invoice', 'uses' => $module_controller.'generate_invoice']);
					});

					Route::any('/video/initiate_doctor_call', ['as' => $route_slug.'video', 'uses' => $module_controller.'initiate_doctor_call']);

					Route::any('/video/drop_doctor_call', ['as' => $route_slug.'video', 'uses' => $module_controller.'drop_doctor_call']);

					Route::any('/video/update_doctor_call_duration', ['as' => $route_slug.'video', 'uses' => $module_controller.'update_doctor_call_duration']);
				});

				Route::group(array('prefix' => 'completed'), function () use($route_slug, $module_controller)
				{
					Route::get('/', ['as' => $route_slug.'completed', 'uses' => $module_controller.'completed']);

					Route::group(array('prefix' => '{enc_id}'), function () use($route_slug, $module_controller)
					{
						Route::get('/details', ['as' => $route_slug.'completed_details', 'uses' => $module_controller.'completed_details']);
						Route::post('/update', ['as' => $route_slug.'completed_update', 'uses' => $module_controller.'completed_update']);
						Route::post('/prescription/store', ['as' => $route_slug.'add_prescription', 'uses' => $module_controller.'add_prescription']);
						Route::get('/video', ['as' => $route_slug.'video', 'uses' => $module_controller.'video']);
					});
				});
			});

			/*--------------------------------------------------------------------------
										My Consultation Ends
			---------------------------------------------------------------------------*/



			/*--------------------------------------------------------------------------
										Availability Starts
			---------------------------------------------------------------------------*/

			Route::group(array('prefix' => 'availability'), function () use($route_slug)
			{
				$route_slug        = "doctor_";
				$module_controller = "Front\Doctor\AvailabilityController@";

				Route::get('/',                ['as' => $route_slug.'index',           'uses' => $module_controller.'index']);
				Route::get('/available_dates', ['as' => $route_slug.'available_dates', 'uses' => $module_controller.'available_dates']);

				Route::post('/add',            ['as' => $route_slug.'add',             'uses' => $module_controller.'add']);
				Route::post('/update',         ['as' => $route_slug.'update',          'uses' => $module_controller.'update']);
				Route::post('/delete',         ['as' => $route_slug.'delete',          'uses' => $module_controller.'delete']);

				Route::get('/resume',         ['as' => $route_slug.'resume',          'uses' => $module_controller.'resume']);
				Route::get('/pause',         ['as' => $route_slug.'pause',          'uses' => $module_controller.'pause']);



			});

			/*--------------------------------------------------------------------------
										Availability Ends
			---------------------------------------------------------------------------*/



			/*--------------------------------------------------------------------------
										My Account start
			---------------------------------------------------------------------------*/

			Route::group(array('prefix' => 'my_account'), function () use($route_slug)
			{
				$route_slug        = "my_account_";
				$module_controller = "Front\Doctor\MyAccountController@";

				/*---------change password routes starts---------------------------*/

				Route::get('/change_password', ['as' => $route_slug.'change_password', 'uses' => $module_controller.'change_password']);
				Route::post('/change_password/update', ['as' => $route_slug.'update_change_password', 'uses' => $module_controller.'update_change_password']);

				/*-------change password routes ends-------------------------------*/

				/*----------About Me-----------------------------------------------*/
				Route::get('/about_me',         ['as' => $route_slug.'about_me',        'uses' => $module_controller.'about_me']);
				Route::post('/about_me/update', ['as' => $route_slug.'update_about_me', 'uses' => $module_controller.'update_about_me']);
				/*----------End of About Me----------------------------------------*/

				/*----------Medical Practice-----------------------------------------------*/
				Route::get('/medical_practice',         ['as' => $route_slug.'medical_practice',        'uses' => $module_controller.'medical_practice']);
				Route::post('/medical_practice/update', ['as' => $route_slug.'update_medical_practice', 'uses' => $module_controller.'update_medical_practice']);
				/*----------End of Medical Practice----------------------------------------*/

				/*----------Medical Qualification-----------------------------------------------*/
				Route::get('/medical_qualifications',['as' => $route_slug.'medical_qualifications','uses' => $module_controller.'medical_qualifications']);
				Route::post('/medical_qualifications/update',['as' => $route_slug.'update_medical_qualifications','uses' => $module_controller.'update_medical_qualifications']);
				/*----------End of Medical Qualification----------------------------------------*/

				/*----------Document & Verification-----------------------------------------------*/
				Route::get('/document_verification',['as' => $route_slug.'document_verification','uses' => $module_controller.'document_verification']);
				Route::post('/document_verification/update',['as' => $route_slug.'update_document_verification','uses' => $module_controller.'update_document_verification']);
				/*----------End of Document & Verification----------------------------------------*/


				/*----------Bank Details-----------------------------------------------*/
				Route::get('/bank_details',         ['as' => $route_slug.'bank_details',        'uses' => $module_controller.'bank_details']);
				Route::post('/bank_details/update', ['as' => $route_slug.'update_bank_details', 'uses' => $module_controller.'update_bank_details']);
				Route::get('/bank_details/edit',    ['as' => $route_slug.'edit_bank_details',   'uses' => $module_controller.'edit_bank_details']);
				/*----------End of Bank Details----------------------------------------*/
				
			});

			/*--------------------------------------------------------------------------
										My Account End
			---------------------------------------------------------------------------*/

			/*--------------------------------------------------------------------------
										Notifications
			---------------------------------------------------------------------------*/

			Route::group(array('prefix' => 'notification'), function () use($route_slug)
			{
				$route_slug        = "notification_";
				$module_controller = "Front\Doctor\NotificationController@";

				Route::get('/',['as' => $route_slug.'list','uses' => $module_controller.'index']);
				Route::get('/delete/{enc_id}',['as' => $route_slug.'delete','uses' => $module_controller.'delete']);

			});

			/*--------------------------------------------------------------------------
										Notifications End
			---------------------------------------------------------------------------*/
			
			/*--------------------------------------------------------------------------
										Notifications
			---------------------------------------------------------------------------*/

			Route::group(array('prefix' => 'transactions'), function () use($route_slug)
			{
				$route_slug        = "transactions_";
				$module_controller = "Front\Doctor\TransactionController@";

				Route::get('/',				   ['as' => $route_slug.'transactions','uses' => $module_controller.'transactions']);
				
				Route::get('/view_transaction',['as' => $route_slug.'view_transaction','uses' => $module_controller.'view_transaction']);
			});

			/*--------------------------------------------------------------------------
										Notifications End
			---------------------------------------------------------------------------*/

			/*--------------------------------------------------------------------------
										Notifications
			---------------------------------------------------------------------------*/

			Route::group(array('prefix' => 'settings'), function () use($route_slug)
			{
				$route_slug        = "settings_";
				$module_controller = "Front\Doctor\SettingController@";

				Route::get('/contact_us',         ['as' => $route_slug.'contact_us',  'uses' => $module_controller.'contact_us']);
				Route::post('/contact_us/store',         ['as' => $route_slug.'store_contact_us',  'uses' => $module_controller.'store_contact_us']);

				Route::get('/invitation',				   ['as' => $route_slug.'invitation','uses' => $module_controller.'invitation']);
				Route::get('/faq',				   		   ['as' => $route_slug.'faq','uses' => $module_controller.'faq']);
				Route::get('/invitation/download_template',['as' => $route_slug.'download_template','uses' => $module_controller.'download_template']);
				Route::post('/invitation/import',		   ['as' => $route_slug.'import','uses' => $module_controller.'import']);
			});

			/*--------------------------------------------------------------------------
										Notifications End
			---------------------------------------------------------------------------*/

			/*--------------------------------------------------------------------------
										My Patient
			---------------------------------------------------------------------------*/

			/*Route::group(array('prefix' => 'my_patients'), function () use($route_slug)
			{

				$route_slug        = "my_patient_";
				$module_controller = "Front\Doctor\MyPatientController@";

				Route::get('/',['as' => $route_slug.'my_patient','uses' => $module_controller.'index']);

				Route::get('/patient/details/{enc_id}',['as' => $route_slug.'details','uses' => $module_controller.'patient_details']);
				Route::get('/patient/details/edit/{enc_id}',['as' => $route_slug.'edit_details','uses' => $module_controller.'edit_details']);
				Route::post('/patient/details/update',['as' => $route_slug.'update_deatils','uses' => $module_controller.'update_deatils']);
				Route::get('/patient/family_member/deails/{member_id}',['as' => $route_slug.'family_member_deatils','uses' => $module_controller.'family_member_deatils']);
				Route::get('/patient/family_member/{enc_id}',['as' => $route_slug.'add_family_member','uses' => $module_controller.'add_family_member']);
				Route::post('/patient/family_member/store',['as' => $route_slug.'store_family_member','uses' => $module_controller.'store_family_member']);
				Route::get('/patient/family_member/delete/{enc_id}',['as' => $route_slug.'delete_family_member','uses' => $module_controller.'delete_family_member']);
				Route::post('/patient/family_member/update',['as' => $route_slug.'update_family_member','uses' => $module_controller.'update_family_member']);



				Route::post('/patient/general/store',['as' => $route_slug.'store_general','uses' => $module_controller.'store_general']);
				Route::get('/patient/general/delete/{enc_id}',['as' => $route_slug.'delete_general','uses' => $module_controller.'delete_general']);
				Route::get('/patient/lifestyle/{enc_id}',['as' => $route_slug.'lifestyle','uses' => $module_controller.'lifestyle']);
				Route::post('/patient/lifestyle/update',['as' => $route_slug.'update_lifestyle','uses' => $module_controller.'update_lifestyle']);
				Route::get('/patient/medication/{enc_id}',['as' => $route_slug.'medication','uses' => $module_controller.'medication']);
				Route::post('/patient/medication/store',['as' => $route_slug.'store_medication','uses' => $module_controller.'store_medication']);
				Route::get('/patient/medication/edit/{enc_id}',['as' => $route_slug.'edit_medication','uses' => $module_controller.'edit_medication']);
				Route::post('/patient/medication/update',['as' => $route_slug.'upadte_medication','uses' => $module_controller.'upadte_medication']);
				Route::get('/patient/medication/delete/{enc_id}',['as' => $route_slug.'delete_medication','uses' => $module_controller.'delete_medication']);

			});*/

			Route::group(array('prefix' => 'my_patients'), function () use($route_slug)
			{

				$route_slug        = "my_patient_";
				$module_controller = "Front\Doctor\MyPatientController@";

				Route::get('/',['as' => $route_slug.'my_patient','uses' => $module_controller.'index']);

				/*------------------------------Patient History-----------------------------*/

				Route::get('/patient_history/{enc_id}',['as' => $route_slug.'patient_history','uses' => $module_controller.'patient_history']);
				Route::get('/patient_history/edit/{enc_id}',['as' => $route_slug.'edit_patient_history','uses' => $module_controller.'edit_patient_history']);
				Route::post('/patient_history/update',['as' => $route_slug.'update_patient_history','uses' => $module_controller.'update_patient_history']);
				Route::get('/patient_history/family_member/deails/{member_id}',['as' => $route_slug.'family_member_deatils','uses' => $module_controller.'family_member_deatils']);
				Route::get('/patient_history/family_member/{enc_id}',['as' => $route_slug.'add_family_member','uses' => $module_controller.'add_family_member']);
				Route::post('/patient_history/family_member/store',['as' => $route_slug.'store_family_member','uses' => $module_controller.'store_family_member']);
				Route::get('/patient_history/family_member/delete/{enc_id}',['as' => $route_slug.'delete_family_member','uses' => $module_controller.'delete_family_member']);
				Route::post('/patient_history/family_member/update',['as' => $route_slug.'update_family_member','uses' => $module_controller.'update_family_member']);
				
				Route::any('/patient_history/download_personal_information/{enc_id}',['as' => $route_slug.'download_personal_information','uses' => $module_controller.'download_personal_information']);
				/*Route::any('/patient_history/download_personal_information',['as' => $route_slug.'download_personal_information','uses' => $module_controller.'download_personal_information']);*/

				Route::any('/patient_history/get_medication_details/{enc_id}',['as' => $route_slug.'get_medication_details','uses' => $module_controller.'get_medication_details']);

				

				/*-----------------------------Medical History--------------------------------*/

				Route::get('/medical_history/{enc_id}',['as' => $route_slug.'medical_history','uses' => $module_controller.'medical_history']);
				Route::post('/medical_history/general/store',['as' => $route_slug.'store_general','uses' => $module_controller.'store_general']);
				Route::get('/medical_history/general/delete/{enc_id}',['as' => $route_slug.'delete_general','uses' => $module_controller.'delete_general']);
				Route::get('/medical_history/lifestyle/{enc_id}',['as' => $route_slug.'lifestyle','uses' => $module_controller.'lifestyle']);
				Route::post('/medical_history/lifestyle/update',['as' => $route_slug.'update_lifestyle','uses' => $module_controller.'update_lifestyle']);

				Route::get('/medical_history/medication/{enc_id}',['as' => $route_slug.'medication','uses' => $module_controller.'medication']);
				Route::post('/medical_history/medication/store',['as' => $route_slug.'store_medication','uses' => $module_controller.'store_medication']);
				Route::get('/medical_history/medication/edit/{enc_id}',['as' => $route_slug.'edit_medication','uses' => $module_controller.'edit_medication']);
				Route::post('/medical_history/medication/update',['as' => $route_slug.'upadte_medication','uses' => $module_controller.'upadte_medication']);
				Route::get('/medical_history/medication/delete/{enc_id}',['as' => $route_slug.'delete_medication','uses' => $module_controller.'delete_medication']);
				Route::get('/medical_history/medication/view/{enc_id}',['as' => $route_slug.'view_medication','uses' => $module_controller.'view_medication']);

				/*-----------------------------Medical Certificate----------------------------*/

				
				Route::get('/medical_certificate/{enc_id}',['as' => $route_slug.'medical_certificate','uses' => $module_controller.'medical_certificate']);

				Route::any('/medical_certificate/save_and_generate_medical_certificate',['as' => $route_slug.'medical_certificate','uses' => $module_controller.'save_and_generate_medical_certificate']);
				
			});
			/*--------------------------------------------------------------------------
										My Patient End
			---------------------------------------------------------------------------*/
		});

		/*--------------------------------------------------------------------------
									After Login Ends
		---------------------------------------------------------------------------*/


	});


	Route::get('/invitation_send_request', function () 
	{
    	$exitCode = Artisan::call('invitation_mail_send:invite');
	});

?>