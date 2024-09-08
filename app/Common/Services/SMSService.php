<?php

namespace App\Common\Services;
use Twilio\Rest\Client;

class SMSService
{
	public function __construct()
	{
		
	}

	// $arr_sms_data = array parameter should be - $to and $body
	public function send_sms($arr_sms_data = FALSE)
	{
		if(isset($arr_sms_data) && sizeof($arr_sms_data) > 0)
		{
			$sid   = env('TWILIO_SID'); // Your Account SID from www.twilio.com/console
			$token = env('TWILIO_TOKEN'); // Your Auth Token from www.twilio.com/console

			$client = new Client($sid, $token);

			try
            {
            	$message = $client->messages->create(
														$arr_sms_data['mobile'], // Text this number
															array(
																'from' => env('TWILIO_NUMBER'), // From a valid Twilio number
																'body' => $arr_sms_data['msg']
															)
													);
				if($message->sid)
				{
					return true;
				}
				else
				{
					return false;
				}
            }
            catch (\Exception $e)
            {
                return false;
            }
		}
		return false;
	}

}
?>