<?php

namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\FamilyMemberModel;
use App\Models\TimezoneModel;
use App\Models\UserModel;

use App\Common\Services\UserNotificationService;
use App\Common\Services\StripeService;

use Sentinel;
use Validator;
use Session;

class MyAccountController extends Controller
{
    public function __construct(
                                    UserNotificationService $user_notification_service,
                                    StripeService           $stripe_service
                                )
    {
        $this->FamilyMemberModel         = new FamilyMemberModel();
        $this->UserModel                 = new UserModel();
        $this->TimezoneModel             = new TimezoneModel();

        $this->UserNotificationService   = $user_notification_service;
        $this->StripeService             = $stripe_service;

        $this->arr_view_data             = [];
        $this->module_title              = "My Account";
        $this->parent_url_path           = url('/').'/patient';
        $this->module_url_path           = url('/').'/patient/my_account';
        $this->module_view_folder        = "front.patient.my_account";

        $this->breadcrum_level_1         = 'Dashboard';
        $this->breadcrum_level_2         = $this->module_title;

        $this->breadcrum_level_1_url     = $this->parent_url_path.'/dashboard';
        $this->breadcrum_level_2_url     = $this->module_url_path;

        $this->patient_image_public_path = url('/').config('app.img_path.patient_profile_images');
        $this->patient_image_base_path   = base_path().config('app.img_path.patient_profile_images');
        $this->default_img_path          = url('/').config('app.img_path.default_img_path');

        $user                            = Sentinel::check();
        $this->user_id                   = '';

        if($user)
        {
           $this->user_id = $user->id;
        }
    }

    public function about_me()
    {
        $arr_patient = [];
    	$obj_patient = $this->UserModel->where('id','=',$this->user_id)->first();
    	if($obj_patient)
    	{
    		$arr_patient = $obj_patient->toArray();
    	}

        $obj_timezone = $this->TimezoneModel->get();
        if($obj_timezone)
        {
            $arr_timezone = $obj_timezone->toArray();
        }

        $this->arr_view_data['arr_timezone']              = $arr_timezone;
        $this->arr_view_data['arr_patient']               = $arr_patient;
        $this->arr_view_data['breadcrum_level_1']         = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']         = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']         = 'About Me';
        $this->arr_view_data['breadcrum_level_1_url']     = $this->breadcrum_level_1_url;
        $this->arr_view_data['breadcrum_level_3_url']     = $this->breadcrum_level_2_url.'/about_me';
        $this->arr_view_data['page_title']                = 'About Me';
        $this->arr_view_data['module_url_path']           = $this->module_url_path;
        $this->arr_view_data['profile_image_base_path']   = $this->patient_image_base_path;
        $this->arr_view_data['profile_image_public_path'] = $this->patient_image_public_path;
        $this->arr_view_data['default_img_path']          = $this->default_img_path;

    
    	return view($this->module_view_folder.'.about_me', $this->arr_view_data);
    }

    public function update_about_me(Request $request)
    {
        $fileName = '';
        $arr_rules  = $return_arr = [];

        $arr_rules['first_name'] = 'required';
        $arr_rules['last_name']  = 'required';
        $arr_rules['address']    = 'required';
        $arr_rules['country']    = 'required';
        $arr_rules['city']       = 'required';
        $arr_rules['timezone']   = 'required';
        $arr_rules['birth_date']   = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all the required field.';

            return response()->json($return_arr);
        }

        $arr_data['first_name']  = encrypt_value(trim($request->input('first_name')));
        $arr_data['last_name']   = encrypt_value(trim($request->input('last_name')));
        $arr_data['address']     = encrypt_value(trim($request->input('address', null)));
        $arr_data['city']        = encrypt_value(trim($request->input('city', null)));
        $arr_data['country']     = encrypt_value(trim($request->input('country', null)));
        $arr_data['state']       = encrypt_value(trim($request->input('state', null)));
        $arr_data['postal_code'] = encrypt_value(trim($request->input('postal_code')));
        $arr_data['fax_no']      = encrypt_value(trim($request->input('fax_no', null)));
        $arr_data['timezone']    = trim($request->input('timezone', null));
        $arr_data['latitude']    = trim($request->input('lat', null));
        $arr_data['longitude']   = trim($request->input('lng', null));
        $arr_data['date_of_birth'] = trim(date('Y-m-d',strtotime($request->input('birth_date'))));
         $arr_data['contact_no']    = trim($request->input('contact_no', null));

        $obj_patient = $this->UserModel->where('id','=',$this->user_id)->first();

        
        if($request->hasFile('profile_image'))
        {
            $fileName = $request->input('profile_image');
            $profile_image = $request->file('profile_image');

            $file_extension = strtolower($profile_image->getClientOriginalExtension());
            $fileName = sha1(uniqid().$profile_image.uniqid()).'.'.$file_extension;

            if($profile_image->isValid() && in_array($file_extension,['png','jpg','jpeg']))
            { 
                $fileExtension             = strtolower($profile_image->getClientOriginalExtension());
                $enc_profile_image         = sha1(uniqid().$profile_image.uniqid()).'.'.$fileExtension;     
                $upload                    = $profile_image->move($this->patient_image_base_path,$enc_profile_image);        

                $arr_data['profile_image'] = $enc_profile_image;
                if($upload)
                {
                    if(isset($obj_patient->profile_image) && $obj_patient->profile_image!=null)
                    {
                        $profile_image         = $this->patient_image_base_path.'/'.$obj_patient->profile_image;
                        if(file_exists($profile_image))
                        {
                            unlink($profile_image);
                        }
                    }
                }
            }
            else
            {
                Session::flash('error',$fileName.' Invalid file extension.');
                return response()->json($return_arr);
            }    
        } 

        $status = $this->UserModel->where('id','=',$this->user_id)->update($arr_data);
        if($status)
        {
            Session::flash('success','Details updated succssfully.');
            return response()->json($return_arr);
        }
        else
        {
            Session::flash('error','Something went wrong while update details, Please try again.');
            return response()->json($return_arr);
        }
    }

    public function change_password()
    {
    	$this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_2']     = $this->breadcrum_level_2;
		$this->arr_view_data['breadcrum_level_3']     = 'Change Password';

		$this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
		$this->arr_view_data['breadcrum_level_3_url'] = $this->breadcrum_level_2_url.'/change_password';

    	$this->arr_view_data['page_title'] = 'Change Password';
        $this->arr_view_data['module_url_path']           = $this->module_url_path;
    	return view($this->module_view_folder.'.change_password', $this->arr_view_data);
    }

    public function update_change_password(Request $request)
    {
        $arr_rules = $return_arr = [];

        $arr_rules['old_password']     = 'required';
        $arr_rules['new_password']     = 'required';
        $arr_rules['confirm_password'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please check your browser javascript setting to allow our website form access. Currently it is denied.';
            return response()->json($return_arr);
        }

        $old_password     = trim($request->input('old_password'));
        $new_password     = trim($request->input('new_password'));
        $confirm_password = trim($request->input('confirm_password'));

        $user = Sentinel::check();

        $credentials = [];
        $credentials['password'] = $old_password;

        if (Sentinel::validateCredentials($user,$credentials)) 
        { 
            $new_credentials = [];
            $new_credentials['password'] = $new_password;

            if(Sentinel::update($user,$new_credentials))
            {
                Session::flash('success','Password Change Successfully.');
                 Sentinel::logout();
                return response()->json($return_arr);
            }
            else
            {
                Session::flash('error','Problem Occurred, While Changing Password.');
                return response()->json($return_arr);

            }
        } 
        else
        {
            Session::flash('error','Invalid Old Password.');
            return response()->json($return_arr);
        }       
    }

    public function family_member()
    {
        $arr_member = [];
        $obj_member = $this->FamilyMemberModel->where('user_id','=',$this->user_id)->orderBy('id','desc')->get();
        if($obj_member)
        {
            $arr_member = $obj_member->toArray();
        }

        $this->arr_view_data['arr_member']                = $arr_member;
        $this->arr_view_data['breadcrum_level_1']         = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']         = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']         = 'Add a Member';
        $this->arr_view_data['breadcrum_level_1_url']     = $this->breadcrum_level_1_url;
        $this->arr_view_data['breadcrum_level_3_url']     = $this->breadcrum_level_2_url.'/family_member';
        $this->arr_view_data['page_title']                = 'Add a Member';
        $this->arr_view_data['module_url_path']           = $this->module_url_path;
    
        return view($this->module_view_folder.'.family_member.add_member', $this->arr_view_data);
    }

    public function add_family_member(Request $request)
    {
        $arr_rules = $return_arr = [];

        $arr_rules['first_name'] = 'required';
        $arr_rules['last_name']  = 'required';
        $arr_rules['gender']     = 'required';
        $arr_rules['relation']   = 'required';
        $arr_rules['birth_date'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please check your browser javascript setting to allow our website form access. Currently it is denied.';

            return response()->json($return_arr);
        }

        $arr_data['user_id']    = $this->user_id;
        $arr_data['first_name'] = encrypt_value(trim($request->input('first_name')));
        $arr_data['last_name']  = encrypt_value(trim($request->input('last_name')));
        $arr_data['gender']     = encrypt_value(trim($request->input('gender')));
        $arr_data['relation']   = encrypt_value(trim($request->input('relation')));
        $arr_data['birth_date'] = date('Y-m-d',strtotime($request->input('birth_date')));
        $arr_data['email']      = trim($request->input('email',null));
        $arr_data['mobile_no']  = trim($request->input('mobile_no',null));
        $arr_data['phone_code'] = trim($request->input('phone_code',null));

        $status = $this->FamilyMemberModel->create($arr_data);
        if($status)
        {
            Session::flash('success','Member added succssfully.');
            return response()->json($return_arr);
        }
        else
        {
            Session::flash('error','Problem occured while adding member,Please try again.');
            return response()->json($return_arr);
        }
    }

    public function edit_family_member($enc_id)
    {
        if($enc_id!='')
        {
            $id = base64_decode($enc_id);
            $arr_member_details = [];
            $obj_member_details = $this->FamilyMemberModel->where('id','=',$id)->first();
            if($obj_member_details)
            {
                $arr_member_details = $obj_member_details->toArray();
            }

            $this->arr_view_data['arr_member_details']        = $arr_member_details;
            $this->arr_view_data['breadcrum_level_1']         = $this->breadcrum_level_1;
            $this->arr_view_data['breadcrum_level_2']         = $this->breadcrum_level_2;
            $this->arr_view_data['breadcrum_level_3']         = 'Edit a Member';
            $this->arr_view_data['breadcrum_level_1_url']     = $this->breadcrum_level_1_url;
            $this->arr_view_data['breadcrum_level_3_url']     = $this->breadcrum_level_2_url.'/family_member';
            $this->arr_view_data['page_title']                = 'Edit a Member';
            $this->arr_view_data['module_url_path']           = $this->module_url_path;
            return view($this->module_view_folder.'.family_member.edit_member', $this->arr_view_data);
        }
        else
        {
            Session::flash('error','Something went wrong,Please try again.');
            return redirect()->back();
        }        
    }

    public function update_family_member(Request $request,$enc_id)
    {
        $return_arr = [];
        if($enc_id!='')
        {
            $id = base64_decode($enc_id);
            $arr_rules = [];
            $arr_rules['first_name'] = 'required';
            $arr_rules['last_name']  = 'required';
            $arr_rules['gender']     = 'required';
            $arr_rules['relation']   = 'required';
            $arr_rules['birth_date'] = 'required';

            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                $return_arr['status']  = 'error';
                $return_arr['message'] = 'Please check your browser javascript setting to allow our website form access. Currently it is denied.';

                return response()->json($return_arr);
            }

            $arr_data['user_id']    = $this->user_id;
            $arr_data['first_name'] = encrypt_value(trim($request->input('first_name')));
            $arr_data['last_name']  = encrypt_value(trim($request->input('last_name')));
            $arr_data['gender']     = encrypt_value(trim($request->input('gender')));
            $arr_data['relation']   = encrypt_value(trim($request->input('relation')));
            $arr_data['birth_date'] = date('Y-m-d',strtotime($request->input('birth_date')));
            $arr_data['email']      = trim($request->input('email',null));
            $arr_data['mobile_no']  = trim($request->input('mobile_no',null));
            $arr_data['phone_code'] = trim($request->input('phone_code',null));

            $status = $this->FamilyMemberModel->where('id','=',$id)->update($arr_data);
            if($status)
            {
                Session::flash('success','Member details updated succssfully.');
                return response()->json($return_arr);
            }
            else
            {
                Session::flash('error','Problem occured while updating member details,Please try again.');
                return response()->json($return_arr);
            }

        }
        else
        {
            Session::flash('error','Something went wrong,Please try again.');
            return response()->json($return_arr);
        }
    }

    public function remove_family_member($enc_id=FALSE)
    {
        if($enc_id)
        {
            $id = base64_decode($enc_id);
            $status = $this->FamilyMemberModel->where('id','=',$id)->delete();
            if($status)
            {
                Session::flash('success','Member Removed succssfully.');
                return redirect()->back();
            }
            else
            {
                Session::flash('error','Problem occured while removing member.');
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('error','Something went wrong,Please try again.');
            return redirect()->back();
        }
    }

    public function card()
    {
        // Get User Card Details list
        $this->arr_view_data['card_details']          = $this->StripeService->get_card_details($this->user_id);

        $this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']     = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']     = 'Card Details';
        
        $this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
        $this->arr_view_data['breadcrum_level_3_url'] = $this->breadcrum_level_2_url.'/card';
        
        $this->arr_view_data['page_title']            = 'Card Details';
        $this->arr_view_data['module_url_path']       = $this->module_url_path;
    
        return view($this->module_view_folder.'.card.list', $this->arr_view_data);
    }

    public function add_card(Request $request)
    {
        $card_data = $arr_rules = [];

        $arr_rules["card_name"]    = 'required';
        $arr_rules["card_no"]      = 'required';
        $arr_rules["expiry_month"] = 'required';
        $arr_rules["expiry_year"]  = 'required';
        $arr_rules["cvv"]          = 'required';
        
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails()):
            Session::flash('error', 'Something went wrong! Please enter or select all the required fields and try again.');
            return response()->json();

        endif;

        $card_data['card_name']    = $request->input("card_name", null);
        $card_data['card_no']      = $request->input("card_no", null);
        $card_data['cvv']          = $request->input("cvv", null);
        $card_data['expiry_month'] = $request->input("expiry_month", null);
        $card_data['expiry_year']  = $request->input("expiry_year", null);

        $output = $this->StripeService->store_card( $this->user_id, $card_data );

        if( $output['status'] == 'error' ):
            Session::flash('error', $output['message']);

            $arr_notification['to_user_id']       = $this->user_id;
            $arr_notification['from_user_id']     = 1;
            $arr_notification['message']          = 'You have successfully added new card to your account. This card details is stored in stripe account.';
            $arr_notification['notification_url'] = '/patient/my_account/card';
            $this->UserNotificationService->create_user_notification($arr_notification);

        else:
            Session::flash('success', 'Card details successfully store.');

        endif;

        return response()->json();
    }

    public function delete_card(Request $request)
    {
        $card_data = $arr_rules = [];

        $arr_rules["customer_id"] = 'required';
        $arr_rules["card_id"]     = 'required';
        $arr_rules["id"]          = 'required';
        
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails()):
            Session::flash('error', 'Something went wrong! Please try again.');
            return response()->json();

        endif;

        $card_data['customer_id'] = $request->input("customer_id", null);
        $card_data['card_id']     = $request->input("card_id", null);
        $card_data['id']          = $request->input("id", null);

        $output = $this->StripeService->delete_card( $this->user_id, $card_data );

        if( $output['status'] == 'error' ):
            Session::flash('error', $output['message']);

            $arr_notification['to_user_id']       = $this->user_id;
            $arr_notification['from_user_id']     = 1;
            $arr_notification['message']          = 'You have successfully deleted a card to your account.';
            $arr_notification['notification_url'] = '/patient/my_account/card';
            $this->UserNotificationService->create_user_notification($arr_notification);

        else:
            Session::flash('success', 'Card details successfully deleted.');

        endif;

        return response()->json();
    }
}
