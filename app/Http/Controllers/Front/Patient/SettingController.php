<?php

namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ContactUsModel;
use App\Common\Services\AdminNotificationService;

use App\Models\InvitationModel;
use App\Common\Services\InvitationService;

use Sentinel;
use Validator;
use Session;

class SettingController extends Controller
{
    public function __construct(AdminNotificationService $admin_notification_service,
                                InvitationService        $invitation_service)
    {
        $this->ContactUsModel            = new ContactUsModel();
        $this->InvitationModel           = new InvitationModel();
        $this->AdminNotificationService  = $admin_notification_service;
        $this->InvitationService         = $invitation_service;

    	$this->arr_view_data             = [];
        $this->module_title              = "Settings";
        $this->parent_url_path           = url('/').'/patient';
        $this->module_url_path           = url('/').'/patient/settings';
        $this->module_view_folder        = "front.patient.settings";

        $this->breadcrum_level_1         = 'Dashboard';
        $this->breadcrum_level_2         = $this->module_title;

        $this->breadcrum_level_1_url     = $this->parent_url_path.'/dashboard';
        $this->breadcrum_level_2_url     = $this->module_url_path;

		$user                            = Sentinel::check();
		$this->user_id                   = '';

        if($user)
        {
           $this->user_id = $user->id;
        }
    }

    public function contact_us()
    {
        $this->arr_view_data['breadcrum_level_1']         = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']         = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']         = 'Contact Us';
        $this->arr_view_data['breadcrum_level_1_url']     = $this->breadcrum_level_1_url;
        $this->arr_view_data['breadcrum_level_3_url']     = $this->breadcrum_level_2_url.'/contact_us';
        $this->arr_view_data['page_title']                = 'Contact Us';
        $this->arr_view_data['module_url_path']           = $this->module_url_path;

    	return view($this->module_view_folder.'.contact_us', $this->arr_view_data);
    }

    public function store_contact_us(Request $request)
    {
        $arr_rules = $return_arr = [];

        $arr_rules['patient_name'] = 'required';
        $arr_rules['email']        = 'required|email';
        $arr_rules['phone_code']   = 'required';
        $arr_rules['mobile_no']    = 'required';
        $arr_rules['message']      = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please check your browser javascript setting to allow our website form access. Currently it is denied.';

            return response()->json($return_arr);
        }

        $arr_data['user_id']    = $this->user_id;
        $arr_data['user_type']  = encrypt_value('patient');
        $arr_data['name']       = encrypt_value(trim($request->input('patient_name')));
        $arr_data['email']      = trim($request->input('email'));
        $arr_data['phone_code'] = trim($request->input('phone_code'));
        $arr_data['mobile_no']  = trim($request->input('mobile_no'));
        $arr_data['message']    = encrypt_value(trim($request->input('message')));

        $status = $this->ContactUsModel->create($arr_data);
        if($status)
        {
            $arr_notification['from_user_id']     = $this->user_id;
            $arr_notification['message']          = 'You have new contact enquiry from patient';
            $arr_notification['notification_url'] = '/admin/contact_us';

            $this->AdminNotificationService->create_admin_notification($arr_notification);

            Session::flash('success','Contact details send succssfully.');
            return response()->json($return_arr);
        }
        else
        {
            Session::flash('error','Problem occur while sending contact details.');
            return response()->json($return_arr);
        }
    }

    public function invitation()
    {
        $arr_invitation =  [];
        $arr_paginate     = null;

        $obj_invitation = $this->InvitationModel->with('is_user_register')
                                                ->where('user_id',$this->user_id)
                                                ->orderBy('id','desc')
                                                ->paginate(5);
        if($obj_invitation)
        {
            $arr_paginate = clone $obj_invitation;
            $arr_invitation = $obj_invitation->toArray();
        }


        $this->arr_view_data['arr_invitation']        = $arr_invitation;
        $this->arr_view_data['arr_pagination']        = isset($arr_paginate)?$arr_paginate:null;
        $this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']     = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']     = 'Invitation';
        $this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
        $this->arr_view_data['breadcrum_level_3_url'] = $this->breadcrum_level_2_url.'/refer_a_friend';
        $this->arr_view_data['page_title']            = 'Invitation';
        $this->arr_view_data['module_url_path']       = $this->module_url_path;

        return view($this->module_view_folder.'.invitation', $this->arr_view_data);
    }

    public function download_template()
    {
        \Excel::create('INVITATION-DETAILS',function($excel) 
        {
            $excel->sheet('1-Invitation_Upload', function($sheet)  
            {
                $sheet->setWidth(array(
                    'A'     =>  35,
                    'B'     =>  35
                ));
                $sheet->setHeight(array(
                    1     =>  25,
                    2     =>  25,                 
                ));
                $sheet->row(1, function($row) {
                   $row->setFont(array(
                    'family'     => 'Calibri',
                    'size'       => '16',
                    'bold'       => true
                ));
                });
                $sheet->row(1,array(
                                        'Name*', 
                                        'Email*'                                                  
                ));
              
            });
         $excel->setActiveSheetIndex(0);
        })->export('xls');     
    }

    public function import(Request $request)
    {
        $form_data        = $request->all();
        if($request->hasFile('input_file'))
        {
            $file      = $form_data['input_file'];
            $validator = Validator::make(
                                            [
                                                'file'      => $file,
                                              
                                            ],
                                            [
                                                'file'      => 'required',
                                              
                                            ]
                                        );
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }
            $fileExtension = strtolower($file->getClientOriginalExtension()); 

            if($fileExtension == 'xls')
            {
                $results  = $empty_error = $duplicate_error = $duplicate_promo = $date_error = '';
                $empty_error = $user_type_error = $city_error = $usage_error = '';

                $results  = \Excel::load($file, function($reader) {})->get();
                
                $skipped_record = $added_record = 0;

                $arr_result = $results->toArray();

                if(isset($arr_result) && sizeof($arr_result)>0)
                {
                    foreach ($arr_result as $key => $value) 
                    {
                        if(isset($value['name']) && $value['email'] && $value['name']!='' && $value['email']!='')
                        {
                            $arr_data['name']     = isset($value['name'])?$value['name']:'';
                            $arr_data['email']    = isset($value['email'])?$value['email']:'';
                            $arr_data['user_id']  = $this->user_id;

                            $this->InvitationService->store_invitation($arr_data);
                        }
                    }
                }
 
                Session::flash('success','Invitation send successfully');
                 return redirect()->back();
            }
            else
            {
                Session::flash('error','Invalid extension,Please upload valid file');
                 return redirect()->back();
            }
           
        }
        return redirect()->back();
    }
}
