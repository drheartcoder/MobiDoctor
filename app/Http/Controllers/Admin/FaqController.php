<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Common\Services\MultiActionService;

use App\Models\FaqModel;

use Validator;
use DataTables;
use Flash;

class FaqController extends Controller
{
    public function __construct(FaqModel $faq)
	{
		$this->arr_view_data      = [];
		$this->module_title       = "FAQ";
		$this->FaqModel           = $faq;
		$this->BaseModel          = $this->FaqModel;
		$this->module_view_folder = "admin.faq";
		$this->module_icon        = "fa fa-question-circle";
		$this->admin_panel_slug   = config('app.project.admin_panel_slug');
		$this->module_url_path    = url(config('app.project.admin_panel_slug')."/faq");
	}

	public function index()
    {
    	$arr_faq = [];
    	$obj_faq = $this->FaqModel->select('id','user_type','question','answer','status','created_at')->orderBy('id','desc')->get();
    	if($obj_faq)
    	{
    		$arr_faq = $obj_faq->toArray();
    	}

    	$this->arr_view_data['arr_faq']     	= $arr_faq;
    	$this->arr_view_data['module_url_path'] = $this->module_url_path;
		$this->arr_view_data['module_title']    = str_singular($this->module_title);
		$this->arr_view_data['page_title'] 		= str_singular($this->module_title);
    	return view($this->module_view_folder.'/index',$this->arr_view_data);
    }

	public function create()
	{
		$this->arr_view_data['module_url_path'] = $this->module_url_path;
		$this->arr_view_data['module_title']    = str_singular($this->module_title);
		$this->arr_view_data['page_title'] 		= str_singular($this->module_title);
    	return view($this->module_view_folder.'/create',$this->arr_view_data);
	}

	public function store(Request $request)
	{
		$arr_rules               = $arr_faq = array();
		$status                  = false;

		$arr_rules['question']   =  "required";
		$arr_rules['answer']     =  "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$question  = $request->input('question', null);
		$answer    = $request->input('answer', null);
		$user_type = $request->input('user_type', null);

		$arr_faq['user_type'] = $user_type;
		$arr_faq['question']  = encrypt_value( $question );
		$arr_faq['answer']    = encrypt_value( $answer );
		$arr_faq['status']   = '1';

		$obj_faq = new FaqModel();

		$status = $obj_faq->create($arr_faq);		

		if($status)
		{
			Flash::success($this->module_title.' added successfully.');
			return redirect(url($this->module_url_path));
		}

		Flash::error('Error while adding '.$this->module_title.'.');
		return redirect()->back();
	}

	public function edit($enc_id=false)
	{ 
		if ( isset( $enc_id ) && $enc_id!=false ) 
	    {
			$id = base64_decode($enc_id);
			$arr_faq = [];

			$obj_faq = new FaqModel();
			$obj_faq = $obj_faq
							->where('id',$id)
							->select('id','question','answer','user_type')
							->first();
			
			if($obj_faq)
			{
				$arr_faq = $obj_faq->toArray();	
			}

			$this->arr_view_data['arr_faq']         = $arr_faq;
			$this->arr_view_data['page_title']      = 'Edit Faq';
	        $this->arr_view_data['module_url_path'] = $this->module_url_path;
	        $this->arr_view_data['module_title']    = str_singular($this->module_title);

	        return view($this->module_view_folder.'/edit',$this->arr_view_data);
	    }
	    
	    Flash::error('Something went wrong.');
		return redirect(url($this->module_url_path));
	}

	public function update(Request $request, $enc_id = false)
	{
		$arr_faq    = [];
		$arr_rules  = array();
		$status     = false;
		
		$arr_rules['question']   =  "required";
		$arr_rules['answer']     =  "required";

	    if ( isset( $enc_id ) && $enc_id!=false ) 
	    {
	    	$validator = validator::make($request->all(),$arr_rules);

			if ($validator->fails()) 
			{
				return redirect()->back()->withErrors($validator)->withInput();
			}

			$id        = base64_decode($enc_id);
			$question  = $request->input('question', null);
			$answer    = $request->input('answer', null);
			$user_type = $request->input('user_type', null);
			
			$arr_faq['user_type'] = $user_type;
			$arr_faq['question']  = encrypt_value( $question );
			$arr_faq['answer']    = encrypt_value( $answer );	

			$obj_faq = new FaqModel();
			$status  = $obj_faq
							->where('id',$id)
							->update($arr_faq);		
			if($status)
			{
				Flash::success($this->module_title.' updated successfully.');
				return redirect()->back();
			}
			
			Flash::error('Error while updating '.$this->module_title.'.');
			return redirect()->back();
	    }	

		Flash::error('Error while updating '.$this->module_title.'.');
		return redirect()->back();
	}

	public function activate($enc_id=FALSE)
    {
        if($enc_id!="")
        {
            $id = base64_decode($enc_id);
            $info = $this->FaqModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->FaqModel->where('id',$id)->update(['status'=>'1']);
                if($update_result)
                {
                    Flash::success($this->module_title.' Activated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Activating '.$this->module_title);
                }
            }
            else
            {
                Flash::error('Sorry, Invalid Request.');
            }
        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

        return redirect()->back();
    } 

    public function deactivate($enc_id=FALSE)
    {
        if($enc_id!="")
        {
            $id = base64_decode($enc_id);
            $info = $this->FaqModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->FaqModel->where('id',$id)->update(['status'=>'0']);
                if($update_result)
                {
                    Flash::success($this->module_title.' Blocked Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While block '.$this->module_title);
                }
            }
            else
            {
                Flash::error('Sorry, Invalid Request.');
            }
        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

        return redirect()->back();
    } // end discount_code_deactivate

    public function multi_action(Request $request)
    {
       
        $arr_rules = array();
        $arr_rules['multi_action']       = 'required';
        $arr_rules['checked_record']     = 'required';

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->module_title.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');


        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            $record_id = base64_decode($record_id);

            if($multi_action=="delete")
            { 
        
                $delete_data = $this->FaqModel->where('id',$record_id)->delete();
                if($delete_data)
                {
                    Flash::success($this->module_title.'\'s Deleted Successfully');        
                } 
        
            }
            elseif($multi_action=="activate")
            {

                $result = $this->FaqModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'1']);

                    if($result_status)
                    { 
                        Flash::success($this->module_title.'\'s  Activated Successfully'); 
                    }
                }        
            }
            elseif($multi_action=="deactivate")
            {
                   
                $result = $this->FaqModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'0']);

                    if($result_status)
                    {  
                        Flash::success($this->module_title.'\'s  Blocked Successfully');  
                    }
                }        
            }
        }

        return redirect()->back();    
    } 

    public function delete($enc_id)
    {
        $id = base64_decode($enc_id);

        $delete_date = $this->FaqModel->where('id', $id)->delete();
        if($delete_date)
        {
            Flash::success('Discount Code Deleted Successfully.');
        }
        else
        {
            Flash::error('Problem Occured, While Deleting Data.');
        }
        return redirect()->back();

    } 
}
