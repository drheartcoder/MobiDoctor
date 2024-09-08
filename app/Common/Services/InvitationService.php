<?php

namespace App\Common\Services;

use App\Models\InvitationModel;
class InvitationService
{
	function store_invitation($invitation_data)
	{
		$arr_data['name'] = $name   = isset($invitation_data['name'])?$invitation_data['name']:'';
		$arr_data['email']   = isset($invitation_data['email'])?$invitation_data['email']:'';
		$arr_data['user_id'] = isset($invitation_data['user_id'])?$invitation_data['user_id']:'';
		$status = InvitationModel::create($arr_data);
		return $status;
	}
}