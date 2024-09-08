<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\ConsultationSettingModel;
use App\Models\ConsultationModel;
use App\Models\FamilyMemberModel;

use Validator;
use Sentinel;
use Session;
use Flash;

class ConsultationController extends Controller
{
    public function __construct()
    {
        $this->arr_view_data            = [];
        $this->module_url_path          = url(config('app.project.admin_panel_slug')."/consultation");
        $this->module_title             = "Consultation";
        $this->module_view_folder       = "admin.consultation";
        $this->admin_panel_slug         = config('app.project.admin_panel_slug');

        $this->ConsultationSettingModel = new ConsultationSettingModel();
        $this->ConsultationModel        = new ConsultationModel();
        $this->FamilyMemberModel        = new FamilyMemberModel();

        $this->illness_img_base_path    = base_path().config('app.img_path.illness_img');
        $this->illness_img_public_path  = url('/').config('app.img_path.illness_img');
    }


    public function setting()
    {
        $arr_setting = [];

        $this->arr_view_data['page_title'] = str_singular($this->module_title).' Setting';

    	$user = Sentinel::check();
    	if($user)
    	{
    		if($user->inRole('admin'))
    		{
                $obj_setting = $this->ConsultationSettingModel->select('time_interval','reschedule')->first();
                if($obj_setting)
                {
                    $arr_setting = $obj_setting->toArray();
                }

                $this->arr_view_data['arr_setting']     = $arr_setting;
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = str_singular($this->module_title);
                return view($this->module_view_folder.'.setting',$this->arr_view_data);
    		}
            else
            {
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/login');
            }
    	}
        else
        {
        	Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        }
    } // end setting


    public function setting_process(request $request)
    {   
        $arr_rules = $form_data  = array();

        $form_data = $request->all();

        $arr_rules['time_interval'] = "required";
        $arr_rules['reschedule']    = "required";

        $validator = Validator::make($form_data, $arr_rules);
        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        endif;


        $arr_data['time_interval'] = $form_data['time_interval'];
        $arr_data['reschedule']    = $form_data['reschedule'];

        // Check if data is already inserted or not
        $is_exist = $this->ConsultationSettingModel->where('id',1);
        if($is_exist->count() > 0):
            $status = $is_exist->update($arr_data);
        else:
            $status = $this->ConsultationSettingModel->create($arr_data);
        endif;

        // Check Status and show msg accroding to it
        if($status):
            Flash::success(str_singular($this->module_title).' Updated Successfully.'); 
        else:
            Flash::error('Problem Occurred, While Updating '.str_singular($this->module_title));  
        endif;

        return redirect()->back();
    } // end setting_process


    public function upcoming()
    {
        $arr_consultation = [];

        $this->arr_view_data['page_title'] = 'Upcoming '.str_singular($this->module_title);

        $user = Sentinel::check();
        if($user):

            if($user->inRole('admin')):

                $obj_consultation = $this->ConsultationModel->select('id','consultation_id','user_id','who_is_patient','patient_id','doctor_id','date','time','payment','is_completed','status')
                                                            ->where('is_completed', 1)
                                                            ->where('status', 'upcoming')
                                                            ->orderBy('id','desc')
                                                            ->with(['user_details' => function($query){
                                                                $query->select('id','first_name','last_name');
                                                            }])
                                                            ->with(['doctor_details' => function($query){
                                                                $query->select('id','prefix','first_name','last_name')->with('doctor_prefix');
                                                            }])
                                                            ->get();
                if( $obj_consultation ):
                    $arr_consultation = $obj_consultation->toArray();
                endif;

                $this->arr_view_data['arr_consultation']          = $arr_consultation;
                $this->arr_view_data['module_url_path']           = $this->module_url_path;
                $this->arr_view_data['module_title']              = str_singular($this->module_title);

                return view($this->module_view_folder.'.upcoming',$this->arr_view_data);

            else:
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/login');
            endif;
        else:
            Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        endif;
    } // end upcoming


    public function upcoming_details($enc_id = false)
    {
        $arr_consultation = [];

        $this->arr_view_data['previous_page'] = 'Upcoming';
        $this->arr_view_data['page_title'] = 'Details';

        $user = Sentinel::check();
        if($user):

            if($user->inRole('admin')):

                if( $enc_id ):
            
                    $arr_consultation = [];

                    $obj_consultation = $this->ConsultationModel->where('id', base64_decode($enc_id))
                                                                ->where('is_completed', 1)
                                                                ->where('status', 'upcoming')
                                                                ->orderBy('id','desc')
                                                                ->with(['user_details' => function($query){
                                                                    $query->select('id','first_name','last_name','email','phone_code','mobile_no','gender','address','contact_no','date_of_birth','dump_id','dump_session');
                                                                }])
                                                                ->with(['doctor_details' => function($query){
                                                                    $query->select('id','prefix','first_name','last_name','email','phone_code','mobile_no','gender','address','contact_no','date_of_birth')->with('doctor_prefix');
                                                                }])
                                                                ->with(['category_name' => function($query){
                                                                    $query->select('id','name');
                                                                }])
                                                                ->first();
                    if( $obj_consultation ):
                        $arr_consultation = $obj_consultation->toArray();
                    else:
                        return redirect( $this->module_url_path.'/upcoming' );
                    endif;

                    $this->arr_view_data['illness_image_base_path']   = $this->illness_img_base_path;
                    $this->arr_view_data['illness_image_public_path'] = $this->illness_img_public_path;

                    $this->arr_view_data['arr_consultation']          = $arr_consultation;
                    $this->arr_view_data['module_url_path']           = $this->module_url_path;
                    $this->arr_view_data['module_title']              = str_singular($this->module_title);

                    return view($this->module_view_folder.'.upcoming_details',$this->arr_view_data);

                else:
                    return redirect( $this->module_url_path.'/upcoming' );

                endif;

            else:
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/login');

            endif;
        else:
            Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        endif;
    } // end upcoming_details


    public function completed()
    {
        $arr_consultation = [];

        $this->arr_view_data['page_title'] = 'Completed '.str_singular($this->module_title);

        $user = Sentinel::check();
        if($user):

            if($user->inRole('admin')):

                $obj_consultation = $this->ConsultationModel->select('id','consultation_id','user_id','who_is_patient','patient_id','doctor_id','date','time','payment','is_completed','status')
                                                            ->where('is_completed', 1)
                                                            ->where('status', 'completed')
                                                            ->orderBy('id','desc')
                                                            ->with(['user_details' => function($query){
                                                                $query->select('id','first_name','last_name');
                                                            }])
                                                            ->with(['doctor_details' => function($query){
                                                                $query->select('id','prefix','first_name','last_name')->with('doctor_prefix');
                                                            }])
                                                            ->get();
                if( $obj_consultation ):
                    $arr_consultation = $obj_consultation->toArray();
                endif;
                //dd( $arr_consultation );

                $this->arr_view_data['arr_consultation'] = $arr_consultation;
                $this->arr_view_data['module_url_path']  = $this->module_url_path;
                $this->arr_view_data['module_title']     = str_singular($this->module_title);

                return view($this->module_view_folder.'.completed',$this->arr_view_data);

            else:
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/login');

            endif;
        else:
            Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        endif;
    } // end completed


    public function completed_details($enc_id = false)
    {
        $arr_consultation = [];

        $this->arr_view_data['previous_page'] = 'Completed';
        $this->arr_view_data['page_title'] = 'Details';

        $user = Sentinel::check();
        if($user):

            if($user->inRole('admin')):

                if( $enc_id ):
            
                    $arr_consultation = [];

                    $obj_consultation = $this->ConsultationModel->where('id', base64_decode($enc_id))
                                                                ->where('is_completed', 1)
                                                                ->where('status', 'completed')
                                                                ->orderBy('id','desc')
                                                                ->with(['user_details' => function($query){
                                                                    $query->select('id','first_name','last_name','email','phone_code','mobile_no','gender','address','contact_no','date_of_birth','dump_id','dump_session');
                                                                }])
                                                                ->with(['doctor_details' => function($query){
                                                                    $query->select('id','prefix','first_name','last_name','email','phone_code','mobile_no','gender','address','contact_no','date_of_birth')->with('doctor_prefix');
                                                                }])
                                                                ->with(['category_name' => function($query){
                                                                    $query->select('id','name');
                                                                }])
                                                                ->first();
                    if( $obj_consultation ):
                        $arr_consultation = $obj_consultation->toArray();
                    else:
                        return redirect( $this->module_url_path.'/completed' );
                    endif;

                    $this->arr_view_data['illness_image_base_path']   = $this->illness_img_base_path;
                    $this->arr_view_data['illness_image_public_path'] = $this->illness_img_public_path;

                    $this->arr_view_data['arr_consultation']          = $arr_consultation;
                    $this->arr_view_data['module_url_path']           = $this->module_url_path;
                    $this->arr_view_data['module_title']              = str_singular($this->module_title);

                    return view($this->module_view_folder.'.completed_details',$this->arr_view_data);

                else:
                    return redirect( $this->module_url_path.'/completed' );

                endif;

            else:
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/login');

            endif;
        else:
            Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        endif;
    } // end completed_details
}   
