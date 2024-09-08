@extends('admin.layout.master')    
@section('main_content')
<!-- BEGIN Page Title -->
<style>
   .star,.err{ color:red; }
</style>
<div class="page-title">
   <div>
   </div>
</div>
<!-- END Page Title -->
<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
   <ul class="breadcrumb">
      <li>
         <i class="fa fa-home"></i>
         <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
      </li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      </span> 
      <li><i class="fa fa-list"></i><a href="{{$module_url_path}}/sub_category">{{ $module_title or ''}}</a></li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      </span>
      <i class="fa fa-plus"></i>
      <li class="active">{{ $page_title or ''}}</li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<div class="col-md-12">
   <div class="box box-blue">
      <div class="box-title">
         <h3><i class="fa fa-file"></i> {{ isset($page_title)?$page_title:"" }} </h3>
         <div class="box-tool">
         </div>
      </div>
      <br/>
      <form method="post" action="{{url($module_url_path.'/sub_category/store')}}" id="validation-form" class="form-horizontal" enctype="multipart/form-data" name="Form" >
         {{ csrf_field() }}
         <div class="box-content">
            @include('admin.layout._operation_status') 
            <div class="row">
               <div class="col-md-12">
                  <!-- BEGIN Left Side -->
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="page_title">Category
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-6 controls">
                           <select name="category_id" id="category_id" class="form-control">
                              <option value="">--Select--</option>
                              @if(isset($arr_category) && sizeof($arr_category)>0)
                                 @foreach($arr_category as $category)
                                    <option value="{{$category['id']}}">{{isset($category['name'])?decrypt_value($category['name']):''}}</option>
                                 @endforeach
                              @endif
                           </select>
                           <div class="err" id="err_category_id"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="page_title">Sub Category
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-6 controls">
                           <input type="text" name="sub_category_name" class="form-control" id="sub_category_name" placeholder="Sub Category Name" >
                           <div class="err" id="err_sub_category_name"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Image<i class="red">*</i></label>
                        <div class="col-sm-3 col-lg-7 controls">
                           <div class="fileupload fileupload-new" data-provides="fileupload">
                              <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                 <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                              </div>
                              <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                              <div>
                                 <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
                                 <span class="fileupload-exists">Change</span>
                                 <input type="file" name="image"  id="image" class="file-input validate-image" /></span>
                                 <!--<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>-->
                              </div>
                               <i class="red"> 
                                    <span class="label label-important">NOTE!</span>
                                    <i class="red"> Allowed only jpg | jpeg | png <br/> 
                                        Please upload image with Height and Width greater than or equal to 290 X 290 for best result. </i>
                                        <span for="cat_img" id="err_cat_image" class='help-block'>{{ $errors->first('image') }}</span> 
                                    </i>
                              <div class="err" id="err_image"></div>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                  </div>
               </div>
            </div>
            <div class="clearfix"></div>
            <br/>
            <center>
               <div class="form-group">
                  <button type="submit" name="btn_save" id="valid" class="btn btn-success">Save</button>
               </div>
            </center>
         </div>
      </form>
   </div>
</div>
<!-- END Main Content --> 
<script type="text/javascript">
  $(document).on("change",".validate-image", function()
    {            
        var file=this.files;
        validateImage(this.files, 290,290);
    });
</script>
<script>
$('#valid').click(function(){
   var category_id  = $('#category_id').val();
   var sub_category_name  = $('#sub_category_name').val();
   var image                     = $('#image').val();
   if($.trim(category_id)=="")
   {
      $('#category_id').val('');
      $('#err_category_id').fadeIn();         
      $('#err_category_id').html('Please select category.');
      $('#err_category_id').fadeOut(4000);
      $('#category_id').focus();
      return false;
   }
   if($.trim(sub_category_name)=="")
   {
      $('#sub_category_name').val('');
      $('#err_sub_category_name').fadeIn();         
      $('#err_sub_category_name').html('Please enter subcategory name.');
      $('#err_sub_category_name').fadeOut(4000);
      $('#sub_category_name').focus();
      return false;
   }
   if($.trim(image)=="")
   {
      $('#image').val('');
      $('#err_image').fadeIn();         
      $('#err_image').html('Please upload image.');
      $('#err_image').fadeOut(4000);
      $('html, body').animate({
          scrollTop: $('#main-content').offset().top
      }, 'slow');
      $('#image').focus();
      return false;
   }
});
</script>
@endsection

