<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\BlogModel;
use App\Models\BlogCategoryModel;
use App\Models\BlogCommentsModel;

use Validator;
use Session;

class BlogController extends Controller
{
	public function __construct()
	{
		$this->BlogModel         = new BlogModel();
        $this->BlogCategoryModel = new BlogCategoryModel();
		$this->BlogCommentsModel = new BlogCommentsModel();

		$this->arr_view_data            = [];
        $this->module_title             = "Blog";
        $this->module_url_path          = url('/').'/blog';
        $this->module_view_folder       = "front.blog";

        $this->blog_image_public_img_path = url('/').'/uploads/blog/';
        $this->blog_image_base_img_path   = base_path().'/uploads/blog/';
        $this->default_img_path           = url('/').config('app.img_path.default_img_path');

        $this->doctor_image_public_path = url('/').config('app.img_path.doctor_profile_images');
        $this->doctor_image_base_path   = base_path().config('app.img_path.doctor_profile_images');

        $this->patient_image_public_path = url('/').config('app.img_path.patient_profile_images');
        $this->patient_image_base_path   = base_path().config('app.img_path.patient_profile_images');
	}

    public function index()
    {
    	$arr_blogs = $arr_blogs_category = [];

    	$obj_blogs_category = $this->BlogCategoryModel->where('status','=','1')->get();
    	if($obj_blogs_category)
    	{
    		$arr_blogs_category = $obj_blogs_category->toArray();
    	}
        $this->arr_view_data['arr_blogs_category'] = $arr_blogs_category;


    	$obj_blogs = $this->BlogModel->with(['category_details'=>function($qry){
                                                    $qry->select('id','blog_id','category_id');
                                            },'category_details.blog_category_details'=>function($qry){
                                                $qry->select('id','name','slug');
                                            }])
                                            ->where('status','=','1')
                                            ->orderBy('created_at','desc')
                                            ->paginate(10);

        if(isset($obj_blogs) && $obj_blogs!=null) 
        {
            $arr_paginate     = clone $obj_blogs;
            $arr_blogs = $obj_blogs->toArray();
        }

        $arr_popular_blog = [];
        $obj_popular_blog = $this->BlogModel->select('posted_by','title','description','slug','image')
                                            ->orderBy('view_count','desc')
                                            ->limit(3)
                                            ->get();
        if($obj_popular_blog)
        {
            $arr_popular_blog = $obj_popular_blog->toArray();
        }

        $this->arr_view_data['page_title']         = config('app.project.name').' '.'Blog';
        $this->arr_view_data['author']             = config('app.project.name');
        $this->arr_view_data['meta_title']         = config('app.project.name').' '.'Blog';
        $this->arr_view_data['meta_keyword']       = '';
        $this->arr_view_data['meta_desc']          = "Read the latest news and research from ".config('app.project.name')." health, wellbeing and nutrition blog. Expert advice to help you live a happier, longer life.";

        $this->arr_view_data['arr_popular_blog']           = $arr_popular_blog;
        $this->arr_view_data['arr_pagination']             = isset($arr_paginate)?$arr_paginate:null;
        $this->arr_view_data['arr_blogs']                  = $arr_blogs;
        $this->arr_view_data['module_url_path']            = $this->module_url_path;
        $this->arr_view_data['blog_image_public_img_path'] = $this->blog_image_public_img_path;
        $this->arr_view_data['blog_image_base_img_path']   = $this->blog_image_base_img_path;
        $this->arr_view_data['default_img_path']           = $this->default_img_path;


    	return view($this->module_view_folder.'.index', $this->arr_view_data);        
    }

    public function details($slug)
    {
        $arr_blogs_details = [];
        $obj_blogs_details = $this->BlogModel->with(['category_details'=>function($qry){
                                                    $qry->select('id','blog_id','category_id');
                                            },'category_details.blog_category_details'=>function($qry){
                                                $qry->select('id','name','slug');
                                            },'blog_comment'=>function($qry1){
                                                $qry1->where('status','=','1');
                                            },'blog_comment.user_details'])
                                        ->where('slug','=',$slug)
                                        ->first();

        if($obj_blogs_details)
        {
            $arr_blogs_details = $obj_blogs_details->toArray();
        }

        $obj_blogs_category = $this->BlogCategoryModel->where('status','=','1')->get();
        if($obj_blogs_category)
        {
            $arr_blogs_category = $obj_blogs_category->toArray();
        }

        $arr_popular_blog = [];
        $obj_popular_blog = $this->BlogModel->select('posted_by','title','description','slug','image')->orderBy('view_count','desc')->limit(3)->get();
        if($obj_popular_blog)
        {
            $arr_popular_blog = $obj_popular_blog->toArray();
        }

        $view_count = $this->BlogModel->where('slug','=',$slug);
        $view_count->increment('view_count');

        $this->arr_view_data['page_title']         = isset($arr_blogs_details['title'])?decrypt_value($arr_blogs_details['title']):'';
        $this->arr_view_data['author']             = isset($arr_blogs_details['posted_by'])?decrypt_value($arr_blogs_details['posted_by']):'';
        $this->arr_view_data['meta_title']         = isset($arr_blogs_details['meta_title'])?decrypt_value($arr_blogs_details['meta_title']):'';
        $this->arr_view_data['meta_keyword']       = isset($arr_blogs_details['meta_keyword'])?decrypt_value($arr_blogs_details['meta_keyword']):'';
        $this->arr_view_data['meta_desc']          = isset($arr_blogs_details['meta_desc'])?decrypt_value($arr_blogs_details['meta_desc']):'';


        $this->arr_view_data['arr_blogs_category']         = $arr_blogs_category;
        $this->arr_view_data['arr_blogs_details']          = $arr_blogs_details;
        $this->arr_view_data['arr_popular_blog']           = $arr_popular_blog;
        $this->arr_view_data['blog_image_public_img_path'] = $this->blog_image_public_img_path;
        $this->arr_view_data['blog_image_base_img_path']   = $this->blog_image_base_img_path;
        $this->arr_view_data['default_img_path']           = $this->default_img_path;
        $this->arr_view_data['module_url_path']            = $this->module_url_path;
        $this->arr_view_data['doctor_image_public_path']   = $this->doctor_image_public_path;
        $this->arr_view_data['doctor_image_base_path']     = $this->doctor_image_base_path;
        $this->arr_view_data['patient_image_public_path']  = $this->patient_image_public_path;
        $this->arr_view_data['patient_image_base_path']    = $this->patient_image_base_path;
        


        return view($this->module_view_folder.'.details', $this->arr_view_data);        
    }

    public function store_comment(Request $request)
    {
        $arr_rules = $return_arr = [];

        $arr_rules['blog_id']   = 'required';
        $arr_rules['user_id']   = 'required';
        $arr_rules['comment']   = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all the required field.';

            return response()->json($return_arr);
        }

        $arr_data['blog_id']   = base64_decode($request->input('blog_id'));
        $arr_data['user_id']   = base64_decode($request->input('user_id'));
        $arr_data['comment']   = encrypt_value(trim($request->input('comment')));

        $status = $this->BlogCommentsModel->create($arr_data);
        if($status)
        {
            Session::flash('success','Send comment succssfully.');
            return response()->json($return_arr);
        }
        else
        {
            Session::flash('error','Something went wrong , Please try again.');
            return response()->json($return_arr);
        }
    }

    public function topic($slug)
    {
        $arr_blogs = $arr_blogs_category = [];

        $obj_blogs_category = $this->BlogCategoryModel->where('status','=','1')->get();
        if($obj_blogs_category)
        {
            $arr_blogs_category = $obj_blogs_category->toArray();
        }


        $this->arr_view_data['arr_blogs_category'] = $arr_blogs_category;


        $obj_blogs = $this->BlogModel
                                    ->whereHas('category_details',function($query)use($slug){
                                        $query->whereHas('blog_category_details',function($query) use($slug){
                                              $query->where('slug',$slug); 
                                        });
                                    })
                                    ->with(['category_details'=>function($qry){
                                            $qry->select('id','blog_id','category_id');
                                    },'category_details.blog_category_details'=>function($qry){
                                        $qry->select('id','name','slug');
                                    }])
                                    ->where('status','=','1')
                                    ->orderBy('created_at','desc')
                                    ->paginate(4);

        if(isset($obj_blogs) && $obj_blogs!=null) 
        {
            $arr_paginate     = clone $obj_blogs;
            $arr_blogs = $obj_blogs->toArray();
        }


        $arr_popular_blog = [];
        $obj_popular_blog = $this->BlogModel->select('posted_by','title','description','slug','image')->orderBy('view_count','desc')->limit(3)->get();
        if($obj_popular_blog)
        {
            $arr_popular_blog = $obj_popular_blog->toArray();
        }

        $obj_category_name = $this->BlogCategoryModel->select('name')->where('slug',$slug)->first();

        $category_name = isset($obj_category_name->name)?decrypt_value($obj_category_name->name):'';

        $this->arr_view_data['page_title']         = config('app.project.name')." Blog | ".$category_name;

        $this->arr_view_data['author']             = config('app.project.name');
        $this->arr_view_data['meta_title']         = config('app.project.name')." Blog | ".$category_name;
        $this->arr_view_data['meta_keyword']       = '';

        $this->arr_view_data['meta_desc']          = $category_name." | Read the latest news and research from ".config('app.project.name')." health, wellbeing and nutrition blog. Expert advice to help you live a happier, longer life.";

        $this->arr_view_data['arr_popular_blog']           = $arr_popular_blog;
        $this->arr_view_data['arr_pagination']             = isset($arr_paginate)?$arr_paginate:null;
        $this->arr_view_data['arr_blogs']                  = $arr_blogs;
        $this->arr_view_data['module_url_path']            = $this->module_url_path;
        $this->arr_view_data['blog_image_public_img_path'] = $this->blog_image_public_img_path;
        $this->arr_view_data['blog_image_base_img_path']   = $this->blog_image_base_img_path;
        $this->arr_view_data['default_img_path']           = $this->default_img_path;
        $this->arr_view_data['category_name']             = $category_name;

        return view($this->module_view_folder.'.topic', $this->arr_view_data);     
    }
}
