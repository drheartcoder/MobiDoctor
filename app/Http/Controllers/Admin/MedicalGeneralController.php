<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\MedicalGeneralModel;

use Validator;
use Flash;

class MedicalGeneralController extends Controller
{
    public function __construct()
   	{   
        $this->MedicalGeneralModel        = new MedicalGeneralModel();

   		$this->arr_view_data              = [];
        $this->module_url_path            = url(config('app.project.admin_panel_slug')."/medical_general");
        $this->module_title               = "Medical General";
        $this->module_view_folder         = "admin.medical_general";
        $this->admin_panel_slug           = config('app.project.admin_panel_slug');
   	}

   	public function index()
   	{

        $arr_medical = [];
        $obj_medical = $this->MedicalGeneralModel->orderBy('id','desc')->get();
        if($obj_medical)
        {
            $arr_medical = $obj_medical->toArray();
        }
        $this->arr_view_data['arr_medical']    = $arr_medical;
   		$this->arr_view_data['module_url_path'] = $this->module_url_path;
		$this->arr_view_data['module_title']    = str_singular($this->module_title);
		$this->arr_view_data['page_title'] 		= 'Manage '.$this->module_title;
    	return view($this->module_view_folder.'/index',$this->arr_view_data);
   	}

   	public function create()
   	{
   		$this->arr_view_data['module_url_path'] = $this->module_url_path;
		$this->arr_view_data['module_title']    = 'Manage '.str_singular($this->module_title);
		$this->arr_view_data['page_title'] 		= 'Add Medical General';
    	return view($this->module_view_folder.'/create',$this->arr_view_data);
   	}

   	public function store(Request $request)
   	{
   		$arr_rules = [];
   		$arr_rules['medical_general_name'] = 'required';
   		$validator = Validator::make($request->all(),$arr_rules);
   		if($validator->fails())
   		{
   			return back()->withErrors($validator)->withInput();
   		}

   		$name = trim($request->input('medical_general_name'));
   		$slug = str_slug($name);

   		$is_exist = $this->MedicalGeneralModel->where('slug','=',$slug)->get();
   		if(count($is_exist)>0)
   		{
   			Flash::error($this->module_title.' already exist.');
   			return redirect()->back();
   		}

   		$arr_data['name'] = encrypt_value($name);
   		$arr_data['slug'] = $slug;

   		$status = $this->MedicalGeneralModel->create($arr_data);
   		if($status)
   		{
   			Flash::success($this->module_title.' added successfully.');
   			return redirect()->back();
   		}
   		else
   		{
   			Flash::error('Problem occur,while adding '.$this->module_title);
   			return redirect()->back();
   		}
   	}

   	public function edit($enc_id=false)
   	{
   		if($enc_id!='')
   		{
   			$id = base64_decode($enc_id);

   			$obj_medical = $this->MedicalGeneralModel->where('id','=',$id)->first();
   			$name = isset($obj_medical->name)?decrypt_value($obj_medical->name):'';

   			$this->arr_view_data['name']            = $name;
   			$this->arr_view_data['enc_id']          = $enc_id;
   			$this->arr_view_data['module_url_path'] = $this->module_url_path;
			$this->arr_view_data['module_title']    = 'Manage '.str_singular($this->module_title);
			$this->arr_view_data['page_title'] 		= 'Edit Medical General';
	    	return view($this->module_view_folder.'/edit',$this->arr_view_data);
   		}
   		else
   		{
   			Flash::error('Something went wrong,please try again.');
   			return redirect()->back();
   		}
   	}

   	public function update(Request $request,$enc_id='')
   	{
   		$arr_rules = [];
   		$arr_rules['medical_general_name'] = 'required';
   		$validator = Validator::make($request->all(),$arr_rules);
   		if($validator->fails())
   		{
   			return back()->withErrors($validator)->withInput();
   		}

   		$name = trim($request->input('medical_general_name'));
   		$slug = str_slug($name);

   		$id = base64_decode($enc_id);
   		$is_exist = $this->MedicalGeneralModel->where('slug','=',$slug)
   											  ->where('id','<>',$id)
   											  ->get();
   		if(count($is_exist)>0)
   		{
   			Flash::error($this->module_title.' already exist.');
   			return redirect()->back();
   		}

   		$medical_name = encrypt_value($name);

   		$status = $this->MedicalGeneralModel->where('id','=',$id)->update(['name'=>$medical_name]);
   		if($status)
   		{
   			Flash::success($this->module_title.' updated successfully.');
   			return redirect()->back();
   		}
   		else
   		{
   			Flash::error('Problem occur,while updating '.$this->module_title);
   			return redirect()->back();
   		}
   	}

   	public function activate($enc_id=FALSE)
    {
        if($enc_id!="")
        {
            $id = base64_decode($enc_id);
            $info = $this->MedicalGeneralModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->MedicalGeneralModel->where('id',$id)->update(['status'=>'1']);
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
    } // end discount_code_activate

    public function deactivate($enc_id=FALSE)
    {
        if($enc_id!="")
        {
            $id = base64_decode($enc_id);
            $info = $this->MedicalGeneralModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->MedicalGeneralModel->where('id',$id)->update(['status'=>'0']);
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
        
                $delete_data = $this->MedicalGeneralModel->where('id',$record_id)->delete();
                if($delete_data)
                {
                    Flash::success($this->module_title.'\'s Deleted Successfully');        
                } 
        
            }
            elseif($multi_action=="activate")
            {

                $result = $this->MedicalGeneralModel->where('id',$record_id)->first();

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
                   
                $result = $this->MedicalGeneralModel->where('id',$record_id)->first();

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
}
