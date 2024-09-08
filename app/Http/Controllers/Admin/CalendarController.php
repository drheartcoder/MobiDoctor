<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ConsultationSettingModel;
use App\Models\ConsultationModel;
use App\Models\AvailabilityModel;

use Validator;
use Sentinel;
use Session;
use Flash;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->ConsultationSettingModel = new ConsultationSettingModel();
        $this->ConsultationModel        = new ConsultationModel();
        $this->AvailabilityModel        = new AvailabilityModel();

        $this->arr_view_data            = [];
        $this->module_url_path          = url(config('app.project.admin_panel_slug')."/calendar");
        $this->module_title             = "Calendar";
        $this->module_view_folder       = "admin.calendar";
        $this->admin_panel_slug         = config('app.project.admin_panel_slug');
    }

    public function index()
    { 
        $this->arr_view_data['page_title'] = 'Calendar';
        $arr_stripe_settings = array();

    	$user = Sentinel::check();

    	if($user):
    		if($user->inRole('admin')):
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = str_singular($this->module_title);
                return view($this->module_view_folder.'/index',$this->arr_view_data);

            else:
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/login');
            endif;
        else:
        	Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        endif;
    }


    public function all_dates()
    {
        $arr_data = $calendar_dates = [];

        $obj_available_dates = $this->AvailabilityModel->select('id','doctor_id','start_datetime','end_datetime')
                                                       ->with(['doctor_details' => function($query){
                                                            $query->select('id','prefix','first_name','last_name')
                                                                  ->with('doctor_prefix');
                                                        }])
                                                       ->get();
        if( $obj_available_dates ):
            $arr_available_dates = $obj_available_dates->toArray();

            foreach($arr_available_dates as $value):

                $doc_prefix = isset( $value['doctor_details']['doctor_prefix']['name'] ) && !empty( $value['doctor_details']['doctor_prefix']['name'] ) ? $value['doctor_details']['doctor_prefix']['name'] : '';
                $doc_first_name = isset( $value['doctor_details']['first_name'] ) && !empty( $value['doctor_details']['first_name'] ) ? decrypt_value( $value['doctor_details']['first_name'] ) : '';
                $doc_last_name = isset( $value['doctor_details']['last_name'] ) && !empty( $value['doctor_details']['last_name'] ) ? decrypt_value( $value['doctor_details']['last_name'] ) : '';

                $doc_name = $doc_prefix.'. '.$doc_first_name.' '.$doc_last_name;

                $dates_arr            = [];
                $dates_arr['id']      = $value['id'];
                $dates_arr['dr_name'] = $doc_name;
                $dates_arr['for']     = 'available';
                $dates_arr['start']   = convert_datetime( date('D M d Y G:i:s', strtotime($value['start_datetime'])), 'utc', 'datetime');
                $dates_arr['end']     = convert_datetime( date('D M d Y G:i:s', strtotime($value['end_datetime'])), 'utc', 'datetime');

                array_push($arr_data, $dates_arr);
            endforeach;
        endif;

        /*$obj_consult = $this->ConsultationModel->select('id','consultation_id','user_id','doctor_id','date','time','payment','is_completed','status')->where('is_completed', 1)->get();
        if( $obj_consult ):
            $arr_consult = $obj_consult->toArray();

            foreach($arr_consult as $value):
                $consult_arr          = [];
                $consult_arr['id']    = $value['id'];
                $consult_arr['for']   = 'consult';
                $consult_arr['start'] = date('D M d Y G:i:s', strtotime($value['date'].' '.$value['time']) );
                $consult_arr['end']   = date('D M d Y G:i:s', strtotime('+10 minutes', strtotime($value['date'].' '.$value['time']) ));

                array_push($arr_data, $consult_arr);
            endforeach;
        endif;*/

        if( count($arr_data) > 0 ):
            $calendar_dates = json_encode($arr_data);
        endif;

        return $calendar_dates;

    } // end all_dates
}
