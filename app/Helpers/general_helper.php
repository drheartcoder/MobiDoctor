<?php 

use App\Common\Services\MailchimpService;

use App\Models\DoctorDetailsModel;
use App\Models\NotificationModel;
use App\Models\FamilyMemberModel;
use App\Models\CardDetailsModel;
use App\Models\TimezoneModel;
use App\Models\UserModel;
use App\Models\PrefixModel;
use App\Models\ConsultationTransactionModel;
use Carbon\Carbon;

    /*------------------------------------------------------------------------------
    | Encodes bcrypt value
    --------------------------------------------------------------------------------*/

        function encrypt_value($value = false)
        {
            $encrypted = null;
            if( !empty($value) && $value != null )
            {
                $encrypted = encrypt($value);
            }
            return $encrypted;
        }


    /*------------------------------------------------------------------------------
    | Decodes bcrypt value
    --------------------------------------------------------------------------------*/

        function decrypt_value($value = false)
        {
            $decrypted = null;
            if( !empty($value) && $value != null )
            {
                $decrypted = decrypt($value);
            }
            return $decrypted;
        }

    /*-----------------------------------------------------------------------------
    |  Get Uesr Dump ID
    --------------------------------------------------------------------------------*/

        function get_dump_id_session($id = false)
        {
            $dump_id_session = [];
            $obj_dump_id = UserModel::select('dump_id','dump_session')->where('id','=',$id)->first();
            if($obj_dump_id)
            {
                $dump_id_session = $obj_dump_id->toArray();
            }

            return $dump_id_session;
        }

        function get_prefix_name($id = false)
        {
            $prefix = '';
            $obj_prefix_name = PrefixModel::select('name')->where('id','=',$id)->first();
            if($obj_prefix_name)
            {
                $prefix = $obj_prefix_name->name;
            }

            return $prefix;
        }

    /*
    | Function  : Get Patient Amount
    | Author    : Gaurav Ashok Shewale
    | Date      : 22/02/2019
    | Output    : Amount
    */

    function get_total_amount($cosult_id = false)
    {
        $arr_data     = array();
        $total_amount = 0;
        if ( isset($cosult_id) && $cosult_id!='' ) 
        {
            $obj_amount   = ConsultationTransactionModel::select('id','consultation_id','amount')->where('consultation_id','=',$cosult_id)->get();
            if(isset($obj_amount) && $obj_amount!=null)
            {
                $arr_data = $obj_amount->toArray(); 
                if( isset($arr_data) && sizeof($arr_data) ) 
                {
                    foreach ($arr_data as $key => $data) 
                    {
                        $amount       = isset($data['amount']) && $data['amount']>0 ? $data['amount']:0;
                        $total_amount = $total_amount + $amount;
                    }
                } 
            }
        }
        return number_format($total_amount,2, '.', '');
    }    

    function new_notification_count()
    {
        $user = Sentinel::check();
        
        if($user)
        {
            $new_notifications = NotificationModel::where([
                                                        ['to_user_id',$user->id],
                                                        ['status','unread']
                                                     ])
                                                    ->count();

            if($new_notifications != 0 && $new_notifications !='')
            {
                return $new_notifications;
            }
        }
    }

    function login_user_info()
    {
        $user = Sentinel::check();
        
        if($user)
        {
            $login_user = UserModel::where('id',$user->id)->first();
            if(isset($login_user) && !empty($login_user))
            {
                return $login_user['session_id'];                                                        
            }
        }   
    }


    /*
    | Function  : Get User IP, Location, Address and Browser Data
    | Author    : Deepak Arvind Salunke
    | Date      : 28/12/2018
    | Output    : User IP, Location, Address and Browser Data
    */

    function get_browser_data()
    {
        $browser_data = [];
        $browser_data['address'] = '';

        $browser_data['ip']       = \Request::ip();
        $browser_data['location'] = \Location::get($browser_data['ip']);
        $browser_data['browser']  = $_SERVER['HTTP_USER_AGENT'];
        
        if( isset( $browser_data['location'] ) && !empty( $browser_data['location'] ) ):
            $browser_data['address'] = getaddress($browser_data['location']->latitude, $browser_data['location']->longitude);
        endif;

        return $browser_data;
    }


    function getaddress($lat, $lng)
    {
        if( !empty( $lat ) && !empty( $lng ) )
        {
            $url    = 'https://maps.googleapis.com/maps/api/geocode/json?key='.trim( env('GOOGLE_MAPS_API') ).'&latlng='.trim($lat).','.trim($lng).'&sensor=false';
            $json   = @file_get_contents($url);
            $data   = json_decode($json);
            $status = $data->status;
            if($status == "OK")
            {
                return $data->results[0]->formatted_address;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }


    /*
    | Function : Generate OTP Number
    | Author   : Deepak Arvind Salunke
    | Date     : 28/12/2018
    | Output   : Return OTP Number
    */

    function generate_otp()
    {
        // For Live
        /*$random_otp    = '';
        $digits_needed = 4;
        $count         = 0;
        while ( $count < $digits_needed ) 
        {
            $random_digit = rand(0,9);
            $random_otp .= $random_digit;
            $count++;
        }*/

        // For Development
        $random_otp = '1234';

        return $random_otp;
    }

    /*
    | Function   : Convert datetime to timezone and type send datetime
    | Author     : Deepak Arvind Salunke
    | Date       : 04/04/2018
    | Output     : Return new datetime format
    | Parameters : $datetime = datetime (DateTime which is needed to convert)
    |              $timezone = utc (By Default) / user
    |              $type     = datetime (By Default) / date / time
    */

    function convert_datetime($datetime = false, $timezone = false, $type = false)
    {
        // Get user timezone id or default timezone
        $user = Sentinel::check();
        if($user):
            $timezone_id = $user->timezone;
        else:
            $timezone_id = '575';
        endif;


        // Get selected timezone offset
        $obj_timezone = TimezoneModel::where('id', $timezone_id)->first();
        if( $obj_timezone ):
            $selected_timezone = $obj_timezone->toArray();
            $selected_offset   = $selected_timezone['utc_offset'];
        else:
            $selected_offset   = '+00:00';
        endif;

        $sign          = substr($selected_offset, 0, 1) == '+' ? '' : '-';
        $offset_hour   = substr($selected_offset, 1, 2);
        $offset_minute = substr($selected_offset, 4, 2);

        $operation = $sign == '' ? 'add' : 'sub';
        $new_datetime = Carbon::parse($datetime);

        
        // add or sub datetime according to the timezone
        if( $timezone == 'user' ):
            if($operation == 'add'):
                $modified_hour     = $new_datetime->addHour($offset_hour);
                $modified_datetime = $modified_hour->addMinute($offset_minute);

            elseif($operation == 'sub'):
                $modified_hour     = $new_datetime->subHours($offset_hour);
                $modified_datetime = $modified_hour->subMinute($offset_minute);

            endif;

        else:
            if($operation == 'add'):
                $modified_hour     = $new_datetime->subHours($offset_hour);
                $modified_datetime = $modified_hour->subMinute($offset_minute);

            elseif($operation == 'sub'):
                $modified_hour     = $new_datetime->addHour($offset_hour);
                $modified_datetime = $modified_hour->addMinute($offset_minute);

            endif;

        endif;
        
        // date time format according to the type
        if( $type == 'date' ):
            $format = 'Y-m-d';
        elseif( $type == 'time' ):
            $format = 'H:i:s';
        else:
            $format = 'Y-m-d H:i:s';
        endif;


        $modified_date_time = Carbon::parse($modified_datetime)->format($format);

        return $modified_date_time;
    }


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 25/01/2019
    | Output    : 
    */

    function calculate_profile($user_id = false, $user_type = false)
    {
        $columns = $user_data = $doc_data = $extra_data = $doc_user = [];
        $total = 0;

        if( empty( $user_id ) ):
            $user = Sentinel::check();

            $user_id   = $user->id;
            $user_type = $user->user_type;
        endif;

        // For doctor profile
        if( $user_type == 'doctor' ):

            $user_data = UserModel::where('id', $user_id)
                                  ->select('first_name', 'last_name', 'email', 'mobile_no', 'contact_no', 'gender', 'address', 'city', 'country', 'profile_image', 'date_of_birth', 'prefix', 'timezone')
                                  ->first();

            $doc_data = DoctorDetailsModel::where('user_id', $user_id)
                                          ->select('clinic_name', 'clinic_address', 'experience', 'language', 'medical_qualification', 'medical_school', 'year_obtained', 'country_obtained', 'bank_name', 'bank_account_name', 'bank_account_no', 'driving_licence', 'medical_registration', 'medicare_provider_no', 'prescriber_no', 'ahpra_registration_no')
                                          ->first();

            $doc_user   = $user_data ? $user_data->toArray() : array('first_name' => '', 'last_name' => '', 'email' => '', 'mobile_no' => '', 'contact_no' => '', 'gender' => '', 'address' => '', 'city' => '', 'country' => '', 'profile_image' => '', 'date_of_birth' => '', 'prefix' => '', 'timezone' => '');
            $extra_data = $doc_data ? $doc_data->toArray() : array( 'clinic_name' => '', 'clinic_address' => '', 'experience' => '', 'language' => '', 'medical_qualification' => '', 'medical_school' => '', 'year_obtained' => '', 'country_obtained' => '', 'bank_name' => '', 'bank_account_name' => '', 'bank_account_no' => '', 'driving_licence' => '', 'medical_registration' => '', 'medicare_provider_no' => '', 'prescriber_no' => '', 'ahpra_registration_no' => '' );
            $data       = array_merge($doc_user, $extra_data);

            $user_columns = preg_grep('/(.+ed_at)|(.*id)/', array_keys($doc_user), PREG_GREP_INVERT);
            $doc_columns  = preg_grep('/(.+ed_at)|(.*id)/', array_keys($extra_data), PREG_GREP_INVERT);
            $columns      = array_merge($user_columns, $doc_columns);

        // For patient profile
        elseif( $user_type == 'patient' ):

            $user_data = UserModel::where('id', $user_id)
                                  ->select('first_name', 'last_name', 'email', 'mobile_no', 'contact_no', 'gender', 'address', 'city', 'country', 'profile_image', 'date_of_birth', 'timezone')
                                  ->first();

            $pat_user = $user_data ? $user_data->toArray() : array('first_name' => '', 'last_name' => '', 'email' => '', 'mobile_no' => '', 'contact_no' => '', 'gender' => '', 'address' => '', 'city' => '', 'country' => '', 'profile_image' => '', 'date_of_birth' => '', 'timezone' => '');
            $data     = $pat_user;

            $columns = preg_grep('/(.+ed_at)|(.*id)/', array_keys($pat_user), PREG_GREP_INVERT);

        endif;
        
        $per_column = 100 / count($columns);

        foreach ($data as $key => $value):
            if ($value !== NULL && $value !== [] && $value !== '' && in_array($key, $columns)):
                $total += $per_column;
            endif;
        endforeach;

        return round($total);
    }


    function get_family_member($user_id = false, $patient_id = false)
    {
        $arr_family = [];

        if( !empty( $user_id ) && !empty( $patient_id ) ):
            
            $obj_family = FamilyMemberModel::select('id','user_id','first_name','last_name')->where('id', $patient_id)->where('user_id', $user_id)->first();
            if( $obj_family ):
                $arr_family = $obj_family->toArray();
            endif;

        endif;

        return $arr_family;
    }

    /*
    | Function  : 
    | Author    : Gaurav Ashok Shewale
    | Date      : 25/02/2019
    | Output    : user details array
    */

    function get_user_details($user_id = false)
    {
        $arr_user = [];

        if( !empty( $user_id ) ):
            
            $obj_user = UserModel::select('id','first_name','last_name','mobile_no','address')->where('id', $user_id)->first();
            if( $obj_user ):
                $arr_user = $obj_user->toArray();
            endif;

        endif;

        return $arr_user;
    }

    function verify_fb_token($fb_access_token)
    {
        $fb_req = curl_init();
        curl_setopt($fb_req,CURLOPT_URL,"https://graph.facebook.com/me?access_token=".$fb_access_token);
        curl_setopt($fb_req,CURLOPT_RETURNTRANSFER,1);
        $response = curl_exec($fb_req);
        curl_close($fb_req);
        $arr_decoded_dara = json_decode($response,TRUE);

        return !isset($arr_decoded_dara['error']);
    }

?>