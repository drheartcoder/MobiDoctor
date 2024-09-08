<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CMSCategoryModel;
use App\Models\CMSSubCategoryModel;
use App\Models\CmsCategoryDetailsModel;
use App\Models\CmsSubCategoryDetailsModel;
use App\Models\CmsQuestionAnswerModel;

use App\Models\BlogModel;
use App\Models\BlogCategoryModel;

class WhatWeTreatController extends Controller
{
    public function __construct()
    {
        $this->arr_view_data              = [];
        $this->CMSCategoryModel           = new CMSCategoryModel();
        $this->CMSSubCategoryModel        = new CMSSubCategoryModel();
        $this->CmsCategoryDetailsModel    = new CmsCategoryDetailsModel();
        $this->CmsSubCategoryDetailsModel = new CmsSubCategoryDetailsModel();
        $this->CmsQuestionAnswerModel     = new CmsQuestionAnswerModel();
        $this->BlogModel                  = new BlogModel();
        $this->BlogCategoryModel          = new BlogCategoryModel();
        $this->module_view_folder         = "front.what_we_treat";
        $this->module_url_path            = url('/').'/what-we-treat';
        $this->category_public_path       = url('/').config('app.img_path.what_we_treat_category');
        $this->category_base_path         = base_path().config('app.img_path.what_we_treat_category').'/';
        $this->subcategory_public_path    = url('/').config('app.img_path.what_we_treat_subcategory');
        $this->subcategory_base_path      = base_path().config('app.img_path.what_we_treat_subcategory').'/';
        $this->default_img_path           = url('/').config('app.img_path.default_img_path');
    }

    public function index()
    {
    	$arr_category = [];
    	$obj_category = $this->CMSCategoryModel->select('name','slug','image')->where('status','=','1')->get();
    	if($obj_category)
    	{
    		$arr_category = $obj_category->toArray();
    	}


        $this->arr_view_data['arr_category']         = $arr_category;

        $this->arr_view_data['category_img_public_path'] = $this->category_public_path;
        $this->arr_view_data['category_img_base_path']   = $this->category_base_path;
        $this->arr_view_data['default_img_path']     = $this->default_img_path;
        $this->arr_view_data['module_url_path']      = $this->module_url_path;
        $this->arr_view_data['page_title']           = 'What We Treat';

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function category_details($slug)
    {

        $arr_category_details = $arr_subcategory = [];
        $obj_category_details = $this->CmsCategoryDetailsModel->whereHas('category_details',function($qry)                                                    use($slug){
                                                                    $qry->where('slug','=',$slug);
                                                                 })
                                                                ->with(['category_details'])
                                                                ->first();
        if($obj_category_details)
        {
            $arr_category_details = $obj_category_details->toArray();
        }

        $category_id = isset($arr_category_details['category_id'])?$arr_category_details['category_id']:'';
        $arr_subcategory = $this->CMSSubCategoryModel->select('id','name','slug','image')->where('category_id','=',$category_id)
                                                     ->where('status','=','1')
                                                     ->get();
        if($arr_subcategory)
        {
            $arr_subcategory = $arr_subcategory->toArray();
        }

        if($slug!='' && isset($arr_category_details) && sizeof($arr_category_details)>0)
        {

 
            $this->arr_view_data['page_title']         = isset($arr_category_details['meta_title'])?decrypt_value($arr_category_details['meta_title']):'';
            $this->arr_view_data['author']             = config('app.project.name');
            $this->arr_view_data['meta_title']         = isset($arr_category_details['meta_title'])?decrypt_value($arr_category_details['meta_title']):'';
            $this->arr_view_data['meta_keyword']       = isset($arr_category_details['meta_keyword'])?decrypt_value($arr_category_details['meta_keyword']):'';
            $this->arr_view_data['meta_desc']          = isset($arr_category_details['meta_desc'])?decrypt_value($arr_category_details['meta_desc']):'';

            $this->arr_view_data['arr_subcategory']      = $arr_subcategory;
            $this->arr_view_data['arr_category_details'] = $arr_category_details;
            $this->arr_view_data['subcategory_img_public_path'] = $this->subcategory_public_path;
            $this->arr_view_data['subcategory_img_base_path'] = $this->subcategory_base_path;
            $this->arr_view_data['module_url_path'] = $this->module_url_path.'/'.$slug;
            return view($this->module_view_folder.'.category_details',$this->arr_view_data);
        }
        
        return redirect()->back();
    }

    public function sub_category_details($category_slug,$sub_category_slug,$tab_slug = false)
    {
        if(isset($category_slug) && $category_slug!='' && isset($sub_category_slug) && $sub_category_slug!='')
        {

            $category_id = $this->get_category_id($category_slug);
            $sub_category_id = $this->get_sub_category_id($sub_category_slug);

            $arr_tab_details = [];

            $obj_tab_details = $this->CmsSubCategoryDetailsModel
                                                        ->select('id','tab_slug','tab_name')
                                                        ->where('category_id','=',$category_id)
                                                        ->where('sub_category_id','=',$sub_category_id)
                                                        ->where('is_investigation_details','=','Yes')
                                                        ->get();
            if($obj_tab_details)
            {
                $arr_tab_details = $obj_tab_details->toArray();
            }
            
            $obj_subcategory_details = $this->CmsSubCategoryDetailsModel->with(['get_question_answer','category_details','sub_category_details'])
                                                                        ->where('category_id','=',$category_id)
                                                                        ->where('sub_category_id','=',$sub_category_id);

            if($tab_slug!=false && $tab_slug!='')
            {
                $obj_subcategory_details = $obj_subcategory_details->where('tab_slug','=',$tab_slug);
            }

            $obj_subcategory_details = $obj_subcategory_details->get();
            if($obj_subcategory_details)
            {
                $arr_subcategory_details = $obj_subcategory_details->toArray();
            }

            if(isset($arr_subcategory_details) && sizeof($arr_subcategory_details)>0)
            {
                $this->arr_view_data['page_title']         = isset($arr_subcategory_details[0]['meta_title'])?$arr_subcategory_details[0]['meta_title']:'';
                $this->arr_view_data['author']             = config('app.project.name');
                $this->arr_view_data['meta_title']         =isset($arr_subcategory_details[0]['meta_title'])?$arr_subcategory_details[0]['meta_title']:'';
                $this->arr_view_data['meta_keyword']       = isset($arr_subcategory_details[0]['meta_keyword'])?$arr_subcategory_details[0]['meta_keyword']:'';
                $this->arr_view_data['meta_desc']          = isset($arr_subcategory_details[0]['meta_desc'])?$arr_subcategory_details[0]['meta_desc']:'';;

                $this->arr_view_data['category_slug']           = $category_slug;
                $this->arr_view_data['sub_category_slug']       = $sub_category_slug;
                $this->arr_view_data['module_url_path']         = $this->module_url_path;
                $this->arr_view_data['arr_subcategory_details'] = $arr_subcategory_details;
                $this->arr_view_data['arr_tab_details']         = $arr_tab_details;
                $this->arr_view_data['tab_slug']                = $tab_slug;

                return view($this->module_view_folder.'.subcategory_details',$this->arr_view_data);
            }
            return redirect()->back();
        }

        return redirect()->back();
        
    }

    public function get_category_id($category_slug)
    {
        $category_id = 0;
        $obj_category_id = $this->CMSCategoryModel->select('id')->where('slug',$category_slug)->first();
        $category_id = isset($obj_category_id->id)?$obj_category_id->id:0;
        return $category_id;
    }

    public function get_sub_category_id($sub_category_slug)
    {
        $subcategory_id = 0;
        $obj_subcategory = $this->CMSSubCategoryModel->select('id')->where('slug',$sub_category_slug)->first();
        $sub_category_id = isset($obj_subcategory->id)?$obj_subcategory->id:0;
        return $sub_category_id;
    }


}
