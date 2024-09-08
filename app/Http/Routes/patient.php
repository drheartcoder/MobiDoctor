<?php
	
	Route::group(array('middleware' => 'front_general', 'prefix' => 'patient'), function () use($route_slug)
	{
		$route_slug        = "patient_";
		$module_controller = "Front\Patient\AuthController@";

		Route::get('/signup/{code?}', ['as' => $route_slug.'signup',       'uses' => $module_controller.'signup']);
		Route::post('/signup/store',  ['as' => $route_slug.'signup_store', 'uses' => $module_controller.'signup_store']);

		Route::get('/verify/{enc_id}/{activation_code}', ['as' => $route_slug.'verify_email' , 'uses' => $module_controller.'verify_email']);



		/*--------------------------------------------------------------------------
									After Login Starts
		---------------------------------------------------------------------------*/

		Route::group(array('middleware' => 'auth_patient'), function () use($route_slug)
		{


			/*--------------------------------------------------------------------------
										Dashboard Starts
			---------------------------------------------------------------------------*/

			Route::group(array('prefix' => 'dashboard'), function () use($route_slug)
			{
				$route_slug        = "patient_";
				$module_controller = "Front\Patient\DashboardController@";

				Route::get('/', ['as' => $route_slug.'dashboard', 'uses' => $module_controller.'dashboard']);
			});

			/*--------------------------------------------------------------------------
										Dashboard Ends
			---------------------------------------------------------------------------*/




			/*--------------------------------------------------------------------------
										Consultation Starts
			---------------------------------------------------------------------------*/

			Route::group(array('prefix' => 'consultation'), function () use($route_slug)
			{
				$route_slug        = "consultation_";
				$module_controller = "Front\Patient\ConsultationController@";

				Route::get('/', ['as' => $route_slug.'index', 'uses' => $module_controller.'index']);
				

				/*-----------------------------------------subscription plan routes starts-----------------------------------------*/

				Route::get('/subscription_plan',                  ['as' => $route_slug.'subscription_plan',  'uses' => $module_controller.'subscription_plan']);
				
				// Payment
				Route::post('/subscription_plan/payment',         ['as' => $route_slug.'sp_payment',         'uses' => $module_controller.'sp_payment']);
				Route::post('/subscription_plan/payment/process', ['as' => $route_slug.'sp_payment_process', 'uses' => $module_controller.'sp_payment_process']);

				// Appy Discount code
				Route::post('/subscription_plan/discount/apply',  ['as' => $route_slug.'sp_discount_apply',  'uses' => $module_controller.'sp_discount_apply']);

				/*-----------------------------------------subscription plan routes ends-----------------------------------------*/


				Route::get('/get_consultation_id', ['as' => $route_slug.'get_consultation_id', 'uses' => $module_controller.'get_consultation_id']);

				
				Route::group(array('prefix' => '{enc_id}'), function () use($route_slug)
				{
					$route_slug        = "consultation_";
					$module_controller = "Front\Patient\ConsultationController@";

					// Select Patient
					Route::get('/patient',          ['as' => $route_slug.'select_patient',         'uses' => $module_controller.'select_patient']);
					Route::post('/patient/process', ['as' => $route_slug.'select_patient_process', 'uses' => $module_controller.'select_patient_process']);

					// Select Day
					Route::get('/day',          ['as' => $route_slug.'select_day',         'uses' => $module_controller.'select_day']);
					Route::post('/day/process', ['as' => $route_slug.'select_day_process', 'uses' => $module_controller.'select_day_process']);

					// Select Time
					Route::get('/time',          ['as' => $route_slug.'select_time',         'uses' => $module_controller.'select_time']);
					Route::post('/time/process', ['as' => $route_slug.'select_time_process', 'uses' => $module_controller.'select_time_process']);

					// Payment
					Route::get('/payment',          ['as' => $route_slug.'payment',         'uses' => $module_controller.'payment']);
					Route::post('/payment/process', ['as' => $route_slug.'payment_process', 'uses' => $module_controller.'payment_process']);

					// Appy Discount code
					Route::post('/payment/apply_discount', ['as' => $route_slug.'apply_discount', 'uses' => $module_controller.'apply_discount']);

					// Reason
					Route::get('/reason',          ['as' => $route_slug.'reason',         'uses' => $module_controller.'reason']);
					Route::post('/reason/process', ['as' => $route_slug.'reason_process', 'uses' => $module_controller.'reason_process']);

					// Requested
					Route::get('/requested', ['as' => $route_slug.'requested', 'uses' => $module_controller.'requested']);

					// Reschedule
					Route::get('/reschedule', ['as' => $route_slug.'reschedule', 'uses' => $module_controller.'reschedule']);

				});

			});

			/*--------------------------------------------------------------------------
										Consultation Ends
			---------------------------------------------------------------------------*/


			/*--------------------------------------------------------------------------
										My Consultation Starts
			---------------------------------------------------------------------------*/

			Route::group(array('prefix' => 'my_consultation'), function () use($route_slug)
			{
				$route_slug        = "my_consultation_";
				$module_controller = "Front\Patient\MyConsultationController@";

				Route::group(array('prefix' => 'upcoming'), function () use($route_slug, $module_controller)
				{
					Route::get('/', ['as' => $route_slug.'upcoming', 'uses' => $module_controller.'upcoming']);
					
					Route::get('/is_patient_get_call', ['as' => $route_slug.'is_patient_get_call', 'uses' => $module_controller.'is_patient_get_call']);
					Route::get('/patient_call_reject', ['as' => $route_slug.'patient_call_reject', 'uses' => $module_controller.'patient_call_reject']);

					Route::any('/video/initiate_patient_call',        ['as' => $route_slug.'video', 'uses' => $module_controller.'initiate_patient_call']);
					Route::any('/video/drop_patient_call',            ['as' => $route_slug.'video', 'uses' => $module_controller.'drop_patient_call']);
					Route::any('/video/update_patient_call_duration', ['as' => $route_slug.'video', 'uses' => $module_controller.'update_patient_call_duration']);

					Route::group(array('prefix' => '{enc_id}'), function () use($route_slug, $module_controller)
					{
						Route::get('/online_waiting_room', ['as' => $route_slug.'online_waiting_room', 'uses' => $module_controller.'online_waiting_room']);
						Route::get('/details',             ['as' => $route_slug.'upcoming_details',    'uses' => $module_controller.'upcoming_details']);
						Route::get('/video',               ['as' => $route_slug.'video',               'uses' => $module_controller.'video']);


					});
				});

				Route::group(array('prefix' => 'completed'), function () use($route_slug, $module_controller)
				{
					Route::get('/', ['as' => $route_slug.'completed', 'uses' => $module_controller.'completed']);

					Route::group(array('prefix' => '{enc_id}'), function () use($route_slug, $module_controller)
					{
						Route::get('/online_waiting_room', ['as' => $route_slug.'online_waiting_room', 'uses' => $module_controller.'online_waiting_room']);
						Route::get('/details',             ['as' => $route_slug.'completed_details',   'uses' => $module_controller.'completed_details']);
						Route::get('/feedback_review',     ['as' => $route_slug.'feedback_review',     'uses' => $module_controller.'feedback_review']);
						Route::get('/video',               ['as' => $route_slug.'video',               'uses' => $module_controller.'video']);
						Route::post('/feedback_review/store',     ['as' => $route_slug.'store_feedback_review',     'uses' => $module_controller.'store_feedback_review']);
					});
				});
			});

			/*--------------------------------------------------------------------------
										My Consultation Ends
			---------------------------------------------------------------------------*/


			/*--------------------------------------------------------------------------
										My Account start
			---------------------------------------------------------------------------*/

			Route::group(array('prefix' => 'my_account'), function () use($route_slug)
			{
				$route_slug        = "my_account_";
				$module_controller = "Front\Patient\MyAccountController@";

				Route::get('/about_me',         ['as' => $route_slug.'about_me',        'uses' => $module_controller.'about_me']);
				Route::post('/about_me/update', ['as' => $route_slug.'update_about_me', 'uses' => $module_controller.'update_about_me']);


				/*-----------------------------------------change password routes starts-----------------------------------------*/

				Route::get('/change_password',         ['as' => $route_slug.'change_password',        'uses' => $module_controller.'change_password']);
				Route::post('/change_password/update', ['as' => $route_slug.'update_change_password', 'uses' => $module_controller.'update_change_password']);

				/*-----------------------------------------change password routes ends-----------------------------------------*/


				/*-----------------------------------------family member routes starts-----------------------------------------*/

				Route::get('/family_member',                  ['as' => $route_slug.'family_member',        'uses' => $module_controller.'family_member']);
				Route::post('/family_member/add',             ['as' => $route_slug.'add_family_member',    'uses' => $module_controller.'add_family_member']);
				Route::get('/family_member/edit/{enc_id}',    ['as' => $route_slug.'edit_family_member',   'uses' => $module_controller.'edit_family_member']);
				Route::post('/family_member/update/{enc_id}', ['as' => $route_slug.'update_family_member', 'uses' => $module_controller.'update_family_member']);
				Route::get('/family_member/remove/{enc_id}',  ['as' => $route_slug.'remove_family_member', 'uses' => $module_controller.'remove_family_member']);

				/*-----------------------------------------family member routes ends-----------------------------------------*/

				/*-----------------------------------------card details routes starts-----------------------------------------*/

				Route::get('/card',         ['as' => $route_slug.'card',        'uses' => $module_controller.'card']);
				Route::post('/card/add',    ['as' => $route_slug.'add_card',    'uses' => $module_controller.'add_card']);
				Route::post('/card/delete', ['as' => $route_slug.'delete_card', 'uses' => $module_controller.'delete_card']);

				/*-----------------------------------------card details routes ends-----------------------------------------*/
			});

			/*--------------------------------------------------------------------------
										My Account Ends
			---------------------------------------------------------------------------*/

			/*--------------------------------------------------------------------------
										My Transactions Starts
			---------------------------------------------------------------------------*/

			Route::group(array('prefix' => 'transactions'), function () use($route_slug)
			{
				$route_slug        = "my_transactions_";
				$module_controller = "Front\Patient\TransactionController@";

				Route::group(array('prefix' => 'subscription'), function () use($route_slug, $module_controller)
				{
					Route::get('/', 				['as' => $route_slug.'index', 'uses' => $module_controller.'index']);
					Route::get('/view_transaction', ['as' => $route_slug.'view_transaction', 'uses' => $module_controller.'view_transaction']);
				});
				
				Route::group(array('prefix' => 'consultation'), function () use($route_slug, $module_controller)
				{
					Route::get('/',                 ['as' => $route_slug.'index',            'uses' => $module_controller.'index']);
					Route::get('/view_transaction', ['as' => $route_slug.'view_transaction', 'uses' => $module_controller.'view_transaction']);
				});
			});

			/*--------------------------------------------------------------------------
										My Transactions Ends
			---------------------------------------------------------------------------*/	


			/*--------------------------------------------------------------------------
										My Document Starts
			---------------------------------------------------------------------------*/

			Route::group(array('prefix' => 'documents'), function () use($route_slug)
			{
				$route_slug        = "my_documents_";
				$module_controller = "Front\Patient\DocumentController@";

				Route::group(array('prefix' => 'prescription'), function () use($route_slug, $module_controller)
				{
					Route::get('/',              ['as' => $route_slug.'prescription',      'uses' => $module_controller.'prescription']);
					Route::get('/view/{enc_id}', ['as' => $route_slug.'view_prescription', 'uses' => $module_controller.'view_prescription']);
				});

				Route::group(array('prefix' => 'medical_certificate'), function () use($route_slug, $module_controller)
				{
					Route::get('/', ['as' => $route_slug.'medical_certificate', 'uses' => $module_controller.'medical_certificate']);
				});
			
			});

			/*--------------------------------------------------------------------------
										My Document Ends
			---------------------------------------------------------------------------*/



			/*--------------------------------------------------------------------------
										Setting Starts
			---------------------------------------------------------------------------*/

			Route::group(array('prefix' => 'settings'), function () use($route_slug)
			{
				$route_slug        = "settings_";
				$module_controller = "Front\Patient\SettingController@";

				Route::get('/contact_us',        ['as' => $route_slug.'contact_us',       'uses' => $module_controller.'contact_us']);
				Route::post('/contact_us/store', ['as' => $route_slug.'store_contact_us', 'uses' => $module_controller.'store_contact_us']);

				Route::get('/invitation',                   ['as' => $route_slug.'invitation',        'uses' => $module_controller.'invitation']);
				Route::get('/invitation/download_template', ['as' => $route_slug.'download_template', 'uses' => $module_controller.'download_template']);
				Route::post('/invitation/import',           ['as' => $route_slug.'import',            'uses' => $module_controller.'import']);
				
				/*Route::get('/refer_a_friend',         ['as' => $route_slug.'refer_a_friend',  'uses' => $module_controller.'refer_a_friend']);*/

			});

			/*--------------------------------------------------------------------------
										Setting Ends
			---------------------------------------------------------------------------*/

			Route::group(array('prefix' => 'my_health'), function () use($route_slug)
			{
				$route_slug        = "my_account_";
				$module_controller = "Front\Patient\MyHealthController@";

				Route::get('/medical_history',             ['as' => $route_slug.'medical_history',   'uses' => $module_controller.'medical_history']);
				Route::post('/store_general',              ['as' => $route_slug.'store_general',     'uses' => $module_controller.'store_general']);
				Route::get('/medication',                  ['as' => $route_slug.'add_medication',    'uses' => $module_controller.'add_medication']);
				Route::post('/medication/store',           ['as' => $route_slug.'store_medication',  'uses' => $module_controller.'store_medication']);
				Route::get('/medication/edit/{enc_id}',    ['as' => $route_slug.'edit_medication',   'uses' => $module_controller.'edit_medication']);
				Route::post('/medication/update/{enc_id}', ['as' => $route_slug.'upadte_medication', 'uses' => $module_controller.'upadte_medication']);
				Route::get('/medication/delete/{enc_id}',  ['as' => $route_slug.'delete_medication', 'uses' => $module_controller.'delete_medication']);
				Route::get('/medication/view/{enc_id}',    ['as' => $route_slug.'view_medication',   'uses' => $module_controller.'view_medication']);

				Route::get('/lifestyle',                   ['as' => $route_slug.'lifestyle',         'uses' => $module_controller.'lifestyle']);
				Route::post('/update_lifestyle',           ['as' => $route_slug.'update_lifestyle',  'uses' => $module_controller.'update_lifestyle']);
				Route::get('/delete_general/{enc_id}',     ['as' => $route_slug.'delete_general',    'uses' => $module_controller.'delete_general']);

			});

			/*--------------------------------------------------------------------------
										Notifications
			---------------------------------------------------------------------------*/

			Route::group(array('prefix' => 'notification'), function () use($route_slug)
			{
				$route_slug        = "notification_";
				$module_controller = "Front\Patient\NotificationController@";

				Route::get('/',['as' => $route_slug.'list','uses' => $module_controller.'index']);
				Route::get('/delete/{enc_id}',['as' => $route_slug.'delete','uses' => $module_controller.'delete']);

			});

			/*--------------------------------------------------------------------------
										Notifications End
			---------------------------------------------------------------------------*/

		});
		
		/*--------------------------------------------------------------------------
									After Login Ends
		---------------------------------------------------------------------------*/
		
	});
?>