<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\RatingModel;

use Flash;
use Validator;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->RatingModel 		  = new RatingModel();
        $this->arr_view_data      = [];
        $this->module_url_path    = url(config('app.project.admin_panel_slug')."/rating");
        $this->module_title       = "Review & Rating";
        $this->module_view_folder = "admin.rating";
        $this->admin_panel_slug   = config('app.project.admin_panel_slug');
    }

    public function index()
    {
    	$arr_rating = [];
    	$obj_rating = $this->RatingModel->with(['patient_details'=>function($qry){
    																$qry->select('id','first_name','last_name');
    															},'doctor_details'=>function($qry){
    																$qry->select('id','first_name','last_name');
    															}])->get();
    	if($obj_rating)
    	{
    		$arr_rating = $obj_rating->toArray();
    	}

    	$this->arr_view_data['arr_rating']     = $arr_rating;
    	$this->arr_view_data['module_url_path'] = $this->module_url_path;
		$this->arr_view_data['module_title']    = str_singular($this->module_title);
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
    
    	return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function view($enc_id=FALSE)
    {
    	if($enc_id!='')
    	{
    		$arr_rating_details = [];
    		$id = base64_decode($enc_id);
    		$obj_rating_details = $this->RatingModel->with(['patient_details'=>function($qry){
    																$qry->select('id','first_name','last_name');
    															},'doctor_details'=>function($qry){
    																$qry->select('id','first_name','last_name');
    															}])
    												->where('id',$id)->first();
    		if($obj_rating_details)
    		{
    			$arr_rating_details = $obj_rating_details->toArray();
    		}

    		$this->arr_view_data['module_url_path'] = $this->module_url_path;
    		$this->arr_view_data['module_title'] = 'Manage '.$this->module_title;
    		$this->arr_view_data['page_title'] = 'View '.$this->module_title;
    		$this->arr_view_data['arr_rating_details'] = $arr_rating_details;
    		return view($this->module_view_folder.'.view',$this->arr_view_data);
    	}
    	else
    	{
    		Flash::error('Sorry, Invalid Request.');
    	}
    }

    public function delete($enc_id=FALSE)
    {
    	if($enc_id!='')
    	{
    		$id = base64_decode($enc_id);
			$delete_data = $this->RatingModel->where('id',$id)->delete();
			if($delete_data)
			{
				Flash::success($this->module_title.' Review & rating Deleted Successfully');        
			} 
			else
			{
				Flash::error('Problem Occured, While activating '.$this->module_title);
			}
    	}
    	else
    	{
    		Flash::error('Sorry, Invalid Request.');
    	}

    	return redirect()->back();
    }

    public function activate($enc_id=FALSE)
    {
        if($enc_id!='')
        {
            $id = base64_decode($enc_id);
            $info = $this->RatingModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->RatingModel->where('id',$id)->update(['status'=>'1']);
                if($update_result)
                {
                    Flash::success('Review & rating activated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While activating Review & rating.');
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
        if($enc_id!='')
        {
            $id = base64_decode($enc_id);
            $info = $this->RatingModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->RatingModel->where('id',$id)->update(['status'=>'0']);
                if($update_result)
                {
                    Flash::success($this->module_title.' Review & rating blocked Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While blocked '.$this->module_title);
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
        
                $delete_data = $this->RatingModel->where('id',$record_id)->delete();
                if($delete_data)
                {
                    Flash::success($this->module_title.' Deleted Successfully');        
                } 
        
            }
            elseif($multi_action=="activate")
            {

                $result = $this->RatingModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'1']);

                    if($result_status)
                    { 
                        Flash::success($this->module_title.' Activated Successfully'); 
                    }
                }        
            }
            elseif($multi_action=="deactivate")
            {
                   
                $result = $this->RatingModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'0']);

                    if($result_status)
                    {  
                        Flash::success($this->module_title.' Blocked Successfully');  
                    }
                }        
            }
        }

        return redirect()->back();    
    }
}
