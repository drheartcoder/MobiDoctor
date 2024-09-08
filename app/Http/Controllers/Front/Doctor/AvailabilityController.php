<?php

namespace App\Http\Controllers\Front\Doctor;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Services\UserNotificationService;

use App\Models\AvailabilityModel;
use App\Models\UserModel;

use Validator;
use Sentinel;
use Session;

class AvailabilityController extends Controller
{
    public function __construct(
                                    UserNotificationService  $user_notification_service
                                )
	{
		$this->user_id = $this->user_first_name = $this->user_last_name = $this->user_email = $this->user_phone_code = $this->user_mobile_no = '';

        $this->arr_view_data           = [];
        $this->module_title            = "My Availability";
        $this->parent_url_path         = url('/').'/doctor';
        $this->module_url_path         = url('/').'/doctor/availability';
        $this->module_view_folder      = "front.doctor.availability";

        $this->breadcrum_level_1       = 'Dashboard';
        $this->breadcrum_level_2       = $this->module_title;

        $this->breadcrum_level_1_url   = $this->parent_url_path.'/dashboard';
        $this->breadcrum_level_2_url   = $this->module_url_path;

        $this->UserNotificationService = $user_notification_service;

        $this->AvailabilityModel       = new AvailabilityModel();
        $this->UserModel               = new UserModel();

        $user                          = Sentinel::check();

        if($user):
			$this->user_id         = $user->id;
			$this->user_first_name = $user->first_name;
			$this->user_last_name  = $user->last_name;
			$this->user_email      = $user->email;
			$this->user_phone_code = $user->phone_code;
            $this->user_mobile_no  = $user->mobile_no;
			$this->is_pause        = $user->is_pause;
        endif;
	}

    public function index()
    {
        $this->arr_view_data['user_id']               = $this->user_id;
        $this->arr_view_data['is_pause']              = $this->is_pause;
        $this->arr_view_data['page_title']            = 'My Availability';
		$this->arr_view_data['module_url_path']       = $this->module_url_path;

		$this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_2']     = 'My Availability';

		$this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;

		return view($this->module_view_folder.'.index', $this->arr_view_data);
    } // end index


    public function available_dates()
    {
    	$available_dates = [];

    	$obj_available_dates = $this->AvailabilityModel->select('id','start_datetime','end_datetime')
    													->where('doctor_id', $this->user_id)
    													->get();
    	if( $obj_available_dates ):
    		$arr_available_dates = $obj_available_dates->toArray();

    		$arr_data = [];

    		foreach($arr_available_dates as $value):
                $temp_arr          = [];
                $temp_arr['id']    = $value['id'];
                $temp_arr['start'] = convert_datetime( date('D M d Y H:i:s', strtotime($value['start_datetime'])), 'user', 'datetime');
                $temp_arr['end']   = convert_datetime( date('D M d Y H:i:s', strtotime($value['end_datetime'])), 'user', 'datetime');

                array_push($arr_data, $temp_arr);
            endforeach;

            $available_dates = json_encode($arr_data);
    	endif;

		return $available_dates;

    } 


    public function add(Request $request)
    {
        $arr_rules['start_date'] = 'required';
        $arr_rules['start_time'] = 'required';
        $arr_rules['end_date']   = 'required';
        $arr_rules['end_time']   = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails()):
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Something went wrong. Please try again!';
            return response()->json($return_arr);
        endif;

        $insert = false;

        $start_date = $request->input('start_date');
        $start_time = $request->input('start_time');
        $end_date   = $request->input('end_date');
        $end_time   = $request->input('end_time');

        $for_selected_days = $request->input('for_selected_days', null);
        $week_days['mon']  = $request->input('mon', null);
        $week_days['tue']  = $request->input('tue', null);
        $week_days['wed']  = $request->input('wed', null);
        $week_days['thu']  = $request->input('thu', null);
        $week_days['fri']  = $request->input('fri', null);
        $week_days['sat']  = $request->input('sat', null);
        $week_days['sun']  = $request->input('sun', null);

        $data['doctor_id']      = $this->user_id;
        $data['start_datetime'] = convert_datetime( date('c', strtotime($start_date.' '.$start_time)), 'utc', 'datetime');
        $data['end_datetime']   = convert_datetime( date('c', strtotime($end_date.' '.$end_time)), 'utc', 'datetime');
        $data['start_date']     = date('Y-m-d', strtotime($data['start_datetime']));
        $data['end_date']       = date('Y-m-d', strtotime($data['end_datetime']));
        $data['start_time']     = date('H:i:s', strtotime($data['start_datetime']));
        $data['end_time']       = date('H:i:s', strtotime($data['end_datetime']));

        if( $data['start_date'] == $data['end_date'] ):
            $insert = $this->AvailabilityModel->insert($data);

        else:

            $difference = strtotime($data['end_date']) - strtotime($data['start_date']);
            $no_of_days = $difference / 86400; // 60 sec/min*60 min/hr*24 hr/day=86400 sec/day

            $data['end_date'] = $data['start_date'];

            $weekly_day_count = 0;
            for($i = 0; $i <= $no_of_days; $i++):

                $temp_date = strtotime("+".$i." day", strtotime($data['start_date']));

                $arr_data['doctor_id']      = $this->user_id;
                $arr_data['start_date']     = date('Y-m-d', $temp_date);
                $arr_data['end_date']       = date('Y-m-d', $temp_date);
                $arr_data['start_datetime'] = $arr_data['start_date'].' '.$data['start_time'];
                $arr_data['end_datetime']   = $arr_data['end_date'].' '.$data['end_time'];
                $arr_data['start_time']     = $data['start_time'];
                $arr_data['end_time']       = $data['end_time'];

                // For selected days
                if( $for_selected_days == 'true' ):

                    $get_day = date("l", strtotime($arr_data['start_date']));

                    if(in_array($get_day, $week_days)):
                        $weekly_day_count +=1;
                        $insert = $this->AvailabilityModel->insert($arr_data);
                    endif;

                // For all days
                else:
                    $insert = $this->AvailabilityModel->insert($arr_data);

                endif;

            endfor;

            // For selected days
            if( $for_selected_days == 'true' && $weekly_day_count == 0 ):
                $return_arr['status']  = 'error';
                $return_arr['message'] = 'No day found in between start and end date. Please check dates ';
                return response()->json($return_arr);
            endif;

        endif;

        if( $insert ):
        	$return_arr['status']  = 'success';
            $return_arr['message'] = 'Availability added succssfully.';
        else:
        	$return_arr['status']  = 'error';
            $return_arr['message'] = 'Something went wrong while adding availability, Please try again.';

        endif;

        return response()->json($return_arr);
    } // end add

    public function update(Request $request)
    {
        $arr_rules['event_id']   = 'required';
        $arr_rules['start_date'] = 'required';
        $arr_rules['start_time'] = 'required';
        $arr_rules['end_date']   = 'required';
        $arr_rules['end_time']   = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails()):
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Something went wrong. Please try again!';
            return response()->json($return_arr);
        endif;

        $event_id   = $request->input('event_id');
        $start_date = $request->input('start_date');
        $start_time = $request->input('start_time');
        $end_date   = $request->input('end_date');
        $end_time   = $request->input('end_time');

        $data['start_datetime'] = convert_datetime( date('c', strtotime($start_date.' '.$start_time)), 'utc', 'datetime');
        $data['end_datetime']   = convert_datetime( date('c', strtotime($end_date.' '.$end_time)), 'utc', 'datetime');
        $data['start_date']     = date('Y-m-d', strtotime($data['start_datetime']));
        $data['end_date']       = date('Y-m-d', strtotime($data['end_datetime']));
        $data['start_time']     = date('H:i:s', strtotime($data['start_datetime']));
        $data['end_time']       = date('H:i:s', strtotime($data['end_datetime']));

        $update = $this->AvailabilityModel->where('id', $event_id)->where('doctor_id', $this->user_id)->update($data);
        if( $update ):
        	$return_arr['status']  = 'success';
            $return_arr['message'] = 'Availability updated succssfully.';

        else:
        	$return_arr['status']  = 'error';
            $return_arr['message'] = 'Something went wrong while updating availability, Please try again.';

        endif;

        return response()->json($return_arr);
    } // end update

    public function delete(Request $request)
    {
        $arr_rules['event_id'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails()):
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Something went wrong. Please try again!';
            return response()->json($return_arr);
        endif;

        $delete = $this->AvailabilityModel->where('id', $request->input('event_id'))->where('doctor_id', $this->user_id)->delete();
        if( $delete ):
        	$return_arr['status']  = 'success';
            $return_arr['message'] = 'Availability deleted succssfully.';

        else:
        	$return_arr['status']  = 'error';
            $return_arr['message'] = 'Something went wrong while deleting availability, Please try again.';

        endif;

        return response()->json($return_arr);
    } // end delete

    public function resume()
    {
        $status = $this->UserModel->where('id','=',$this->user_id)->update(['is_pause'=>'0']);
        if($status)
        {
            Session::flash('success','Resume succssfully.');
            return redirect()->back();
        }
        else
        {
            Session::flash('error','Something went wrong,Please try again.');
            return redirect()->back();
        }
    }

    public function pause()
    {
        $status = $this->UserModel->where('id','=',$this->user_id)->update(['is_pause'=>'1']);
        if($status)
        {
            Session::flash('success','Pause succssfully.');
            return redirect()->back();
        }
        else
        {
            Session::flash('error','Something went wrong,Please try again.');
            return redirect()->back();
        }
    }
}
