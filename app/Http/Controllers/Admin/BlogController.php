<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\BlogCategoryModel;
use App\Models\BlogModel;
use App\Models\BlogCommentsModel;
use App\Models\BlogCategoryDetailsModel;

use Validator;
use Flash;


class BlogController extends Controller
{
   	public function __construct()
   	{
   		$this->BlogCategoryModel          = new BlogCategoryModel();
        $this->BlogModel                  = new BlogModel();
        $this->BlogCommentsModel          = new BlogCommentsModel();
        $this->BlogCategoryDetailsModel        = new BlogCategoryDetailsModel();

   		$this->arr_view_data              = [];
        $this->module_url_path            = url(config('app.project.admin_panel_slug')."/blog");
        $this->module_title               = "Blog";
        $this->comment_module_title       = "Comment";
        $this->module_view_folder         = "admin.blog";
        $this->module_view_folder1        = "admin.blog.category";
        $this->module_view_folder2        = "admin.blog.comment";
        $this->admin_panel_slug           = config('app.project.admin_panel_slug');

        $this->blog_image_public_img_path = url('/').'/uploads/blog/';
        $this->blog_image_base_img_path   = base_path().'/uploads/blog/';
        $this->default_img_path           = url('/').config('app.img_path.default_img_path');
   	}

    /*---------------------------Category---------------------------------------*/

   	public function category()
   	{
        $arr_category = [];
        $obj_category = $this->BlogCategoryModel->orderBy('id','desc')->get();
        if($obj_category)
        {
            $arr_category = $obj_category->toArray();
        }
        $this->arr_view_data['arr_category']    = $arr_category;
   		$this->arr_view_data['module_url_path'] = $this->module_url_path;
		$this->arr_view_data['module_title']    = str_singular($this->module_title);
		$this->arr_view_data['page_title'] 		= 'Blog Category';
    	return view($this->module_view_folder1.'/index',$this->arr_view_data);
   	}

   	public function create_category()
   	{
   		$this->arr_view_data['module_url_path'] = $this->module_url_path;
		$this->arr_view_data['module_title']    = str_singular($this->module_title).' Category';
		$this->arr_view_data['page_title'] 		= 'Create Blog Category';
    	return view($this->module_view_folder1.'/create',$this->arr_view_data);
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

        $is_exist = $this->BlogCategoryModel->where('slug','=',$category_slug)->count();
        if($is_exist)
        {
            Flash::error($this->module_title.' Category already exist.');
            return redirect()->back();
        }

        $arr_data['name'] = encrypt_value($category_name);
        $arr_data['slug'] = $category_slug;

        $status = $this->BlogCategoryModel->create($arr_data);
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
            $obj_category = $this->BlogCategoryModel->where('id','=',$id)->first();
            if($obj_category)
            {
                $arr_category = $obj_category->toArray();
            }

            $this->arr_view_data['arr_category']    = $arr_category;
            $this->arr_view_data['module_url_path'] = $this->module_url_path;
            $this->arr_view_data['module_title']    = 'Manage '.str_singular($this->module_title).' category';
            $this->arr_view_data['page_title']      = 'Edit category';
            return view($this->module_view_folder1.'/edit',$this->arr_view_data);
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

        $is_exist = $this->BlogCategoryModel->where('slug','=',$category_slug)
                                           ->where('id','<>',$id)
                                            ->count();
        if($is_exist)
        {
            Flash::error($this->module_title.' Category already exist.');
            return redirect()->back();
        }

        $arr_data['name'] = encrypt_value($category_name);

        $status = $this->BlogCategoryModel->where('id','=',$id)->update($arr_data);
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
            $info = $this->BlogCategoryModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->BlogCategoryModel->where('id',$id)->update(['status'=>'1']);
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
            $info = $this->BlogCategoryModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->BlogCategoryModel->where('id',$id)->update(['status'=>'0']);
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
        
                $delete_data = $this->BlogCategoryModel->where('id',$record_id)->delete();
                if($delete_data)
                {
                    Flash::success($this->module_title.' category Deleted Successfully');        
                } 
        
            }
            elseif($multi_action=="activate")
            {

                $result = $this->BlogCategoryModel->where('id',$record_id)->first();

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
                   
                $result = $this->BlogCategoryModel->where('id',$record_id)->first();

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

    /*---------------------------End of Category---------------------------------------*/
    public function blog()
    {
        $arr_blog = [];
        $obj_blog = $this->BlogModel->select('id','title','short_description','description','posted_by','date','status')->with('category_details')->orderBy('id','desc')->get();
        if($obj_blog)
        {
            $arr_blog = $obj_blog->toArray();
        }

        $this->arr_view_data['arr_blog']        = $arr_blog;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = str_singular($this->module_title);
        $this->arr_view_data['page_title']      = 'Blog';
        return view($this->module_view_folder.'/index',$this->arr_view_data);
    }

    public function create()
    {
        $arr_category = [];
        $obj_category = $this->BlogCategoryModel->where('status','=','1')->get();
        if($obj_category)
        {
            $arr_category = $obj_category->toArray();
        }
        $this->arr_view_data['arr_category']               = $arr_category;
        $this->arr_view_data['module_url_path']            = $this->module_url_path;
        $this->arr_view_data['module_title']               = str_singular($this->module_title);
        $this->arr_view_data['page_title']                 = 'Create Blog';
        $this->arr_view_data['blog_image_public_img_path'] = $this->blog_image_public_img_path;
        $this->arr_view_data['blog_image_base_img_path']   = $this->blog_image_base_img_path;
        $this->arr_view_data['default_img_path']           = $this->default_img_path;

        return view($this->module_view_folder.'/create',$this->arr_view_data);
    }

    public function store(Request $request)
    {
        $arr_rules                 = [];
        $arr_rules['title']        = 'required';
        $arr_rules['category']     = 'required';
        $arr_rules['date']         = 'required';
        $arr_rules['posted_by']    = 'required';
        $arr_rules['meta_title']   = 'required';
        $arr_rules['meta_keyword'] = 'required';
        $arr_rules['meta_desc']    = 'required';
        $arr_rules['description']  = 'required';
        $arr_rules['blog_image']   = 'required';


        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $title    = trim($request->input('title'));
        $category =$request->input('category');
        $slug     = str_slug($title);

        $is_exist = $this->BlogModel->where('slug','=',$slug)
                                    //->where('category','=',$category)
                                    ->get();
        if(count($is_exist)>0)
        {
            Flash::error($this->module_title.' Already exist');
            return redirect()->back();
        }

        if($request->hasFile('blog_image'))
        {
            $fileName = $request->input('blog_image');
            $blog_image = $request->file('blog_image');

            $file_extension = strtolower($blog_image->getClientOriginalExtension());
            $fileName = sha1(uniqid().$blog_image.uniqid()).'.'.$file_extension;

            if($blog_image->isValid() && in_array($file_extension,['png','jpg','jpeg']))
            { 
                $fileExtension             = strtolower($blog_image->getClientOriginalExtension());
                $enc_blog_image         = sha1(uniqid().$blog_image.uniqid()).'.'.$fileExtension;     
                $upload                    = $blog_image->move($this->blog_image_base_img_path,$enc_blog_image);        

                $arr_data['image'] = $enc_blog_image;
            }
            else
            {
                Session::flash('error',$fileName.' Invalid file extension.');
                return response()->json($return_arr);
            }    
        } 

        $arr_data['title']        = encrypt_value($title);
        $arr_data['slug']         = $slug;
        $arr_data['date']         = date('Y-m-d',strtotime($request->input('date')));      
        $arr_data['posted_by']    = encrypt_value(trim($request->input('posted_by')));
        $arr_data['meta_title']   = encrypt_value(trim($request->input('meta_title')));
        $arr_data['meta_keyword'] = encrypt_value(trim($request->input('meta_keyword')));
        $arr_data['meta_desc']    = encrypt_value(trim($request->input('meta_desc')));
        $arr_data['description']  = encrypt_value(trim($request->input('description')));

        $status = $this->BlogModel->create($arr_data);
        if($status)
        {
            $blog_id = $status->id;
            if(isset($category) && sizeof($category)>0)
            {
                foreach ($category as $key => $value) 
                {
                    $arr_data['category_id'] = $value;
                    $arr_data['blog_id']   = $blog_id;
                    $this->BlogCategoryDetailsModel->create($arr_data);
                }
            }
            Flash::success($this->module_title.' added successfully.');
        }
        else
        {
            Flash::error('Problem occur while,adding '.$this->module_title);
        }

        return redirect()->back();
    }

    public function edit_blog($enc_id=FALSE)
    {
        if($enc_id)
        {
            $blog_details = [];
            $id = base64_decode($enc_id);
            $obj_blog = $this->BlogModel->with(['category_details'=>function($qry){
                                                        $qry->select('blog_id','category_id');
                                                }])
                                                ->where('id','=',$id)
                                                ->first();
            if($obj_blog)
            {
                $blog_details = $obj_blog->toArray();
            }

            $arr_blog_category = [];
            if(isset($blog_details['category_details']) && sizeof($blog_details['category_details'])>0)
            {
                foreach($blog_details['category_details'] as $key => $category)
                {
                    $arr_blog_category[$key]  = $category['category_id'];
                }
            }

            $arr_category = [];
            $obj_category = $this->BlogCategoryModel->where('status','=','1')->get();
            if($obj_category)
            {
                $arr_category = $obj_category->toArray();
            }

            $this->arr_view_data['arr_category']               = $arr_category;
            $this->arr_view_data['blog_details']               = $blog_details;
            $this->arr_view_data['arr_blog_category']          = $arr_blog_category;

            $this->arr_view_data['module_url_path']            = $this->module_url_path;
            $this->arr_view_data['module_title']               = str_singular($this->module_title);
            $this->arr_view_data['page_title']                 = 'Edit Blog';
            $this->arr_view_data['blog_image_public_img_path'] = $this->blog_image_public_img_path;
            $this->arr_view_data['blog_image_base_img_path']   = $this->blog_image_base_img_path;
            $this->arr_view_data['default_img_path']           = $this->default_img_path;

            return view($this->module_view_folder.'/edit',$this->arr_view_data);
        }
        else
        {
            Flash::error('Someting went wrong,Please try again.');
            return redirect()->back();
        }  
    }

    public function update_blog(Request $request,$enc_id='')
    {
        $arr_rules                 = [];
        $arr_rules['title']        = 'required';
        $arr_rules['category']     = 'required';
        $arr_rules['date']         = 'required';
        $arr_rules['posted_by']    = 'required';
        $arr_rules['meta_title']   = 'required';
        $arr_rules['meta_keyword'] = 'required';
        $arr_rules['meta_desc']    = 'required';
        $arr_rules['description']  = 'required';
        //$arr_rules['blog_image']   = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $id       = base64_decode($enc_id);
        $title    = trim($request->input('title'));
        $category = $request->input('category');
        $slug     = str_slug($title);

        $is_exist = $this->BlogModel->where('slug','=',$slug)
                                    //->where('category','=',$category)
                                    ->where('id','<>',$id)
                                    ->get();
        if(count($is_exist)>0)
        {
            Flash::error($this->module_title.' Already exist');
            return redirect()->back();
        }

        if($request->hasFile('blog_image'))
        {
            $fileName = $request->input('blog_image');
            $blog_image = $request->file('blog_image');
            $oldimage   = $request->input('oldimage');
            $file_extension = strtolower($blog_image->getClientOriginalExtension());
            $fileName = sha1(uniqid().$blog_image.uniqid()).'.'.$file_extension;

            if($blog_image->isValid() && in_array($file_extension,['png','jpg','jpeg']))
            { 
                $fileExtension             = strtolower($blog_image->getClientOriginalExtension());
                $enc_blog_image         = sha1(uniqid().$blog_image.uniqid()).'.'.$fileExtension;     
                $upload                    = $blog_image->move($this->blog_image_base_img_path,$enc_blog_image);        
                $arr_data['image'] = $enc_blog_image;
                if($upload)
                {
                    if(isset($oldimage) && $oldimage!=null)
                    {
                        $blog_image         = $this->blog_image_base_img_path.$oldimage;
                        if(file_exists($blog_image))
                        {
                            unlink($blog_image);
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

        $arr_data['title']        = encrypt_value($title);
        $arr_data['slug']         = $slug;
        //$arr_data['category']     = $category;
        $arr_data['date']         = date('Y-m-d',strtotime($request->input('date')));      
        $arr_data['posted_by']    = encrypt_value(trim($request->input('posted_by')));
        $arr_data['meta_title']   = encrypt_value(trim($request->input('meta_title')));
        $arr_data['meta_keyword'] = encrypt_value(trim($request->input('meta_keyword')));
        $arr_data['meta_desc']    = encrypt_value(trim($request->input('meta_desc')));
        $arr_data['description']  = encrypt_value(trim($request->input('description')));
        $status = $this->BlogModel->where('id','=',$id)->update($arr_data);
        if($status)
        {
            $this->BlogCategoryDetailsModel->where('blog_id','=',$id)->delete();
            if(isset($category) && sizeof($category)>0)
            {
                foreach ($category as $key => $value) 
                {
                    $blog_data['category_id'] = $value;
                    $blog_data['blog_id']   = $id;
                    $this->BlogCategoryDetailsModel->create($blog_data);
                }
            }

            Flash::success($this->module_title.' updated successfully.');
        }
        else
        {
            Flash::error('Problem occur while,update '.$this->module_title);
        }

        return redirect()->back();
    }

    public function activate_blog($enc_id=FALSE)
    {
        if($enc_id!='')
        {
            $id = base64_decode($enc_id);
            $info = $this->BlogModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->BlogModel->where('id',$id)->update(['status'=>'1']);
                if($update_result)
                {
                    Flash::success($this->module_title.' activated Successfully.');
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

        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

        return redirect()->back();
    }

    public function deactivate_blog($enc_id=FALSE)
    {
        if($enc_id!='')
        {
            $id = base64_decode($enc_id);
            $info = $this->BlogModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->BlogModel->where('id',$id)->update(['status'=>'0']);
                if($update_result)
                {
                    Flash::success($this->module_title.' blocked Successfully.');
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

    public function delete_blog($enc_id=FALSE)
    {
        $id = base64_decode($enc_id);
        $status = $this->BlogModel->where('id',$id)->delete();
        if($status)
        {
            Flash::success('Blog Deleted Successfully.');
        }
        else
        {
            Flash::error('Problem Occured, While Deleting blog.');
        }
        return redirect()->back();
    }

    public function multi_action_blog(Request $request)
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
        
                $delete_data = $this->BlogModel->where('id',$record_id)->delete();
                if($delete_data)
                {
                    Flash::success($this->module_title.' Deleted Successfully');        
                } 
        
            }
            elseif($multi_action=="activate")
            {

                $result = $this->BlogModel->where('id',$record_id)->first();

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
                   
                $result = $this->BlogModel->where('id',$record_id)->first();

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

    /*-----------------------------------Comments------------------------------------*/

    public function comment($enc_id=FALSE)
    {
        if($enc_id)
        {
            $arr_comments = [];
            $blog_id = base64_decode($enc_id);

            $obj_comments = $this->BlogCommentsModel->with('user_details')->where('blog_id','=',$blog_id)->orderBy('id','desc')->get();
            if($obj_comments)
            {
                $arr_comments = $obj_comments->toArray();
            }

            $this->arr_view_data['arr_comments']               = $arr_comments;

            $this->arr_view_data['module_url_path']            = $this->module_url_path;
            $this->arr_view_data['module_title']               = str_singular($this->module_title);
            $this->arr_view_data['page_title']                 = $this->comment_module_title;
            $this->arr_view_data['blog_image_public_img_path'] = $this->blog_image_public_img_path;
            $this->arr_view_data['blog_image_base_img_path']   = $this->blog_image_base_img_path;
            $this->arr_view_data['default_img_path']           = $this->default_img_path;
            $this->arr_view_data['enc_id']                     = $enc_id;

            return view($this->module_view_folder2.'/index',$this->arr_view_data);
        }
        else
        {
            Flash::error('Someting went wrong,Please try again.');
            return redirect()->back();
        }  
    }

    public function view_comment($enc_id=FALSE)
    {
        if($enc_id)
        {
            $arr_comments_details = [];
            $comment_id = base64_decode($enc_id);

            $obj_comments_details = $this->BlogCommentsModel->where('id','=',$comment_id)->first();
            if($obj_comments_details)
            {
                $arr_comments_details = $obj_comments_details->toArray();
            }

            $this->arr_view_data['arr_comments_details']               = $arr_comments_details;

            $this->arr_view_data['module_url_path']            = $this->module_url_path;
            $this->arr_view_data['module_title']               = str_singular($this->module_title);
            $this->arr_view_data['sub_module_title']           = $this->comment_module_title;
            $this->arr_view_data['page_title']                 = 'View '.$this->comment_module_title;
            $this->arr_view_data['blog_image_public_img_path'] = $this->blog_image_public_img_path;
            $this->arr_view_data['blog_image_base_img_path']   = $this->blog_image_base_img_path;
            $this->arr_view_data['default_img_path']           = $this->default_img_path;

            return view($this->module_view_folder2.'/view',$this->arr_view_data);
        }
        else
        {
            Flash::error('Someting went wrong,Please try again.');
            return redirect()->back();
        }  
    }

    public function activate_comment($enc_id=FALSE)
    {
        if($enc_id!='')
        {
            $id = base64_decode($enc_id);
            $info = $this->BlogCommentsModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->BlogCommentsModel->where('id',$id)->update(['status'=>'1']);
                if($update_result)
                {
                    Flash::success($this->comment_module_title.' activated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While activating '.$this->comment_module_title);
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

    public function deactivate_comment($enc_id=FALSE)
    {
        if($enc_id!='')
        {
            $id = base64_decode($enc_id);
            $info = $this->BlogCommentsModel->where('id',$id)->first();

            if(sizeof($info)>0)
            {
                $update_result = $this->BlogCommentsModel->where('id',$id)->update(['status'=>'0']);
                if($update_result)
                {
                    Flash::success($this->comment_module_title.' blocked Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While blocked '.$this->comment_module_title);
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

    public function delete_comment($enc_id=FALSE)
    {
        $id = base64_decode($enc_id);
        $status = $this->BlogCommentsModel->where('id',$id)->delete();
        if($status)
        {
            Flash::success('Blog Deleted Successfully.');
        }
        else
        {
            Flash::error('Problem Occured, While Deleting blog.');
        }
        return redirect()->back();
    }

    public function multi_action_comment(Request $request)
    {
        $arr_rules = array();
        $arr_rules['multi_action']       = 'required';
        $arr_rules['checked_record']     = 'required';

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->comment_module_title.' To Perform Multi Actions');
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
        
                $delete_data = $this->BlogCommentsModel->where('id',$record_id)->delete();
                if($delete_data)
                {
                    Flash::success($this->comment_module_title.' Deleted Successfully');        
                } 
        
            }
            elseif($multi_action=="activate")
            {

                $result = $this->BlogCommentsModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'1']);

                    if($result_status)
                    { 
                        Flash::success($this->comment_module_title.' Activated Successfully'); 
                    }
                }        
            }
            elseif($multi_action=="deactivate")
            {
                   
                $result = $this->BlogCommentsModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'0']);

                    if($result_status)
                    {  
                        Flash::success($this->comment_module_title.' Blocked Successfully');  
                    }
                }        
            }
        }

        return redirect()->back();    
    }
    /*-------------------------------------------------------------------------------*/
}
