<?php

namespace App\Http\Controllers\Front\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\SubscriptionTransactionModel;
use App\Models\ConsultationTransactionModel;
use App\Models\ConsultationSettingModel;
use App\Models\SubscriptionPlanModel;
use App\Models\FamilyMemberModel;
use App\Models\ConsultationModel;
use App\Models\AvailabilityModel;
use App\Models\DiscountCodeModel;
use App\Models\CardDetailsModel;
use App\Models\CMSCategoryModel;
use App\Models\TimezoneModel;
use App\Models\PrefixModel;

use App\Common\Services\AdminNotificationService;
use App\Common\Services\UserNotificationService;
use App\Common\Services\CommonDataService;
use App\Common\Services\StripeService;

use Validator;
use Sentinel;
use Session;
use Stripe;
use Carbon;
use DB;
use PDF;

class ConsultationController extends Controller
{
    public function __construct(
    								UserNotificationService  $user_notification_service,
    								AdminNotificationService $notification_service,
    								CommonDataService        $common_data_service,
    								StripeService            $stripe_service
    							)
	{
		$this->user_id = $this->user_first_name = $this->user_last_name = $this->user_email = $this->user_phone_code = $this->user_mobile_no = $this->user_timezone = '';

		$this->SubscriptionTransactionModel            = new SubscriptionTransactionModel();
		$this->ConsultationTransactionModel            = new ConsultationTransactionModel();
		$this->ConsultationSettingModel                = new ConsultationSettingModel();
		$this->SubscriptionPlanModel                   = new SubscriptionPlanModel();
		$this->FamilyMemberModel                       = new FamilyMemberModel();
		$this->ConsultationModel                       = new ConsultationModel();
		$this->AvailabilityModel                       = new AvailabilityModel();
		$this->DiscountCodeModel                       = new DiscountCodeModel();
		$this->CardDetailsModel                        = new CardDetailsModel();
		$this->CMSCategoryModel                        = new CMSCategoryModel();
		$this->TimezoneModel                           = new TimezoneModel();
		$this->PrefixModel                             = new PrefixModel();

		$this->UserNotificationService                 = $user_notification_service;
		$this->AdminNotificationService                = $notification_service;
		$this->CommonDataService                       = $common_data_service;
		$this->StripeService                           = $stripe_service;

		$this->arr_view_data                           = [];
		$this->module_title                            = "Consultation";
		$this->parent_url_path                         = url('/').'/patient';
		$this->module_url_path                         = url('/').'/patient/consultation';
		$this->module_view_folder                      = "front.patient.consultation";

		$this->breadcrum_level_1                       = 'Dashboard';
		$this->breadcrum_level_2                       = $this->module_title;

		$this->breadcrum_level_1_url                   = $this->parent_url_path.'/dashboard';
		$this->breadcrum_level_2_url                   = $this->module_url_path;

		$this->illness_img_base_path                   = base_path().config('app.img_path.illness_img');
		$this->illness_img_public_path                 = url('/').config('app.img_path.illness_img');

		$this->illness_category_base_path              =  base_path().config('app.img_path.illness_category');                
		$this->illness_category_public_path            = url('/').config('app.img_path.illness_category');
		$this->illness_category_default_img_path       = url('/').config('app.img_path.default_img_path');

		$this->patient_transaction_invoice_base_path   = base_path().config('app.img_path.transaction_invoice');
		$this->patient_transaction_invoice_public_path = url('/').config('app.img_path.transaction_invoice');

		$user                                          = Sentinel::check();

        if($user):
			$this->user_id         = $user->id;
			$this->user_first_name = $user->first_name;
			$this->user_last_name  = $user->last_name;
			$this->user_email      = $user->email;
			$this->user_phone_code = $user->phone_code;
			$this->user_mobile_no  = $user->mobile_no;
			$this->user_timezone   = $user->timezone;
        endif;
	}


    public function index()
	{
		$consultation_id = base64_encode($this->CommonDataService->get_consultation_id());
		Session::put('consultation_id', $consultation_id);

		$redirect_url = url('/patient/consultation/subscription_plan');

		$count = $this->SubscriptionTransactionModel->where('user_id', $this->user_id)
													->where('end_date', '>', date('c'))
													->where('status', 'paid')
													->count();

		if( $count > 0):
			$data['plan'] = 1;
			$redirect_url = url('/patient/consultation/'.$consultation_id.'/patient');
		endif;

		$data['consultation_id'] = base64_decode( $consultation_id );
		$data['date']            = date('c');
		$data['user_id']         = $this->user_id;

		$consultation_record = $this->ConsultationModel->where('consultation_id', $consultation_id);
		if( $consultation_record->count() > 0 ):
			$output = $consultation_record->update($data);

		else:
	        $output = $this->ConsultationModel->insert($data);

		endif;

		return redirect( $redirect_url );

	} // end index


	public function check_session_id()
	{
		if(empty(Session::get('consultation_id')) && Session::get('consultation_id') == null):
			return redirect( url('/patient/consultation') );
		endif;
	}


	/*-----------------------------------------subscription plan function starts-----------------------------------------*/

    public function subscription_plan()
	{
		$arr_subscription_plan = [];

		$obj_subscription_plan = $this->SubscriptionPlanModel->get();
		if($obj_subscription_plan):
			$arr_subscription_plan = $obj_subscription_plan->toArray();
		endif;

		$this->arr_view_data['arr_subscription_plan'] = $arr_subscription_plan;

		$this->arr_view_data['page_title']            = 'Subscription Plan';

		$this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_2']     = $this->breadcrum_level_2;
		$this->arr_view_data['breadcrum_level_3']     = 'Subscription Plan';

		$this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
		$this->arr_view_data['breadcrum_level_3_url'] = $this->breadcrum_level_2_url.'/subscription_plan';

		return view($this->module_view_folder.'.subscription_plan', $this->arr_view_data);
	} // end subscription_plan


	public function sp_payment(Request $request)
	{
		$arr_rules = $arr_subscription_plan = [];

        $arr_rules['subscription_plan_id'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        
        if($validator->fails()):
			Session::flash('error','Something went wrong! Please try again.');
            return redirect()->back();
        endif;

		$subscription_plan_id = $request->input('subscription_plan_id');
		
		if( $subscription_plan_id == 1 ):
			// Get subscription plan details 
			$obj_subscription_plan = $this->SubscriptionPlanModel->where('id',$subscription_plan_id)->first();
			if($obj_subscription_plan):
				$arr_subscription_plan = $obj_subscription_plan->toArray();
			endif;

			$this->arr_view_data['arr_subscription_plan'] = $arr_subscription_plan;

			// Get User Card Details list
			$this->arr_view_data['card_details']          = $this->StripeService->get_card_details( $this->user_id );
			$this->arr_view_data['page_title']            = 'Subscription Plan Payment';
			
			$this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
			$this->arr_view_data['breadcrum_level_2']     = $this->breadcrum_level_2;
			$this->arr_view_data['breadcrum_level_3']     = 'Subscription Plan';
			$this->arr_view_data['breadcrum_level_4']     = 'Subscription Plan Payment';

			$this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
			$this->arr_view_data['breadcrum_level_3_url'] = $this->breadcrum_level_2_url.'/subscription_plan';

			return view($this->module_view_folder.'.sp_payment', $this->arr_view_data);
		else:
			return redirect( url('/patient/consultation/'.Session::get('consultation_id').'/patient') );
		endif;
	} // end sp_payment


	public function sp_discount_apply(Request $request)
	{
		$arr_rules["discount_code"] = 'required';

		$validator = Validator::make($request->all(),$arr_rules);
		if($validator->fails()):
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Error! Something went wrong. Please enter all the required fields and try again.';

            return response()->json($return_arr);
        endif;

        $today         = date("Y-m-d");
        $sp_price      = $request->input('sp_price');
        $discount_code = $request->input('discount_code');

		$obj_discount = $this->DiscountCodeModel->where('code', $discount_code)
												->where('status', 1)
												->whereRaw( "(( DATE('".$today."') BETWEEN DATE(start_date) AND DATE(end_date) ) OR 
													( DATE('".$today."') BETWEEN DATE(start_date) AND DATE(end_date) ) OR 
													( DATE(start_date) BETWEEN DATE('".$today."') AND DATE('".$today."') ) OR 
													( DATE(end_date) BETWEEN DATE('".$today."') AND DATE('".$today."') ))" )
												->first();
		if( $obj_discount ):
			$arr_discount = $obj_discount->toArray();

			$st_count = $this->SubscriptionTransactionModel->where('discount_id', $arr_discount['id'])->where('user_id', $this->user_id)->count();
			$ct_count = $this->ConsultationTransactionModel->where('discount_id', $arr_discount['id'])->where('user_id', $this->user_id)->count();

			if( $st_count > 0 || $ct_count > 0 ):
				$return_arr['status']  = 'error';
            	$return_arr['message'] = "Error! Discount code can't be use more than once.";
            
            else:
				$return_arr['discount_id']    = $arr_discount['id'];
				$return_arr['discount_price'] = decrypt_value($arr_discount['price']);

				$return_arr['status']  = 'success';
				$return_arr['message'] = 'Success! Discount code applied.';

			endif;

        else:
        	$return_arr['status']  = 'error';
            $return_arr['message'] = "Error! Invalid Discount code.";

		endif;

		return response()->json($return_arr);
	} // end sp_discount_apply


	public function sp_payment_process(Request $request)
	{
		$payment_data = $card_data = $arr_rules = $return_arr = $arr_sub_transaction = [];

		if( $request->input("stripe_card") == null):
			$arr_rules["card_name"]    = 'required';
			$arr_rules["card_no"]      = 'required';
			$arr_rules["expiry_month"] = 'required';
			$arr_rules["expiry_year"]  = 'required';
			$arr_rules["cvv"]          = 'required';

		else:
			$arr_rules["customer_id"] = 'required';
			$arr_rules["card_id"]     = 'required';

		endif;
		
		$validator = Validator::make($request->all(),$arr_rules);
		if($validator->fails()):
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Something went wrong! Please enter or select all the required fields and try again.';
            return response()->json($return_arr);

        endif;


		$stripe_card = $request->input("stripe_card");

		if( $stripe_card == null):

			$card_name    = $request->input("card_name");
			$card_no      = $request->input("card_no");
			$cvv          = $request->input("cvv");
			$expiry_month = $request->input("expiry_month");
			$expiry_year  = $request->input("expiry_year");


			/*----------------Store card details in stripe account starts----------------*/
			$card_data['card_name']    = $card_name;
			$card_data['card_no']      = $card_no;
			$card_data['cvv']          = $cvv;
			$card_data['expiry_month'] = $expiry_month;
			$card_data['expiry_year']  = $expiry_year;

			$output = $this->StripeService->store_card( $this->user_id, $card_data );

			if( $output['status'] == 'error' ):
				$return_arr['status']  = 'error';
				$return_arr['message'] = $output['message'];
				return response()->json($return_arr);

			else:
				$payment_data['customer_id'] = $output['customer_id'];
				$payment_data['card_id']     = $output['card_id'];

			endif;
			/*----------------Store card details in stripe account ends----------------*/

		else:
			$payment_data['customer_id'] = $request->input("customer_id");
			$payment_data['card_id']     = $request->input("card_id");

		endif;
		

		$discount_price = $request->input("discount_price", 0);
		$discount_code  = $request->input("discount_code");
		$discount_id    = $request->input("discount_id");
		$sp_price       = $request->input("sp_price");

		$discount_price = isset($discount_price) && $discount_price!='' ? $discount_price : 0;
		$payment_data['payment_price'] = $sp_price - $discount_price;

		$result = $this->StripeService->subscription_payment( $payment_data );

		if( $result['status'] == 'error' ):
			$return_arr['status']  = 'error';
			$return_arr['message'] = $result['message'];

		else:

			$stransaction_id = $this->CommonDataService->get_stransaction_id();

			$st_data['user_id']         = $this->user_id;
			$st_data['invoice_no']      = $stransaction_id;
			$st_data['transaction_id']  = $result['transaction_id'];
			$st_data['sp_amount']       = $sp_price;
			$st_data['discount_id']     = $discount_id;
			$st_data['discount_amount'] = $discount_price;
			$st_data['paid_amount']     = $payment_data['payment_price'];
			$st_data['start_date']      = date('c');
			$st_data['end_date']        = date('c', strtotime('+365 days'));
			$st_data['status']          = "paid";

			$subscription_transaction_id = $this->SubscriptionTransactionModel::insertGetId($st_data);

		/*-------------------------Invoice Generate by Gaurav(27-02-2019)------------------------------------------------*/

			if( isset( $subscription_transaction_id ) && $subscription_transaction_id>0 ):
				
				$obj_transaction = $this->SubscriptionTransactionModel->with('discount_details')->where('id',$subscription_transaction_id)->first();
                if ( $obj_transaction ):
                	$arr_sub_transaction = $obj_transaction->toArray();
					                	
                	$first_name   = isset( $this->user_first_name ) && !empty( $this->user_first_name ) ? ucfirst( decrypt_value($this->user_first_name) ) :''; 
                	$last_name 	  = isset( $this->user_last_name ) && !empty( $this->user_last_name ) ? ucfirst( decrypt_value($this->user_last_name) ) :'';
                	$patient_name = $first_name.' '.$last_name;

                	$arr_sub_transaction['patient_name']     = $patient_name;
                	$this->arr_view_data['arr_transactions'] = $arr_sub_transaction; 
                endif;
                
				if( !empty( $this->arr_view_data ) ):
				    // Custom Header
				    $file_name = $stransaction_id.'.pdf';
		 			PDF::setHeaderCallback(function($pdf) 
						 {
					        $pdf->SetY(15);
					        $pdf->SetFont('helvetica', 'B', 20);
					        $pdf->SetY(40);
						 });
						
					// Custom Footer
					PDF::setFooterCallback(function($pdf) {
				        // Position at 15 mm from bottom
				        $pdf->SetY(-15);
				        // Set font
				        $pdf->SetFont('helvetica', 'I', 8);
				        // Page number
				        $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
					});

					PDF::SetTitle('Mobi Doctor | Subscription Transaction Details');
					PDF::SetMargins(10, 30, 10, 10);
					PDF::SetFontSubsetting(false);
					PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
					PDF::AddPage();
					PDF::writeHTML(view($this->module_view_folder.'.subscription_invoice',$this->arr_view_data)->render());
					PDF::Output($this->patient_transaction_invoice_base_path.'/'.$file_name,'F');  
				endif;	
			endif;	

		/*--------------------------------End gaurav work-----------------------------------------------------*/
		
			$arr_notification['from_user_id']     = $this->user_id;
			$arr_notification['message']          = decrypt_value($this->user_first_name).' '.decrypt_value($this->user_last_name).' has purchase subscription plan successfully.';
			$arr_notification['notification_url'] = '/admin/subscription/transaction';
            $this->AdminNotificationService->create_admin_notification($arr_notification);

            $arr_notification['to_user_id']       = $this->user_id;
			$arr_notification['from_user_id']     = 1;
			$arr_notification['message']          = 'You have successfully purchase subscription plan.';
			$arr_notification['notification_url'] = '/patient/transactions/subscription';
			$this->UserNotificationService->create_user_notification($arr_notification);

			$return_arr['status']  = $result['status'];
			$return_arr['message'] = $result['message'];

			$data['consultation_id'] = base64_decode( Session::get('consultation_id') );
			$data['user_id']         = $this->user_id;
			$data['plan']            = 1;

			$consultation_record = $this->ConsultationModel->where('consultation_id', $data['consultation_id']);
			if( $consultation_record->count() > 0 ):
				$output = $consultation_record->update($data);

			else:
		        $output = $this->ConsultationModel->insert($data);

			endif;

		endif;

		return response()->json($return_arr);

	} // end sp_payment_process

	/*-----------------------------------------subscription plan function ends-----------------------------------------*/



	/*-----------------------------------------Consultation Booking function starts-----------------------------------------*/

	public function select_patient()
	{
		$arr_family_member = $arr_consultation = [];

		$this->check_session_id();

		$obj_family_member = $this->FamilyMemberModel->select('id','first_name','last_name')->where('user_id', $this->user_id)->get();

		// Check if there is any family member added or else skip this process by selecting user as the patient
		if( count( $obj_family_member ) > 0 ):
			$arr_family_member = $obj_family_member->toArray();

			$obj_consultation = $this->ConsultationModel->select('id','consultation_id','user_id','patient_id','who_is_patient')->where('consultation_id', base64_decode( Session::get('consultation_id') ))->where('user_id', $this->user_id)->first();
			if( $obj_consultation ):
				$arr_consultation = $obj_consultation->toArray();
			endif;

			$this->arr_view_data['arr_family_member']       = $arr_family_member;
			$this->arr_view_data['session_consultation_id'] = Session::get('consultation_id');
			$this->arr_view_data['arr_consultation']        = $arr_consultation;

			$this->arr_view_data['page_title']              = 'Select Patient';
			$this->arr_view_data['module_url_path']         = $this->module_url_path;

			$this->arr_view_data['breadcrum_level_1']       = $this->breadcrum_level_1;
			$this->arr_view_data['breadcrum_level_2']       = $this->breadcrum_level_2;
			$this->arr_view_data['breadcrum_level_3']       = 'Select Patient';

			$this->arr_view_data['breadcrum_level_1_url']   = $this->breadcrum_level_1_url;

			return view($this->module_view_folder.'.select_patient', $this->arr_view_data);

		// skip select patient process and store user as patient for the current consultation
		else:

			$data['consultation_id'] = base64_decode( Session::get('consultation_id') );
			$data['user_id']         = $this->user_id;
			$data['who_is_patient']  = "user";
			$data['patient_id']      = $this->user_id;

			$consultation_record = $this->ConsultationModel->where('consultation_id', $data['consultation_id']);
			if( $consultation_record->count() > 0 ):
				$output = $consultation_record->update($data);

			else:
		        $output = $this->ConsultationModel->insert($data);

			endif;

	        if( $output ):
	        	return redirect( url('/patient/consultation/'.Session::get('consultation_id').'/time') );

	        else:
	        	Session::flash('error','Something went wrong! Please try again.');
	        	return redirect( url('/patient/dashboard') );

	        endif;

		endif;
	} // end select_patient


	public function select_patient_process(Request $request)
	{
		$output  = '';

		$this->check_session_id();

		$arr_rules['select_patient'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        
        if($validator->fails()):
			Session::flash('error','Select patient for the consultation! Please try again.');
            return redirect()->back();
        endif;

        $select_patient = $request->input('select_patient');
        if( $select_patient == 'user' ):
			$data['who_is_patient'] = $select_patient;
			$data['patient_id']     = $this->user_id;

		else:
			$data['who_is_patient'] = "family";
			$data['patient_id']     = $select_patient;

		endif;

		$data['consultation_id'] = base64_decode( Session::get('consultation_id') );
		$data['user_id']         = $this->user_id;

		$consultation_record = $this->ConsultationModel->where('consultation_id', $data['consultation_id']);
		if( $consultation_record->count() > 0 ):
			$output = $consultation_record->update($data);

		else:
	        $output = $this->ConsultationModel->insert($data);

		endif;

        if( $output ):
        	return redirect( url('/patient/consultation/'.Session::get('consultation_id').'/time') );
        endif;

        Session::flash('error','Something went wrong! Please try again.');
        return redirect()->back();
	} // end select_patient_process


	public function select_day()
	{
		$arr_availability = $arr_consultation = '';

		$this->check_session_id();

		$obj_consultation = $this->ConsultationModel->select('id','consultation_id','user_id','date')->where('consultation_id', base64_decode( Session::get('consultation_id') ))->where('user_id', $this->user_id)->first();
		if( $obj_consultation ):
			$arr_consultation = $obj_consultation->toArray();
		endif;

		$obj_availability = $this->AvailabilityModel->where('start_datetime','>=',Carbon::now())
													->select( 'id', DB::raw('DATE_FORMAT(start_datetime, "%W,%Y-%m-%d") as start_date'), DB::raw('DATE_FORMAT(end_datetime, "%W,%Y-%m-%d") as end_date') )
													->orderBy('start_datetime','ASC')
													->groupBy('start_datetime')
													->take(6)
													->get();
		if( $obj_availability ):
			$arr_availability = $obj_availability->toArray();
		endif;

		$this->arr_view_data['arr_availability']        = $arr_availability;
		$this->arr_view_data['arr_consultation']        = $arr_consultation;
		$this->arr_view_data['session_consultation_id'] = Session::get('consultation_id');

		$this->arr_view_data['page_title']              = 'Select Day';
		$this->arr_view_data['module_url_path']         = $this->module_url_path;

		$this->arr_view_data['breadcrum_level_1']       = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_2']       = $this->breadcrum_level_2;
		$this->arr_view_data['breadcrum_level_3']       = 'Select Day';

		$this->arr_view_data['breadcrum_level_1_url']   = $this->breadcrum_level_1_url;

		return view($this->module_view_folder.'.select_day', $this->arr_view_data);
	} // end select_day


	public function select_day_process(Request $request)
	{
		$this->check_session_id();

		$arr_rules['select_day'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        
        if($validator->fails()):
			Session::flash('error','Select day for the consultation! Please try again.');
            return redirect()->back();
        endif;

        $data['date'] = $request->input('select_day');

		$consultation_record = $this->ConsultationModel->where('consultation_id', base64_decode(Session::get('consultation_id')));
		if( $consultation_record->count() > 0 ):
			$output = $consultation_record->update($data);

		else:
	        $output = $this->ConsultationModel->insert($data);

		endif;

        if( $output ):
        	return redirect( url('/patient/consultation/'.Session::get('consultation_id').'/time') );
        endif;

        Session::flash('error','Something went wrong! Please try again.');
        return redirect()->back();
	} // end select_day_process


	public function select_time()
	{
		$consultation_date = $consultation_time = $time_interval = '';
		$arr_consultationsetting = $arr_consultation = $arr_family_member = $arr_timezone = $time_slot = [];

		$this->check_session_id();

		$obj_consultationsetting = $this->ConsultationSettingModel->where('id', 1)->select('time_interval')->first();
		if($obj_consultationsetting):
			$arr_consultationsetting = $obj_consultationsetting->toArray();
			$time_interval = $arr_consultationsetting['time_interval'];
		endif;

		$obj_consultation = $this->ConsultationModel->where('user_id', $this->user_id)
													->where('consultation_id', base64_decode( Session::get('consultation_id') ))
													->select('date','time','doctor_id')
													->first();
		if( $obj_consultation ):
			$arr_consultation  = $obj_consultation->toArray();
			$consultation_date = $arr_consultation['date'];
		endif;

		$obj_availability = $this->AvailabilityModel->where('start_date', $consultation_date)
													->select('id', 'doctor_id', 'start_datetime', 'start_date', 'start_time', 'end_datetime', 'end_date', 'end_time')
													->whereHas('doctor_details',function($qry){
														$qry->where('is_pause','=','0');
													 })
													->orderBy('start_datetime','ASC')
													->get();
		if( $obj_availability ):
			$arr_availability = $obj_availability->toArray();

			$i = 0;

			foreach($arr_availability as $key => $doc_avail):

				$current_datetime = strtotime(date("Y-m-d H:i:s"));
				$start_datetime   = strtotime($doc_avail['start_datetime']);
				$end_datetime     = strtotime($doc_avail['end_datetime']);
				$doctor_id        = $doc_avail['doctor_id'];

                while ($start_datetime < $end_datetime):
                    
                    if ($start_datetime > $current_datetime):
                        $slot = convert_datetime( date("Y-m-d H:i:s", $start_datetime), 'user', 'time' );

                        $time_slot[$i]['doctor_id'] = $doctor_id;
		                $time_slot[$i]['time'] = $slot;
		                $i++;

                    endif;
                    
                    $start_datetime = strtotime('+'.$time_interval.' minutes', $start_datetime);

                endwhile;
          	endforeach;

		endif;

		$this->arr_view_data['time_slot']               = $time_slot;
		$this->arr_view_data['arr_consultation']        = $arr_consultation;
		$this->arr_view_data['arr_consultationsetting'] = $arr_consultationsetting;
		$this->arr_view_data['session_consultation_id'] = Session::get('consultation_id');

		$this->arr_view_data['page_title']              = 'Select Time';
		$this->arr_view_data['module_url_path']         = $this->module_url_path;

		$this->arr_view_data['breadcrum_level_1']       = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_2']       = $this->breadcrum_level_2;
		$this->arr_view_data['breadcrum_level_3']       = 'Select Time';

		$this->arr_view_data['breadcrum_level_1_url']   = $this->breadcrum_level_1_url;

		return view($this->module_view_folder.'.select_time', $this->arr_view_data);
	} // end select_time


	public function select_time_process(Request $request)
	{
		$output = '';
		$arr_availability = [];

		$this->check_session_id();

		$arr_rules['select_time'] = 'required';
        $validator = Validator::make($request->all(),$arr_rules);        
        if($validator->fails()):
			Session::flash('error','Select time for the consultation! Please try again.');
            return redirect()->back();
        endif;

        $data['time']      = convert_datetime( $request->input('select_time'), 'utc', 'time' );
        $data['doctor_id'] = $request->input('selected_doctor_id');


		$consultation_record = $this->ConsultationModel->where('consultation_id', base64_decode(Session::get('consultation_id')));

		if( $consultation_record ):
			$record_consultation = $consultation_record->select('date')->first()->toArray();

			$consultation_datetime = $record_consultation['date'].' '.$data['time'];
			$consultation_date     = $record_consultation['date'];
			$consultation_time     = $data['time'];

			$obj_consultation = $this->ConsultationModel->select("id","consultation_id","user_id","doctor_id","date","time","is_completed")
                                                        ->where('consultation_id','!=',base64_decode(Session::get('consultation_id')))
                                                        ->where('doctor_id', $data['doctor_id'])
                                                        ->where('date', $consultation_date)
                                                        ->where('time', $consultation_time)
                                                        ->first();
            if( $obj_consultation ):
                $arr_consultation = $obj_consultation->toArray();

                if( count( $arr_consultation ) > 0 ):

                	$arr_consultation['time'] = $data['time'];

                	$output = $this->check_availability($arr_consultation);

                	if( $output == false ):
                		return redirect()->back();
                	else:
                		$data['doctor_id'] = $output;
                	endif;

                endif;

            endif;

		endif;

		if( $consultation_record->count() > 0 ):
			$output = $consultation_record->update($data);

		else:
	        $output = $this->ConsultationModel->insert($data);

		endif;

        if( $output ):
        	return redirect( url('/patient/consultation/'.Session::get('consultation_id').'/payment') );
        endif;

        Session::flash('error','Something went wrong! Please try again.');
        return redirect()->back();
	} // end select_time_process


	public function check_availability($data)
	{
		$consultation_datetime = $data['date'].' '.$data['time'];
		$consultation_date     = $data['date'];
		$consultation_time     = $data['time'];

		$obj_availability = $this->AvailabilityModel->select('id', 'doctor_id', 'start_datetime', 'start_date', 'start_time', 'end_datetime', 'end_date', 'end_time')
    												->where('doctor_id', '!=', $data['doctor_id'])
    												->whereHas('doctor_details',function($qry){
														$qry->where('is_pause','=','0');
													 })
    												->whereRaw(" ('".$consultation_datetime."' BETWEEN start_datetime AND end_datetime) OR ( start_datetime BETWEEN '".$consultation_datetime."' AND '".$consultation_datetime."') OR ( end_datetime BETWEEN '".$consultation_datetime."' AND '".$consultation_datetime."') ")
    												->whereHas('doctor_details',function($qry){
																$qry->where('is_pause','=','0');
													  })
    												->orderBy('start_datetime','ASC')
													->get();
		if( $obj_availability ):
			$arr_availability = $obj_availability->toArray();

			if( count( $arr_availability ) == 0 ):
				Session::flash('error','Doctor is not available for the selected time. Please change the selected time.');
				return false;

			else:

				foreach( $arr_availability as $doc_available ):

					$doctor_id = $doc_available['doctor_id'];

					$obj_consultation = $this->ConsultationModel->select("id","consultation_id","user_id","doctor_id","date","time","is_completed")
		                                                        ->where('consultation_id','!=',base64_decode(Session::get('consultation_id')))
		                                                        ->where('doctor_id', $doctor_id)
		                                                        ->where('date', $consultation_date)
		                                                        ->where('time', $consultation_time)
		                                                        ->get();

		            if( count( $obj_consultation ) == 0 ):
		            	return $doctor_id;
		            endif;

				endforeach;

			endif;

		endif;

		Session::flash('error','Doctor is not available for the selected time. Please change the selected time.');
		return false;
	} // end check_availability


	public function payment()
	{
		$arr_consultation = '';

		$this->check_session_id();

		$obj_consultation = $this->ConsultationModel->select('id','consultation_id','who_is_patient','patient_id','date','time','plan','payment')
													->where('user_id', $this->user_id)
													->where('consultation_id', base64_decode( Session::get('consultation_id') ))
													->with('subscription_plan')
													->first();
		if( $obj_consultation ):
			$arr_consultation  = $obj_consultation->toArray();

			if( $arr_consultation['payment'] == 'paid' ):
				return redirect( url('/').'/patient/consultation/'.Session::get('consultation_id').'/reason' );
			endif;

			// Patient information is patient is family member
			if( $arr_consultation['who_is_patient'] == 'family' ):

				$obj_family_member = $this->FamilyMemberModel->select('id','first_name','last_name')
															 ->where('id', $arr_consultation['patient_id'])
															 ->where('user_id', $this->user_id)
															 ->first();
				if( $obj_family_member ):
					$this->arr_view_data['arr_patient'] = $obj_family_member;
				endif;

			endif;
		endif;

		// Get User Card Details list
		$this->arr_view_data['card_details']            = $this->StripeService->get_card_details( $this->user_id );

		$this->arr_view_data['session_consultation_id'] = Session::get('consultation_id');
		$this->arr_view_data['arr_consultation']        = $arr_consultation;

		$this->arr_view_data['page_title']              = 'Payment';
		$this->arr_view_data['module_url_path']         = $this->module_url_path;

		$this->arr_view_data['breadcrum_level_1']       = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_2']       = $this->breadcrum_level_2;
		$this->arr_view_data['breadcrum_level_3']       = 'Payment';

		$this->arr_view_data['breadcrum_level_1_url']   = $this->breadcrum_level_1_url;

		return view($this->module_view_folder.'.payment', $this->arr_view_data);
	} // end payment


	public function apply_discount(Request $request)
	{
		$arr_rules["discount_code"] = 'required';

		$validator = Validator::make($request->all(),$arr_rules);
		if($validator->fails()):
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Error! Something went wrong. Please enter all the required fields and try again.';

            return response()->json($return_arr);
        endif;

        $today              = date("Y-m-d");
        $discount_code      = $request->input('discount_code');
        $consultation_price = $request->input('consultation_price');

		$obj_discount = $this->DiscountCodeModel->where('code', $discount_code)
												->where('status', 1)
												->whereRaw( "(( DATE('".$today."') BETWEEN DATE(start_date) AND DATE(end_date) ) OR 
													( DATE('".$today."') BETWEEN DATE(start_date) AND DATE(end_date) ) OR 
													( DATE(start_date) BETWEEN DATE('".$today."') AND DATE('".$today."') ) OR 
													( DATE(end_date) BETWEEN DATE('".$today."') AND DATE('".$today."') ))" )
												->first();
		if( $obj_discount ):
			$arr_discount = $obj_discount->toArray();

			$ct_count = $this->ConsultationTransactionModel->where('discount_id', $arr_discount['id'])->where('user_id', $this->user_id)->count();
			$st_count = $this->SubscriptionTransactionModel->where('discount_id', $arr_discount['id'])->where('user_id', $this->user_id)->count();

			if( $ct_count > 0 || $st_count > 0 ):
				$return_arr['status']  = 'error';
            	$return_arr['message'] = "Error! Discount code can't be use more than once.";
            
            else:
				$return_arr['discount_id']    = $arr_discount['id'];
				$return_arr['discount_price'] = decrypt_value($arr_discount['price']);

				$return_arr['status']  = 'success';
				$return_arr['message'] = 'Success! Discount code applied.';

			endif;

        else:
        	$return_arr['status']  = 'error';
            $return_arr['message'] = "Error! Invalid Discount code.";

		endif;

		return response()->json($return_arr);
	} // end apply_discount


	public function payment_process(Request $request)
	{
		$payment_data = $card_data = $arr_rules = $return_arr = $arr_concultation_transaction = [];

		if( $request->input("stripe_card") == null):
			$arr_rules["card_name"]    = 'required';
			$arr_rules["card_no"]      = 'required';
			$arr_rules["expiry_month"] = 'required';
			$arr_rules["expiry_year"]  = 'required';
			$arr_rules["cvv"]          = 'required';

		else:
			$arr_rules["customer_id"] = 'required';
			$arr_rules["card_id"]     = 'required';

		endif;
		
		$validator = Validator::make($request->all(),$arr_rules);
		if($validator->fails()):
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Something went wrong! Please enter or select all the required fields and try again.';
            return response()->json($return_arr);

        endif;


		$stripe_card = $request->input("stripe_card");

		if( $stripe_card == null):

			$card_name    = $request->input("card_name");
			$card_no      = $request->input("card_no");
			$cvv          = $request->input("cvv");
			$expiry_month = $request->input("expiry_month");
			$expiry_year  = $request->input("expiry_year");


			/*----------------Store card details in stripe account starts----------------*/
			$card_data['card_name']    = $card_name;
			$card_data['card_no']      = $card_no;
			$card_data['cvv']          = $cvv;
			$card_data['expiry_month'] = $expiry_month;
			$card_data['expiry_year']  = $expiry_year;

			$output = $this->StripeService->store_card( $this->user_id, $card_data );

			if( $output['status'] == 'error' ):
				$return_arr['status']  = 'error';
				$return_arr['message'] = $output['message'];
				return response()->json($return_arr);

			else:
				$payment_data['customer_id'] = $output['customer_id'];
				$payment_data['card_id']     = $output['card_id'];

			endif;
			/*----------------Store card details in stripe account ends----------------*/


		else:
			$payment_data['customer_id'] = $request->input("customer_id");
			$payment_data['card_id']     = $request->input("card_id");

		endif;
		

		$consultation_price = $request->input("consultation_price");
		$discount_price     = $request->input("discount_price", 0);
		$discount_code      = $request->input("discount_code");
		$discount_id        = $request->input("discount_id");

		$discount_price = isset($discount_price) && $discount_price!='' ? $discount_price : 0;
		$payment_data['payment_price'] = $consultation_price - $discount_price;

		$result = $this->StripeService->subscription_payment( $payment_data );

		if( $result['status'] == 'error' ):
			$return_arr['status']  = 'error';
			$return_arr['message'] = $result['message'];

		else:
			
			$ctransaction_id = $this->CommonDataService->get_ctransaction_id();

			$ct_data['user_id']         = $this->user_id;
			$ct_data['call_duration']   = '10';
			$ct_data['consultation_id'] = base64_decode(Session::get('consultation_id'));
			$ct_data['invoice_no']      = $ctransaction_id;
			$ct_data['transaction_id']  = $result['transaction_id'];
			$ct_data['amount']          = $consultation_price;
			$ct_data['discount_id']     = $discount_id;
			$ct_data['discount_amount'] = $discount_price;
			$ct_data['paid_amount']     = $payment_data['payment_price'];
			$ct_data['status']          = 'paid';

			$consultation_transaction_id = $this->ConsultationTransactionModel::insertGetId($ct_data);
			
			$data['payment'] = 'paid';
			$this->ConsultationModel->where('consultation_id', base64_decode( Session::get('consultation_id') ))->update($data);

		/*-------------------------Invoice Generate by Gaurav(28-02-2019)------------------------------------------------*/	
			if( isset( $consultation_transaction_id ) && $consultation_transaction_id>0 ):
				
				$obj_transaction = $this->ConsultationTransactionModel->with('discount_details')->where('id',$consultation_transaction_id)->first();
                if ( $obj_transaction ):
                	$arr_concultation_transaction = $obj_transaction->toArray();
					                	
                	$first_name   = isset( $this->user_first_name ) && !empty( $this->user_first_name ) ? ucfirst( decrypt_value($this->user_first_name) ) :''; 
                	$last_name 	  = isset( $this->user_last_name ) && !empty( $this->user_last_name ) ? ucfirst( decrypt_value($this->user_last_name) ) :'';
                	$patient_name = $first_name.' '.$last_name;

                	$arr_concultation_transaction['patient_name'] = $patient_name;
                	$this->arr_view_data['arr_transactions']      = $arr_concultation_transaction; 
                endif;
							                
				if( !empty( $this->arr_view_data ) ):
				    // Custom Header
				    $file_name = $ctransaction_id.'.pdf';
		 			PDF::setHeaderCallback(function($pdf) 
						 {
					        $pdf->SetY(15);
					        $pdf->SetFont('helvetica', 'B', 20);
					        $pdf->SetY(40);
						 });
						
					// Custom Footer
					PDF::setFooterCallback(function($pdf) {
				        // Position at 15 mm from bottom
				        $pdf->SetY(-15);
				        // Set font
				        $pdf->SetFont('helvetica', 'I', 8);
				        // Page number
				        $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
					});

					PDF::SetTitle('Mobi Doctor | Consultation Transaction Details');
					PDF::SetMargins(10, 30, 10, 10);
					PDF::SetFontSubsetting(false);
					PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
					PDF::AddPage();
					PDF::writeHTML(view($this->module_view_folder.'.consultation_invoice',$this->arr_view_data)->render());
					PDF::Output($this->patient_transaction_invoice_base_path.'/'.$file_name,'F');  
				endif;	
			endif;

		/*--------------------------------End gaurav work-----------------------------------------------------*/	

			$arr_notification['from_user_id']     = $this->user_id;
			$arr_notification['message']          = decrypt_value($this->user_first_name).' '.decrypt_value($this->user_last_name).' has book a consultation successfully.';
			$arr_notification['notification_url'] = '/admin/consultation/transaction';
            $this->AdminNotificationService->create_admin_notification($arr_notification);

            $arr_notification['to_user_id']       = $this->user_id;
			$arr_notification['from_user_id']     = 1;
			$arr_notification['message']          = 'You have successfully paid for consultation.';
			$arr_notification['notification_url'] = '/patient/transactions/consultation';
			$this->UserNotificationService->create_user_notification($arr_notification);

			$return_arr['status']  = $result['status'];
			$return_arr['message'] = $result['message'];

		endif;

		return response()->json($return_arr);
	} // end sp_payment_process


	public function reason()
	{
		$this->check_session_id();

		$obj_consultation = $this->ConsultationModel->select('id','consultation_id','user_id','illness','description','image')
													->where('consultation_id', base64_decode( Session::get('consultation_id') ))
													->where('user_id', $this->user_id)
													->first();
		if( $obj_consultation ):
			$arr_consultation = $obj_consultation->toArray();
		endif;

		$obj_category = $this->CMSCategoryModel->select('id','name','slug','status','image')->where('status',1)->get();
		if( $obj_category ):
			$arr_category = $obj_category->toArray();
		endif;


		$this->arr_view_data['illness_image_base_path']   = $this->illness_img_base_path;
		$this->arr_view_data['illness_image_public_path'] = $this->illness_img_public_path;
		
		$this->arr_view_data['illness_category_image_public_path'] = $this->illness_category_public_path;
		$this->arr_view_data['illness_category_image_base_path'] = $this->illness_category_base_path;
		$this->arr_view_data['illness_category_default_img_path'] = $this->illness_category_default_img_path;

		$this->arr_view_data['arr_category']              = $arr_category;
		$this->arr_view_data['arr_consultation']          = $arr_consultation;
		$this->arr_view_data['session_consultation_id']   = Session::get('consultation_id');

		$this->arr_view_data['page_title']                = 'Describe your Illness';
		$this->arr_view_data['module_url_path']           = $this->module_url_path;

		$this->arr_view_data['breadcrum_level_1']         = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_2']         = $this->breadcrum_level_2;
		$this->arr_view_data['breadcrum_level_3']         = 'Describe your Illness';

		$this->arr_view_data['breadcrum_level_1_url']     = $this->breadcrum_level_1_url;

		return view($this->module_view_folder.'.reason', $this->arr_view_data);
	} // end reason


	public function reason_process(Request $request)
	{
		$arr_rules = $return_arr = [];

		$this->check_session_id();

		$arr_rules['illness']     = 'required';
		$arr_rules['description'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        
        if($validator->fails()):
			$return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all required field.';
            return response()->json($return_arr);
        endif;

        // upload illness image
        if($request->hasFile('file_illness_image'))
        {
            $illness_image = $request->file('file_illness_image');

            if(isset($illness_image) && sizeof($illness_image)>0)
            {
                $extention = strtolower($illness_image->getClientOriginalExtension());
                $valid_ext = ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                if(!in_array($extention, $valid_ext))
                {
                    $return_arr['status']  = 'error';
            		$return_arr['message'] = 'Invalid file. Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp, txt, pdf, csv, doc, docx, xlsx';
                    return response()->json($return_arr);
                }
                else if($illness_image->getClientSize() > 5000000)
                {
                    $return_arr['status']  = 'error';
            		$return_arr['message'] = 'File is more than limit size. Please upload image/document with small size. Max size allowed is 5mb';
                    return response()->json($return_arr);
                }
                else
                {
                    $illness_image_name   = $request->file('file_illness_image');
                    $illness_image_ext    = strtolower($request->file('file_illness_image')->getClientOriginalExtension());
                    $illness_image_name   = uniqid().'.'.$illness_image_ext;
                    $illness_image_result = $request->file('file_illness_image')->move($this->illness_img_base_path, $illness_image_name);
                    if($illness_image_result)
                    {
                        @unlink($this->illness_img_base_path.'/'.$request->input('old_illness_image'));
                    }
                }

                $data['image'] = isset($illness_image_name) && !empty($illness_image_name) ? $illness_image_name : '';
            }
            else
            {
                $return_arr['status']  = 'error';
            	$return_arr['message'] = 'Invalid file. Please upload valid image/document.';
                return response()->json($return_arr);
            }
        }

        $data['illness']      = $request->input('illness');
        $data['description']  = $request->input('description');
        $data['is_completed'] = 1;

		$consultation_record = $this->ConsultationModel->where('consultation_id', base64_decode(Session::get('consultation_id')));
		if( $consultation_record->count() > 0 ):
			$output = $consultation_record->update($data);
		else:
	        $output = $this->ConsultationModel->insert($data);
		endif;

        if( $output ):
        	$obj_consult = $this->ConsultationModel->where('user_id', $this->user_id)
        										   ->where('consultation_id', base64_decode(Session::get('consultation_id')))
        										   ->first();
        	if( $obj_consult ):
        	endif;

        	$arr_notification['to_user_id']       = $this->user_id;
			$arr_notification['from_user_id']     = 1;
			$arr_notification['message']          = 'You have successfully booked a consultation.';
			$arr_notification['notification_url'] = '/patient/my_consultation/upcoming';
			$this->UserNotificationService->create_user_notification($arr_notification);

        	$return_arr['status']     = 'success';
        	$return_arr['message']    = 'Your illness data is added successfully';
        	$return_arr['redirectTo'] = url('/patient/consultation/'.Session::get('consultation_id').'/requested');
        else:
        	$return_arr['status']  = 'error';
            $return_arr['message'] = 'Something went wrong! Please try again.';
        endif;

        return response()->json($return_arr);
	} // end reason_process


	public function requested()
	{
		$arr_family_member = $arr_consultation = $arr_prefix = $arr_consultationsetting = [];

		$this->check_session_id();

		$obj_consultation = $this->ConsultationModel->select('id','consultation_id','user_id','who_is_patient','patient_id','date','time','doctor_id')
													->where('consultation_id', base64_decode( Session::get('consultation_id') ))
													->where('user_id', $this->user_id)
													->with('doctor_details')
													->first();
		if( $obj_consultation ):
			$arr_consultation = $obj_consultation->toArray();

			$obj_prefix = $this->PrefixModel->where('id', $arr_consultation['doctor_details']['prefix'])->first();
			if( $obj_prefix ):
				$arr_prefix = $obj_prefix->toArray();
			endif;

			if( $arr_consultation['who_is_patient'] == 'family' ):
				$obj_family_member = $this->FamilyMemberModel->select('id','first_name','last_name')
															 ->where('id', $arr_consultation['patient_id'])
															 ->where('user_id', $this->user_id)
															 ->first();
				if( $obj_family_member ):
					$arr_family_member = $obj_family_member->toArray();
				endif;
			endif;
		endif;

		$obj_consultationsetting = $this->ConsultationSettingModel->where('id', 1)->select('reschedule')->first();
		if($obj_consultationsetting):
			$arr_consultationsetting = $obj_consultationsetting->toArray();
		endif;

		$this->arr_view_data['arr_prefix']              = $arr_prefix;
		$this->arr_view_data['arr_family_member']       = $arr_family_member;
		$this->arr_view_data['arr_consultation']        = $arr_consultation;
		$this->arr_view_data['arr_consultationsetting'] = $arr_consultationsetting;
		$this->arr_view_data['session_consultation_id'] = Session::get('consultation_id');

		$this->arr_view_data['page_title']              = 'Consultation Requested';
		$this->arr_view_data['module_url_path']         = $this->module_url_path;

		$this->arr_view_data['breadcrum_level_1']       = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_2']       = $this->breadcrum_level_2;
		$this->arr_view_data['breadcrum_level_3']       = 'Consultation Requested';

		$this->arr_view_data['breadcrum_level_1_url']   = $this->breadcrum_level_1_url;

		return view($this->module_view_folder.'.requested', $this->arr_view_data);
	} // end requested

	/*-----------------------------------------Consultation Booking function ends-----------------------------------------*/


	public function reschedule()
	{
		return redirect( url('/').'/patient/consultation/'.Session::get('consultation_id').'/day' );
	} // end reschedule
}
