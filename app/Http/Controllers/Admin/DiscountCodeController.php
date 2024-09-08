<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\DiscountCodeModel;
use Flash;
use Validator;

class DiscountCodeController extends Controller
{
    public function __construct()
    {
    	$this->DiscountCodeModel	=	new DiscountCodeModel();

    	$this->arr_view_data              = [];
        $this->module_url_path            = url(config('app.project.admin_panel_slug')."/discount_code");
        $this->module_title               = "Discount Code";
        $this->module_view_folder         = "admin.discount_code";
        $this->admin_panel_slug           = config('app.project.admin_panel_slug');
    }

    public function index()
    {
    	$arr_discount_code = [];
    	$obj_discount_code = $this->DiscountCodeModel->orderBy('id','desc')->get();
    	if($obj_discount_code)
    	{
    		$arr_discount_code = $obj_discount_code->toArray();
    	}

    	$this->arr_view_data['arr_discount_code']     = $arr_discount_code;
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
    	$form_data = $request->all();

        $discount_code      = $this->create_discount_code();
        $data['code']       = $discount_code;
        $data['price']      = encrypt_value($form_data['price']);
        $data['start_date'] = trim(date('Y-m-d',strtotime($request->input('start_date'))));
        $data['end_date']   = trim(date('Y-m-d',strtotime($request->input('end_date'))));
        $data['status']     = $form_data['status'];

        $store_date = $this->DiscountCodeModel->create($data);
        if($store_date)
        {
            Flash::success('Discount Code Added Successfully.');
        }
        else
        {
            Flash::error('Problem Occured, While Adding discount code details.');
        }

        return redirect(url($this->module_url_path));
    }

    public function create_discount_code()
    {
        $res = '';
        $res .= 'MD';
        $res .= mt_rand(10000,99999);
        return $res;
    }

    public function edit($enc_id)
    {
    	$arr_discount_code = [];
    	$id = base64_decode($enc_id);

        $obj_discount_code = $this->DiscountCodeModel->where('id', $id)->first();
        if($obj_discount_code)
        {
            $this->arr_view_data['arr_discount_code'] = $obj_discount_code->toArray();
        }

        $this->arr_view_data['page_title']      = 'Edit Discount Code';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = str_singular($this->module_title);

        return view($this->module_view_folder.'/edit',$this->arr_view_data);
    }

    public function update(Request $request, $enc_id)
    {
        $form_data = $request->all();

        $data['price']      = encrypt_value($form_data['price']);
        $data['start_date'] = trim(date('Y-m-d',strtotime($request->input('start_date'))));
        $data['end_date']   = trim(date('Y-m-d',strtotime($request->input('end_date'))));
        $data['status']     = $form_data['status'];

        $id = base64_decode($enc_id);

        $update_date = $this->DiscountCodeModel->where('id', $id)->update($data);
        if($update_date)
        {
            Flash::success('Discount Code Updated Successfully.');
        }
        else
        {
            Flash::error('Problem Occured, While Updating Data.');
        }
        return redirect()->back();

    } 

    public function activate($enc_id=FALSE)
    {
        if($enc_id!="")
        {
            $id = base64_decode($enc_id);
            $info = $this->DiscountCodeModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->DiscountCodeModel->where('id',$id)->update(['status'=>'1']);
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
            $info = $this->DiscountCodeModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->DiscountCodeModel->where('id',$id)->update(['status'=>'0']);
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
        
                $delete_data = $this->DiscountCodeModel->where('id',$record_id)->delete();
                if($delete_data)
                {
                    Flash::success($this->module_title.'\'s Deleted Successfully');        
                } 
        
            }
            elseif($multi_action=="activate")
            {

                $result = $this->DiscountCodeModel->where('id',$record_id)->first();

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
                   
                $result = $this->DiscountCodeModel->where('id',$record_id)->first();

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

        $delete_date = $this->DiscountCodeModel->where('id', $id)->delete();
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
