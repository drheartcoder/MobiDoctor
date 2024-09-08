<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\StaticPagesModel;
use Validator;
use Flash;
class StaticPagesController extends Controller
{
    public function __construct(StaticPagesModel $static)
    {
        $this->StaticPagesModel     = $static;
        $this->arr_view_data        = [];
        $this->module_url_path      = url(config('app.project.admin_panel_slug')."/static_pages");
        $this->module_title         = "Front Static Pages";
        $this->module_url_slug      = "static_pages";
        $this->module_view_folder   = "admin.static_pages";
        //$this->admin_panel_slug = config('app.project.admin_panel_slug');
    }

    public function index()
    {
        $static_info = $this->StaticPagesModel->orderBy('id', 'DESC')->get();
    	if($static_info!=FALSE)
    	{
    		$pages_data = $static_info->toArray();
    	}
    	$this->arr_view_data['page_title']       = str_singular($this->module_title);
    	$this->arr_view_data['module_url_path']  = $this->module_url_path;
    	$this->arr_view_data['module_title']     = str_singular($this->module_title);
    	$this->arr_view_data['arr_static_pages'] = $pages_data;
    	return view($this->module_view_folder.'/index',$this->arr_view_data);	 
    }

    public function create()
    {
    	$this->arr_view_data['page_title']      = 'Add Static Pages';
    	$this->arr_view_data['module_url_path'] = $this->module_url_path;
    	$this->arr_view_data['module_title']    = str_singular($this->module_title);
    	return view($this->module_view_folder.'/create',$this->arr_view_data);	 
    }

    public function store(Request $request)
    {   $page_slug="";
    	$arr_rules = array();
    	$arr_rules['page_name']    = 'required';
    	$arr_rules['page_title']   = 'required';
    	$arr_rules['meta_title']   = 'required';
    	$arr_rules['meta_keyword'] = 'required';
    	$arr_rules['meta_desc']    = 'required';
    	$arr_rules['page_desc']    = 'required';

    	$validator = Validator::make($request->all(),$arr_rules);

    	if($validator->fails())
    	{
    		return redirect()->back()->withError($validator)->withInput($request->all());
    	}

    	$form_data = array();
    	$form_data = $request->all();
    	$arr_data = array();
    
    	$arr_data['page_name']      = $form_data['page_name'];
    	$arr_data['page_slug']      = str_slug($form_data['page_name']);
    	$arr_data['page_title']     = $form_data['page_title'];
    	$arr_data['page_desc']      = $form_data['page_desc'];
    	$arr_data['meta_title']     = $form_data['meta_title'];
    	$arr_data['meta_keyword']   = $form_data['meta_keyword'];
    	$arr_data['meta_desc']      = $form_data['meta_desc'];

        $duplicate = $this->StaticPagesModel->where('page_slug',$arr_data['page_slug'])->count();
       
        if($duplicate>0)
        {
          Flash::error('Page already exist.');
         return redirect()->back();

        }
    
        else
        {
        	$store_info = $this->StaticPagesModel->create($arr_data);

        	if($store_info)
        	{
        		Flash::success('Page Created Successfully.');
        	}
        	else
        	{
        		Flash::error('Problem Occured, While Creating page.');
        	}

        	return redirect()->back();
        }
    }

    public function edit($enc_id=null)
    { 
    	if($enc_id)
    	{
    		$page_id  = base64_decode($enc_id);

    		$page_information = $this->StaticPagesModel->where('id',$page_id)->first();

    		if($page_information)
    		{
    			$page_data = $page_information->toArray();
    		}	

    		$this->arr_view_data['pages_data']      = $page_data;
    		$this->arr_view_data['enc_id']          = $enc_id;
    		$this->arr_view_data['page_title']      = 'Edit Static Pages';
    		$this->arr_view_data['module_url_path'] = $this->module_url_path;
    		$this->arr_view_data['module_title']    = str_singular($this->module_title);
    		return view($this->module_view_folder.'/edit',$this->arr_view_data);	 
    	}

    	return redirect()->back();
    }

    public function update(Request $request,$enc_id=null)
    {
    	if($enc_id)
    	{
    		$page_id = base64_decode($enc_id);

    		$arr_rules = array();
    		$arr_rules['page_name']    = 'required';
	    	$arr_rules['page_title']   = 'required';
	    	$arr_rules['meta_title']   = 'required';
	    	$arr_rules['meta_keyword'] = 'required';
	    	$arr_rules['meta_desc']    = 'required';
	    	$arr_rules['page_desc']    = 'required';

	    	$validator = Validator::make($request->all(),$arr_rules);

	    	if($validator->fails())
	    	{
	    		return redirect()->back()->withError($validator)->withInput($request->all());
	    	}

	    	$form_data = array();
	    	$form_data = $request->all();
	    	$arr_data  = array();

	    	$arr_data['page_name']    = $form_data['page_name'];
	    	//$arr_data['page_slug']  = str_slug($form_data['page_name']);
	    	$arr_data['page_title']   = $form_data['page_title'];
	    	$arr_data['page_desc']    = $form_data['page_desc'];
	    	$arr_data['meta_title']   = $form_data['meta_title'];
	    	$arr_data['meta_keyword'] = $form_data['meta_keyword'];
	    	$arr_data['meta_desc']    = $form_data['meta_desc'];
            
	    	$update_data = $this->StaticPagesModel->where('id',$page_id)->update($arr_data);

	    	if($update_data)
	    	{
	    		Flash::success('Page Updated Successfully.');
	    	}
	    	else
	    	{
	    		Flash::error('Problem Occured, While Updating Page.');
	    	}

	    }

	    return redirect()->back();
    }

    public function delete($enc_id=FALSE)
    {

        if($enc_id)
        {
            $page_id = base64_decode($enc_id);

            $result = $this->StaticPagesModel->where('id',$page_id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_info = $result->delete();

                if($result_info)
                {
                    Flash::success('Page Deleted Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deleting Page.');
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

    public function activate($enc_id=FALSE)
    {
        if($enc_id)
        {
            $page_id = base64_decode($enc_id);

            $result  = $this->StaticPagesModel->where('id',$page_id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['page_status'=>'1']);

                if($result_status)
                {
                    Flash::success('Page Activated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Activating Page Status.');
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
        if($enc_id)
        {
            $page_id = base64_decode($enc_id);

            $result  = $this->StaticPagesModel->where('id',$page_id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['page_status'=>'0']);

                if($result_status)
                {
                    Flash::success('Page Deactivated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deactivating Page Status.');
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
       
        $arr_rules                     = array();
        $arr_rules['multi_action']     = 'required';
        $arr_rules['checked_record']   = 'required';

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
               $result = $this->StaticPagesModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_info = $result->delete();

                    if($result_info)
                    {
               
                        Flash::success('Static Page(s) Deleted Successfully'); 
                    }
                }        
            } 
            elseif($multi_action=="activate")
            {

                $result = $this->StaticPagesModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['page_status'=>'1']);

                    if($result_status)
                    { 
                        Flash::success('Static Page(s) Activated Successfully'); 
                    }
                }        
            }
            elseif($multi_action=="deactivate")
            {
                $result = $this->StaticPagesModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['page_status'=>'0']);

                    if($result_status)
                    {  
                        Flash::success('Static Page(s) Blocked Successfully');  
                    }
                }        
            }
        }

        return redirect()->back();
    }
}
