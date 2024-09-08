<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;

use App\Models\InvitationModel;
use App\Models\UserModel;
use App\Common\Services\EmailService;

class InvitationSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invitation_mail_send:invite';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Invitation mail and change status for is_mail_send';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(InvitationModel $invitation_model,
                                EmailService $email_service,
                                UserModel $user_model)
    {
        parent::__construct();
        $this->InvitationModel       = $invitation_model;
        $this->EmailService          = $email_service;
        $this->UserModel             = $user_model;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $arr_invitation = [];
        $obj_invitation = $this->InvitationModel->with(['user_details'=>function($qry){
                                                    $qry->select('id','referral_code');
                                                }])
                                                ->select('id','user_id','name','email','is_mail_send')
                                                ->where('is_mail_send','=','0')
                                                ->get();
        if($obj_invitation)
        {
            $arr_invitation = $obj_invitation->toArray();
        }


        if(isset($arr_invitation) && sizeof($arr_invitation)>0)
        {
            foreach ($arr_invitation as $key => $value) 
            {   
                $name = $id = '';
                $arr_built_content = $arr_data = [];

                $name = isset($value['name'])?$value['name']:'';
                $id   = isset($value['id'])?$value['id']:'';
                $invitation_link = url('/');
                $referral_code = isset($value['user_details']['referral_code'])?$value['user_details']['referral_code']:'';

                $arr_built_content = [
                                    'FIRST_NAME'      => $name,
                                    'APP_NAME'        => config('app.project.name'),
                                    'INVITATION_LINK' => $invitation_link,
                                    'REFERRAL_CODE'   => $referral_code
                                ];

                $arr_data['email'] = isset($value['email'])?$value['email']:'';
                $arr_data['first_name'] = $name;

                $arr_mail_data                      = [];
                $arr_mail_data['email_template_id'] = '3';
                $arr_mail_data['arr_built_content'] = $arr_built_content;
                $arr_mail_data['user']              = $arr_data;

                $email_status = $this->EmailService->send_mail($arr_mail_data);
                if($email_status)
                {
                    $this->InvitationModel->where('id','=',$id)->update(["is_mail_send"=>'1']); 
                }

            } 
        }
    }
}
