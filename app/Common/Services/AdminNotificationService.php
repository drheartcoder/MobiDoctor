<?php
namespace App\Common\Services;
use App\Models\AdminNotificationModel;

class AdminNotificationService
{
	public function create_admin_notification($notification_data=FALSE)
	{
		if(isset($notification_data) && sizeof($notification_data)>0)
		{
			$arr_data['from_user_id']     = isset($notification_data['from_user_id']) ? $notification_data['from_user_id'] : 0;
			$arr_data['message']          = isset($notification_data['message']) ? encrypt_value($notification_data['message']) : '';
			$arr_data['notification_url'] = isset($notification_data['notification_url']) ? $notification_data['notification_url'] : '';

			AdminNotificationModel::create($arr_data);
		}
	}
}
  
?>