<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CMSCategoryModel;
use App\Models\CMSSubCategoryModel;
use App\Models\CmsCategoryDetailsModel;
use App\Models\CmsSubCategoryDetailsModel;
use App\Models\CmsQuestionAnswerModel;

use Flash;
use Validator;

class CMSPagesController extends Controller
{
    public function __construct()
    {
        $this->CMSCategoryModel           = new CMSCategoryModel();
        $this->CMSSubCategoryModel        = new CMSSubCategoryModel();
        $this->CmsCategoryDetailsModel    = new CmsCategoryDetailsModel();
        $this->CmsSubCategoryDetailsModel = new CmsSubCategoryDetailsModel();
        $this->CmsQuestionAnswerModel     = new CmsQuestionAnswerModel();


        $this->arr_view_data                         = [];
        $this->module_url_path                       = url(config('app.project.admin_panel_slug')."/cms_pages");
        $this->module_title                          = "What We Treat";
        $this->module_view_folder                    = "admin.cms_pages";
        $this->category_view_folder                  = "admin.cms_pages.category";
        $this->category_details_view_folder          = "admin.cms_pages.category_details";
        $this->sub_category_details_view_folder      = "admin.cms_pages.sub_category_details";

        $this->sub_category_view_folder              = "admin.cms_pages.sub_category";
        $this->admin_panel_slug                      = config('app.project.admin_panel_slug');
        $this->what_we_treat_category_public_path    = url('/').config('app.img_path.what_we_treat_category');
        $this->what_we_treat_category_base_path      = base_path().config('app.img_path.what_we_treat_category');
        $this->what_we_treat_subcategory_public_path = url('/').config('app.img_path.what_we_treat_subcategory');
        $this->what_we_treat_subcategory_base_path   = base_path().config('app.img_path.what_we_treat_subcategory');
        $this->default_img_path                      = url('/').config('app.img_path.default_img_path');
    }

    /*---------------------------------------------------------------------------------------------
							 Category Section Start
	---------------------------------------------------------------------------------------------*/

    public function category()
    {
    	$arr_category = [];
    	$obj_category = $this->CMSCategoryModel->with('details')->orderBy('id','desc')->get();
    	if($obj_category)
    	{
    		$arr_category = $obj_category->toArray();
    	}

    	$this->arr_view_data['arr_category']    = $arr_category;
    	$this->arr_view_data['module_url_path'] = $this->module_url_path;
		$this->arr_view_data['module_title']    = 'Manage '.str_singular($this->module_title).' Category';
		$this->arr_view_data['page_title'] 		= 'Manage '.str_singular($this->module_title).' Category';
    	return view($this->category_view_folder.'/index',$this->arr_view_data);
    }

    public function create_category()
    {
    	$this->arr_view_data['module_url_path'] = $this->module_url_path;
		$this->arr_view_data['module_title']    = 'Manage '.str_singular($this->module_title).' Category';
		$this->arr_view_data['page_title'] 		= 'Add '.str_singular($this->module_title).' Category';
    	return view($this->category_view_folder.'/create',$this->arr_view_data);
    }

    public function store_category(Request $request)
    {
    	$arr_rules = [];
    	$arr_rules['category_name'] = 'required';
    	$validator = Validator::make($request->all(),$arr_rules);
    	if($validator->fails())
    	{
    		return back()->withErrors($validator)->withInput();
    	}

    	$category_name = trim($request->input('category_name'));
    	$category_slug = str_slug($category_name);

    	$is_exist = $this->CMSCategoryModel->where('slug','=',$category_slug)->count();
    	if($is_exist)
    	{
    		Flash::error($this->module_title.' Category already exist.');
    		return redirect()->back();
    	}

        if($request->hasFile('image'))
        {
            $fileName = $request->input('image');
            $image = $request->file('image');

            $file_extension = strtolower($image->getClientOriginalExtension());
            $fileName = sha1(uniqid().$image.uniqid()).'.'.$file_extension;

            if($image->isValid() && in_array($file_extension,['png','jpg','jpeg']))
            { 
                $fileExtension     = strtolower($image->getClientOriginalExtension());
                $enc_image         = sha1(uniqid().$image.uniqid()).'.'.$fileExtension;     
                $upload            = $image->move($this->what_we_treat_category_base_path,$enc_image);        

                $arr_data['image'] = $enc_image;
            }
            else
            {
                Session::flash('error',$fileName.' Invalid file extension.');
                return response()->json($return_arr);
            }    
        } 


    	$arr_data['name'] = encrypt_value($category_name);
    	$arr_data['slug'] = $category_slug;

    	$status = $this->CMSCategoryModel->create($arr_data);
    	if($status)
    	{
    		Flash::success($this->module_title.' Category store successfully.');
    		return redirect()->back();
    	}	
    	else
    	{
    		Flash::success('Problem occur while,adding category for '.$this->module_title);
    		return redirect()->back();
    	}
    }

    public function edit_category($enc_id=FALSE)
	{
		$arr_category = [];
		if($enc_id!='')
		{
			$id = base64_decode($enc_id);
			$obj_category = $this->CMSCategoryModel->where('id','=',$id)->first();
			if($obj_category)
			{
				$arr_category = $obj_category->toArray();
			}


            $this->arr_view_data['arr_category']         = $arr_category;
            $this->arr_view_data['module_url_path']      = $this->module_url_path;
            $this->arr_view_data['module_title']         = 'Manage '.str_singular($this->module_title).' category';
            $this->arr_view_data['page_title']           = 'Edit category';

            $this->arr_view_data['category_public_path'] = $this->what_we_treat_category_public_path;
            $this->arr_view_data['category_base_path']   = $this->what_we_treat_category_base_path;
            $this->arr_view_data['default_img_path']     = $this->default_img_path;

	    	return view($this->category_view_folder.'/edit',$this->arr_view_data);
		}
		else
		{
			Flash::error('Sorry, Invalid Request.');
			return redirect()->back();
		}
	}

	public function update_category(Request $request,$enc_id='')
	{
		$arr_rules = [];
    	$arr_rules['category_name'] = 'required';
    	$validator = Validator::make($request->all(),$arr_rules);
    	if($validator->fails())
    	{
    		return back()->withErrors($validator)->withInput();
    	}

    	$id = base64_decode($enc_id);
    	$category_name = trim($request->input('category_name'));
    	$category_slug = str_slug($category_name);

    	$is_exist = $this->CMSCategoryModel->where('slug','=',$category_slug)
    									   ->where('id','<>',$id)
    										->count();
    	if($is_exist)
    	{
    		Flash::error($this->module_title.' Category already exist.');
    		return redirect()->back();
    	}

        if($request->hasFile('image'))
        {
            $fileName = $request->input('image');
            $image = $request->file('image');
            $oldimage   = $request->input('oldimage');

            $file_extension = strtolower($image->getClientOriginalExtension());
            $fileName = sha1(uniqid().$image.uniqid()).'.'.$file_extension;

            if($image->isValid() && in_array($file_extension,['png','jpg','jpeg']))
            { 
                $fileExtension     = strtolower($image->getClientOriginalExtension());
                $enc_image         = sha1(uniqid().$image.uniqid()).'.'.$fileExtension;
                $upload            = $image->move($this->what_we_treat_category_base_path,$enc_image);
                $arr_data['image'] = $enc_image;
                if($upload)
                {
                    if(isset($oldimage) && $oldimage!=null)
                    {
                        $image         = $this->what_we_treat_category_base_path.'/'.$oldimage;
                        if(file_exists($image))
                        {
                            unlink($image);
                        }
                    }
                }
            }
            else
            {
                Session::flash('error',$fileName.' Invalid file extension.');
                return response()->json($return_arr);
            }    
        } 

    	$arr_data['name'] = encrypt_value($category_name);

    	$status = $this->CMSCategoryModel->where('id','=',$id)->update($arr_data);
    	if($status)
    	{
    		Flash::success($this->module_title.' Category updated successfully.');
    		return redirect()->back();
    	}	
    	else
    	{
    		Flash::success('Problem occur while,updating category for '.$this->module_title);
    		return redirect()->back();
    	}
	}

	public function activate_category($enc_id=FALSE)
	{
		if($enc_id!='')
		{
			$id = base64_decode($enc_id);
            $info = $this->CMSCategoryModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->CMSCategoryModel->where('id',$id)->update(['status'=>'1']);
                if($update_result)
                {
                    Flash::success($this->module_title.' category activated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While activating '.$this->module_title.' category.');
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

	public function deactivate_category($enc_id=FALSE)
	{
		if($enc_id!='')
		{
			$id = base64_decode($enc_id);
            $info = $this->CMSCategoryModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->CMSCategoryModel->where('id',$id)->update(['status'=>'0']);
                if($update_result)
                {
                    Flash::success($this->module_title.' category blocked Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While blocked '.$this->module_title.' category.');
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

	public function multi_action_category(Request $request)
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
        
                $delete_data = $this->CMSCategoryModel->where('id',$record_id)->delete();
                if($delete_data)
                {
                    Flash::success($this->module_title.' category Deleted Successfully');        
                } 
        
            }
            elseif($multi_action=="activate")
            {

                $result = $this->CMSCategoryModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'1']);

                    if($result_status)
                    { 
                        Flash::success($this->module_title.' category Activated Successfully'); 
                    }
                }        
            }
            elseif($multi_action=="deactivate")
            {
                   
                $result = $this->CMSCategoryModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'0']);

                    if($result_status)
                    {  
                        Flash::success($this->module_title.' category Blocked Successfully');  
                    }
                }        
            }
        }

        return redirect()->back();    
	}

	/*---------------------------------------------------------------------------------------------
							Sub Category Section Start
	---------------------------------------------------------------------------------------------*/
    public function sub_category()
    {
    	$arr_subcategory = [];
    	$obj_subcategory = $this->CMSSubCategoryModel->select('id','category_id','name','status')                                         ->with(['category_details'=>function($qry){
    														$qry->select('id','name');
    													}])->orderBy('id','desc')->get();
    	if($obj_subcategory)
    	{
    		$arr_subcategory = $obj_subcategory->toArray();
    	}


    	$this->arr_view_data['arr_subcategory'] = $arr_subcategory;
    	$this->arr_view_data['module_url_path'] = $this->module_url_path;
		$this->arr_view_data['module_title']    = 'Manage '.str_singular($this->module_title).' Subcategory';
		$this->arr_view_data['page_title'] 		= 'Manage '.str_singular($this->module_title).' Subcategory';
    	return view($this->sub_category_view_folder.'/index',$this->arr_view_data);
    }

    public function create_sub_category()
    {
    	$arr_category = [];
    	$obj_category = $this->CMSCategoryModel->where('status','=','1')->get();
    	if($obj_category)
    	{
    		$arr_category = $obj_category->toArray();
    	}

    	$this->arr_view_data['arr_category'] 	= $arr_category;
    	$this->arr_view_data['module_url_path'] = $this->module_url_path;
		$this->arr_view_data['module_title']    = 'Manage '.str_singular($this->module_title).' Subcategory';
		$this->arr_view_data['page_title'] 		= 'Add '.str_singular($this->module_title).' Subcategory';
    	return view($this->sub_category_view_folder.'/create',$this->arr_view_data);
    }

    public function store_sub_category(Request $request)
    {
    	$arr_rules                      = [];

    	$arr_rules['category_id']       = 'required';
    	$arr_rules['sub_category_name'] = 'required';

    	$validator = Validator::make($request->all(),$arr_rules);
    	if($validator->fails())
    	{
    		return back()->withErrors($validator)->withInput();
    	}

    	$category_id 	     = trim($request->input('category_id'));
    	$obj_category       = $this->CMSCategoryModel->select('name')->where('id','=',$category_id)->first();
    	$category_name = isset($obj_category->name)?decrypt_value($obj_category->name):'';

    	$sub_category_name   = trim($request->input('sub_category_name'));
        //$sub_category_slug   = str_slug($category_name.' '.$sub_category_name);
    	$sub_category_slug   = str_slug($sub_category_name);
    	

    	$is_exist = $this->CMSSubCategoryModel->where('slug','=',$sub_category_slug)
    										  ->where('category_id','=',$category_id)
    										  ->count();
    	if($is_exist)
    	{
    		Flash::error($this->module_title.' Subcategory already exist.');
    		return redirect()->back();
    	}

        if($request->hasFile('image'))
        {
            $fileName = $request->input('image');
            $image = $request->file('image');

            $file_extension = strtolower($image->getClientOriginalExtension());
            $fileName = sha1(uniqid().$image.uniqid()).'.'.$file_extension;

            if($image->isValid() && in_array($file_extension,['png','jpg','jpeg']))
            { 
                $fileExtension     = strtolower($image->getClientOriginalExtension());
                $enc_image         = sha1(uniqid().$image.uniqid()).'.'.$fileExtension;     
                $upload            = $image->move($this->what_we_treat_subcategory_base_path,$enc_image);        

                $arr_data['image'] = $enc_image;
            }
            else
            {
                Session::flash('error',$fileName.' Invalid file extension.');
                return response()->json($return_arr);
            }    
        } 

    	$arr_data['name']        = encrypt_value($sub_category_name);
    	$arr_data['slug']        = $sub_category_slug;
    	$arr_data['category_id'] = $category_id;

    	$status = $this->CMSSubCategoryModel->create($arr_data);
    	if($status)
    	{
    		Flash::success($this->module_title.' Subcategory store successfully.');
    		return redirect()->back();
    	}	
    	else
    	{
    		Flash::success('Problem occur while,adding subcategory for '.$this->module_title);
    		return redirect()->back();
    	}
    }

    public function edit_sub_category($enc_id=FALSE)
	{
		$arr_subcategory = $arr_category = [];
		if($enc_id!='')
		{
			$id = base64_decode($enc_id);
			$obj_subcategory = $this->CMSSubCategoryModel->where('id','=',$id)->first();
			if($obj_subcategory)
			{
				$arr_subcategory = $obj_subcategory->toArray();
			}

	    	$obj_category = $this->CMSCategoryModel->where('status','=','1')->get();
	    	if($obj_category)
	    	{
	    		$arr_category = $obj_category->toArray();
	    	}

			$this->arr_view_data['arr_category'] 	= $arr_category;
			$this->arr_view_data['arr_subcategory'] = $arr_subcategory;
			$this->arr_view_data['module_url_path'] = $this->module_url_path;
			$this->arr_view_data['module_title']    = 'Manage '.str_singular($this->module_title).' Subcategory';
			$this->arr_view_data['page_title'] 		= 'Edit Subcategory';


            $this->arr_view_data['sub_category_public_path'] = $this->what_we_treat_subcategory_public_path;
            $this->arr_view_data['sub_category_base_path']   = $this->what_we_treat_subcategory_base_path;
            $this->arr_view_data['default_img_path']     = $this->default_img_path;

	    	return view($this->sub_category_view_folder.'/edit',$this->arr_view_data);
		}
		else
		{
			Flash::error('Sorry, Invalid Request.');
			return redirect()->back();
		}
	}

	public function update_sub_category(Request $request,$enc_id='')
	{
		$arr_rules                      = [];
		$arr_rules['category_id']       = 'required';
		$arr_rules['sub_category_name'] = 'required';

    	$validator = Validator::make($request->all(),$arr_rules);
    	if($validator->fails())
    	{
    		return back()->withErrors($validator)->withInput();
    	}

        $category_id       = trim($request->input('category_id'));

        $obj_category       = $this->CMSCategoryModel->select('name')->where('id','=',$category_id)->first();
        $category_name = isset($obj_category->name)?decrypt_value($obj_category->name):'';

    	$id                = base64_decode($enc_id);
    	$sub_category_name = trim($request->input('sub_category_name'));
       // $sub_category_slug = str_slug($category_name.' '.$sub_category_name);
    	$sub_category_slug = str_slug($sub_category_name);


    	$is_exist = $this->CMSSubCategoryModel->where('slug','=',$sub_category_slug)
    										  ->where('category_id','<>',$category_id)
    									      ->where('id','<>',$id)
    										  ->count();
    	if($is_exist)
    	{
    		Flash::error($this->module_title.' Subcategory already exist.');
    		return redirect()->back();
    	}

        if($request->hasFile('image'))
        {
            $fileName = $request->input('image');
            $image = $request->file('image');
            $oldimage   = $request->input('oldimage');

            $file_extension = strtolower($image->getClientOriginalExtension());
            $fileName = sha1(uniqid().$image.uniqid()).'.'.$file_extension;

            if($image->isValid() && in_array($file_extension,['png','jpg','jpeg']))
            { 
                $fileExtension     = strtolower($image->getClientOriginalExtension());
                $enc_image         = sha1(uniqid().$image.uniqid()).'.'.$fileExtension;
                $upload            = $image->move($this->what_we_treat_subcategory_base_path,$enc_image);
                $arr_data['image'] = $enc_image;
                if($upload)
                {
                    if(isset($oldimage) && $oldimage!=null)
                    {
                        $image         = $this->what_we_treat_subcategory_base_path.'/'.$oldimage;
                        if(file_exists($image))
                        {
                            unlink($image);
                        }
                    }
                }
            }
            else
            {
                Session::flash('error',$fileName.' Invalid file extension.');
                return response()->json($return_arr);
            }    
        } 

    	$arr_data['name'] = encrypt_value($sub_category_name);
    	$arr_data['category_id'] = $category_id;

    	$status = $this->CMSSubCategoryModel->where('id','=',$id)->update($arr_data);
    	if($status)
    	{
    		Flash::success($this->module_title.' Subcategory updated successfully.');
    		return redirect()->back();
    	}	
    	else
    	{
    		Flash::success('Problem occur while,updating subcategory for '.$this->module_title);
    		return redirect()->back();
    	}
	}

    public function activate_sub_category($enc_id=FALSE)
	{
		if($enc_id!='')
		{
			$id = base64_decode($enc_id);
            $info = $this->CMSSubCategoryModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->CMSSubCategoryModel->where('id',$id)->update(['status'=>'1']);
                if($update_result)
                {
                    Flash::success($this->module_title.' subcategory activated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While activating '.$this->module_title.' subcategory.');
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

	public function deactivate_sub_category($enc_id=FALSE)
	{
		if($enc_id!='')
		{
			$id = base64_decode($enc_id);
            $info = $this->CMSSubCategoryModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->CMSSubCategoryModel->where('id',$id)->update(['status'=>'0']);
                if($update_result)
                {
                    Flash::success($this->module_title.' subcategory blocked Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While blocked '.$this->module_title.' subcategory.');
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

	public function multi_action_sub_category(Request $request)
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
        
                $delete_data = $this->CMSSubCategoryModel->where('id',$record_id)->delete();
                if($delete_data)
                {
                    Flash::success($this->module_title.' subcategory Deleted Successfully');        
                } 
        
            }
            elseif($multi_action=="activate")
            {

                $result = $this->CMSSubCategoryModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'1']);

                    if($result_status)
                    { 
                        Flash::success($this->module_title.' subcategory Activated Successfully'); 
                    }
                }        
            }
            elseif($multi_action=="deactivate")
            {
                   
                $result = $this->CMSSubCategoryModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'0']);

                    if($result_status)
                    {  
                        Flash::success($this->module_title.' subcategory Blocked Successfully');  
                    }
                }        
            }
        }

        return redirect()->back();    
	}

    /*--------------------------------Category Details---------------------------------*/

    public function category_details()
    {
        $arr_category_details = [];
        $obj_category_details = $this->CmsCategoryDetailsModel->with('category_details')->orderBy('id','desc')->get();
        if($obj_category_details)
        {
            $arr_category_details = $obj_category_details->toArray();
        }

        $this->arr_view_data['arr_category_details']    = $arr_category_details;

        $this->arr_view_data['module_url_path'] = $this->module_url_path.'/category_details';
        $this->arr_view_data['module_title']    = 'Manage '.str_singular($this->module_title).' Category Details';
        $this->arr_view_data['page_title']      = 'Manage '.str_singular($this->module_title).' Category Details';
        return view($this->category_details_view_folder.'/index',$this->arr_view_data);
    }

    public function create_category_details()
    {
        $arr_category = [];
        $obj_category = $this->CMSCategoryModel->where('status','=','1')->get();
        if($obj_category)
        {
            $arr_category = $obj_category->toArray();
        }

        $this->arr_view_data['arr_category']    = $arr_category;
        $this->arr_view_data['module_url_path'] = $this->module_url_path.'/category_details';
        $this->arr_view_data['category_url_path'] = $this->module_url_path.'/category';
        $this->arr_view_data['category_module_title'] = 'Manage Categories';
        $this->arr_view_data['module_title']    = 'Manage Category Details';
        $this->arr_view_data['page_title']      = 'Add Category Details';
        return view($this->category_details_view_folder.'/create',$this->arr_view_data);
    }

    public function store_category_details(Request $request)
    {
        $arr_rules                         = [];
        $arr_rules['category_id']          = 'required';
        $arr_rules['meta_title']           = 'required';
        $arr_rules['meta_keyword']         = 'required';
        $arr_rules['meta_desc']            = 'required';
        /*$arr_rules['common']               = 'required';
        $arr_rules['symptoms']             = 'required';
        $arr_rules['causes']               = 'required';
        $arr_rules['treatment_prevention'] = 'required';*/
        $arr_rules['is_investigation_details']       = 'required';
        /*$arr_rules['description']          = 'required';*/

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $category_id = trim($request->input('category_id'));
        $is_exist = $this->CmsCategoryDetailsModel->where('category_id','=',$category_id)
                                                  ->get();
        if(count($is_exist)>0)
        {
            Flash::error('Category details Already exist for selected category.');
            return redirect()->back();
        }

        $arr_data['category_id']          = $category_id;
        $arr_data['meta_title']           = encrypt_value(trim($request->input('meta_title'),''));
        $arr_data['meta_keyword']         = encrypt_value(trim($request->input('meta_keyword'),''));
        $arr_data['meta_desc']            = encrypt_value(trim($request->input('meta_desc'),''));
        $arr_data['common']               = encrypt_value(trim($request->input('common'),''));
        $arr_data['symptoms']             = encrypt_value(trim($request->input('symptoms'),''));
        $arr_data['causes']               = encrypt_value(trim($request->input('causes'),''));
        $arr_data['treatment_prevention'] = encrypt_value(trim($request->input('treatment_prevention'),''));
        $arr_data['is_investigation_details']       = trim($request->input('is_investigation_details'));
        $arr_data['description']          = encrypt_value(trim($request->input('description'),''));

        $status = $this->CmsCategoryDetailsModel->create($arr_data);
        if($status)
        {
             Flash::success('Category details added successfully.');
        }
        else
        {
            Flash::error('Problem occur while,adding category details.');
        }

        return redirect()->back();
    }

    public function edit_category_details($enc_id)
    {
        if($enc_id)
        {
            $arr_category_details = [];

            $arr_category = [];
            $obj_category = $this->CMSCategoryModel->where('status','=','1')->get();
            if($obj_category)
            {
                $arr_category = $obj_category->toArray();
            }

            $this->arr_view_data['arr_category']    = $arr_category;

            $category_details_id = base64_decode($enc_id);
            $obj_category_details = $this->CmsCategoryDetailsModel->where('id','=',$category_details_id)
                                                                  ->first();
            if($obj_category_details)
            {
                $arr_category_details = $obj_category_details->toArray();
            }

            $this->arr_view_data['enc_id']               = $enc_id;
            $this->arr_view_data['arr_category_details'] = $arr_category_details;
            $this->arr_view_data['module_url_path']      = $this->module_url_path.'/category_details';
            $this->arr_view_data['module_title']         = "Manage Category Details";
            $this->arr_view_data['page_title']           = "Edit Category Details";
            $this->arr_view_data['category_url_path'] = $this->module_url_path.'/category';
            $this->arr_view_data['category_module_title'] = 'Manage Categories';
            return view($this->category_details_view_folder.'/edit',$this->arr_view_data);

        }
        else
        {
            return redirect()->back();
        }
    }

    public function update_category_details(Request $request,$enc_id)
    {
        if($enc_id)
        {
            $arr_rules                         = [];
            $arr_rules['meta_title']           = 'required';
            $arr_rules['meta_keyword']         = 'required';
            $arr_rules['meta_desc']            = 'required';
           /* $arr_rules['common']               = 'required';
            $arr_rules['symptoms']             = 'required';
            $arr_rules['causes']               = 'required';
            $arr_rules['treatment_prevention'] = 'required';*/
            $arr_rules['is_investigation_details']       = 'required';

            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                return back()->withErrors($validator)->withInput();
            }

            $arr_data['meta_title']           = encrypt_value(trim($request->input('meta_title'),''));
            $arr_data['meta_keyword']         = encrypt_value(trim($request->input('meta_keyword'),''));
            $arr_data['meta_desc']            = encrypt_value(trim($request->input('meta_desc'),''));
            $arr_data['common']               = encrypt_value(trim($request->input('common'),''));
            $arr_data['symptoms']             = encrypt_value(trim($request->input('symptoms'),''));
            $arr_data['causes']               = encrypt_value(trim($request->input('causes'),''));
            $arr_data['treatment_prevention'] = encrypt_value(trim($request->input('treatment_prevention'),''));
            $arr_data['is_investigation_details']       = trim($request->input('is_investigation_details'));
            $arr_data['description']          = encrypt_value(trim($request->input('description'),''));
            
            $id = base64_decode($enc_id);
            $status = $this->CmsCategoryDetailsModel->where('id','=',$id)->update($arr_data);
            if($status)
            {
                 Flash::success('Category details updated successfully.');
            }
            else
            {
                Flash::error('Problem occur while,updating category details.');
            }
            return redirect()->back();
        }
        else
        {
            Flash::error('Something went wrong.Please try again.');
            return redirect()->back();
        }
    }

    /*-------------------------------Sub Category Details--------------------------------*/

    public function old_sub_category_details()
    {
        $arr_sub_category_details = [];
        $obj_sub_category_details = $this->CmsSubCategoryDetailsModel->with('category_details','sub_category_details')->orderBy('id','desc')->get();
        if($obj_sub_category_details)
        {
            $arr_sub_category_details = $obj_sub_category_details->toArray();
        }

        $this->arr_view_data['arr_sub_category_details']    = $arr_sub_category_details;

        $this->arr_view_data['module_url_path'] = $this->module_url_path.'/sub_category_details';
        $this->arr_view_data['module_title']    = 'Manage '.str_singular($this->module_title).' Sub Category Details';
        $this->arr_view_data['page_title']      = 'Manage '.str_singular($this->module_title).' Sub Category Details';
        return view($this->sub_category_details_view_folder.'/index',$this->arr_view_data);
    }

    public function sub_category_details()
    {
        $arr_sub_category_details = [];
        $obj_sub_category_details = $this->CmsSubCategoryDetailsModel->with('category_details','sub_category_details')
            ->groupBy('sub_category_id')
            //->orderBy('id','desc')
            ->get();
        if($obj_sub_category_details)
        {
            $arr_sub_category_details = $obj_sub_category_details->toArray();
        }

        $this->arr_view_data['arr_sub_category_details']    = $arr_sub_category_details;

        $this->arr_view_data['module_url_path'] = $this->module_url_path.'/sub_category_details';
        $this->arr_view_data['module_title']    = 'Manage '.str_singular($this->module_title).' Sub Category Details';
        $this->arr_view_data['page_title']      = 'Manage '.str_singular($this->module_title).' Sub Category Details';
        return view($this->sub_category_details_view_folder.'/index',$this->arr_view_data);
    }

    public function create_sub_category_details()
    {
        $arr_category = [];
        $obj_category = $this->CMSCategoryModel->where('status','=','1')->get();
        if($obj_category)
        {
            $arr_category = $obj_category->toArray();
        }

        $this->arr_view_data['arr_category']    = $arr_category;
        $this->arr_view_data['module_url_path'] = $this->module_url_path.'/sub_category_details';
        $this->arr_view_data['module_title']    = 'Manage Sub Category Details';
        $this->arr_view_data['page_title']      = 'Add Sub Category Details';
        return view($this->sub_category_details_view_folder.'/create',$this->arr_view_data);
    }

    public function store_sub_category_details(Request $request)
    {
        $arr_rules = $question = $answer = [];
        $tab_name = $tab_slug = '';

        $arr_rules['category_id']              = 'required';
        $arr_rules['sub_category_id']          = 'required';
        $arr_rules['meta_title']               = 'required';
        $arr_rules['meta_keyword']             = 'required';
        $arr_rules['meta_desc']                = 'required';
        $arr_rules['is_investigation_details'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $category_id              = trim($request->input('category_id'));
        $sub_category_id          = trim($request->input('sub_category_id'));
        $question                 = $request->input('question');
        $answer                   = $request->input('answer');
        $tab_name                 = trim($request->input('tab'));
        $tab_slug                 = isset($tab_name)?str_slug($tab_name):'';
        $is_investigation_details = trim($request->input('is_investigation_details'));

        if($is_investigation_details=='No')
        {
            $is_exist = $this->CmsSubCategoryDetailsModel
                                        ->where('category_id','=',$category_id)
                                        ->where('sub_category_id','=',$sub_category_id)
                                        ->count();
                            
            if($is_exist>0)
            {
                Flash::error('Sub Category details already exist.');
                return redirect()->back();
            }
        }

        
        if($is_investigation_details=='Yes')
        {
            $is_exist = $this->CmsSubCategoryDetailsModel
                                        ->where('category_id','=',$category_id)
                                        ->where('sub_category_id','=',$sub_category_id)
                                        ->where('is_investigation_details','=','No')
                                        ->count();
                            
            if($is_exist>0)
            {
                Flash::error('Sub Category details already exist.');
                return redirect()->back();
            }

            if(isset($tab_slug) && $tab_slug!='')
            {
                $is_exist = $this->CmsSubCategoryDetailsModel
                                            ->where('category_id','=',$category_id)
                                            ->where('sub_category_id','=',$sub_category_id)
                                            ->where('tab_slug','=',$tab_slug)
                                            ->count();
                                
                if($is_exist>0)
                {
                    Flash::error('Sub Category details already exist.');
                    return redirect()->back();
                }
            }
        }

        if($is_exist > 0)
        {
            Flash::error('Sub Category details already exist.');
            return redirect()->back();
        }
                                                     
        $arr_data['category_id']              = $category_id;
        $arr_data['sub_category_id']          = $sub_category_id;
        $arr_data['meta_title']               = trim($request->input('meta_title'),'');
        $arr_data['meta_keyword']             = trim($request->input('meta_keyword'),'');
        $arr_data['meta_desc']                = trim($request->input('meta_desc'),'');
        $arr_data['tab_name']                 = $tab_name;
        $arr_data['tab_slug']                 = $tab_slug;
        $arr_data['is_investigation_details'] = $is_investigation_details;

        $status = $this->CmsSubCategoryDetailsModel->create($arr_data);
        if($status)
        {
            foreach ($question as $question_key => $question_value) 
            {
                $question_arr = [];
                
                $question_arr['sub_category_details_id'] = $status->id;
                $question_arr['question']                = $question_value;
                $question_arr['answer']                  = $answer[$question_key];

                $this->CmsQuestionAnswerModel->create($question_arr);
            }
            
            Flash::success('Sub Category details added successfully.');
            return redirect()->back();
        }
        else
        {
            Flash::error('Problem occur while,adding sub category details.');
            return redirect()->back();
        }
       
        return redirect()->back();
    }

    public function get_subcategory(Request $request)
    {
        $arr_subcategory = [];
        $category_id = $request->input('category_id');
        $obj_subcategory = $this->CMSSubCategoryModel->select('id','name')
                                                     ->where('category_id','=',$category_id)
                                                     ->where('status','=','1')
                                                     ->get();
        if($obj_subcategory)
        {
            $arr_subcategory = $obj_subcategory->toArray();
        }

        $option = '<option value="">Select Sub category</option>'; 
        if(isset($arr_subcategory) && sizeof($arr_subcategory)>0)
        {
            foreach ($arr_subcategory as $key => $value) 
            {
                $option.='<option value="'.$value['id'].'">'.decrypt_value($value['name']).'</option>';
            }
        }

        return $option;
    }	

    public function edit_sub_category_details($enc_id)
    {
        if($enc_id)
        {
            $arr_sub_category_details = $arr_category = [];
            $sub_category_details_id = base64_decode($enc_id);
    
            $obj_category = $this->CMSCategoryModel->where('status','=','1')->get();
            if($obj_category)
            {
                $arr_category = $obj_category->toArray();
            }

            $this->arr_view_data['arr_category']    = $arr_category;

            
            $obj_sub_category_details = $this->CmsSubCategoryDetailsModel->with(['get_question_answer','category_details','sub_category_details'])
                                                                         ->where('id','=',$sub_category_details_id)
                                                                         ->first();
            if($obj_sub_category_details)
            {
                $arr_sub_category_details = $obj_sub_category_details->toArray();
            }

            //dd($arr_sub_category_details);

            $this->arr_view_data['enc_id']               = $enc_id;
            $this->arr_view_data['arr_sub_category_details'] = $arr_sub_category_details;
            $this->arr_view_data['module_url_path']      = $this->module_url_path.'/sub_category_details';
            $this->arr_view_data['module_title']         = "Manage Category Details";
            $this->arr_view_data['page_title']           = "Edit Category Details";
            return view($this->sub_category_details_view_folder.'/edit',$this->arr_view_data);

        }
        else
        {
            return redirect()->back();
        }
    }

    public function view_investigation_details($category_id,$sub_category_id)
    {
        $arr_sub_category_details = [];

        $category_id   = base64_decode($category_id);
        $sub_category_id   = base64_decode($sub_category_id);
        $obj_sub_category_details = $this->CmsSubCategoryDetailsModel->with('category_details','sub_category_details')
            ->where('category_id',$category_id)
            ->where('sub_category_id',$sub_category_id)
            ->orderBy('id','desc')
            ->get();
        if($obj_sub_category_details)
        {
            $arr_sub_category_details = $obj_sub_category_details->toArray();
        }

        $this->arr_view_data['arr_sub_category_details']    = $arr_sub_category_details;

        $this->arr_view_data['module_url_path'] = $this->module_url_path.'/sub_category_details';
        $this->arr_view_data['module_title']    = 'Manage '.str_singular($this->module_title).' Sub Category Details';
        $this->arr_view_data['page_title']      = 'Manage '.str_singular($this->module_title).' Sub Category Details';
        return view($this->sub_category_details_view_folder.'/investigation_details',$this->arr_view_data);
    }

    public function update_sub_category_details(Request $request)
    {
        $arr_rules = [];
        $arr_rules['meta_title']               = 'required';
        $arr_rules['meta_keyword']             = 'required';
        $arr_rules['meta_desc']                = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $sub_category_details_id = base64_decode($request->input('enc_id'));

        $arr_data['meta_title']   = trim($request->input('meta_title'),'');
        $arr_data['meta_keyword'] = trim($request->input('meta_keyword'),'');
        $arr_data['meta_desc']    = trim($request->input('meta_desc'),'');
        $question                 = $request->input('question');
        $answer                   = $request->input('answer');

        $status = $this->CmsSubCategoryDetailsModel->where('id','=',$sub_category_details_id)->update($arr_data);
        if($status)
        {
            $this->CmsQuestionAnswerModel->where('sub_category_details_id',$sub_category_details_id)->delete();
            foreach ($question as $question_key => $question_value) 
            {
                $question_arr = [];
                
                $question_arr['sub_category_details_id'] = $sub_category_details_id;
                $question_arr['question']                = $question_value;
                $question_arr['answer']                  = $answer[$question_key];

                $this->CmsQuestionAnswerModel->create($question_arr);
            }
            
            Flash::success('Sub Category details updated successfully.');
            return redirect()->back();
        }
        else
        {
            Flash::error('Problem occur while,updating sub category details.');
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function sub_category_details_delete($enc_id)
    {
        if($enc_id!='')
        {
            $id = base64_decode($enc_id);

            $status = $this->CmsSubCategoryDetailsModel->where('id','=',$id)->delete(); 
            if($status)
            {
                $this->CmsQuestionAnswerModel->where('sub_category_details_id','=',$id)->delete();
                Flash::success('Sub Category details delated successfully.');
                return redirect()->back();
            }
            else
            {   
                Flash::error('Problem occur while,delation sub category details.');
                return redirect()->back();
            }
        }
        return redirect()->back();
    }

    public function delete_tab($enc_id)
    {
        if($enc_id!='')
        {
            $id = base64_decode($enc_id);

            $status = $this->CmsSubCategoryDetailsModel->where('id','=',$id)->delete(); 
            if($status)
            {
                $this->CmsQuestionAnswerModel->where('sub_category_details_id','=',$id)->delete();
                Flash::success('Sub Category details delated successfully.');
                return redirect()->back();
            }
            else
            {   
                Flash::error('Problem occur while,delation sub category details.');
                return redirect()->back();
            }
        }
        return redirect()->back();
    }

   
}
