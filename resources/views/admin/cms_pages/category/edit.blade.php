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
      <i class="fa fa-list"></i>
      </span> 
      <li><a href="{{$module_url_path}}/category">{{ $module_title or ''}}</a></li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-edit"></i>
      </span> 
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
      <form method="post" action="{{url($module_url_path.'/category/update/')}}{{base64_encode($arr_category['id'])}}" id="validation-form" class="form-horizontal" enctype="multipart/form-data" name="Form" >
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
                           <input type="text" name="category_name" class="form-control" id="category" placeholder="Category Name" value="{{isset($arr_category['name'])?decrypt_value($arr_category['name']):''}}">
                           <div class="err" id="err_category"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                  </div>
               </div>
            </div>
            <div class="clearfix"></div>
            <br/>
            <div class="form-group">
                <label class="col-sm-3 col-lg-3 control-label">Image<i class="red">*</i></label>
                <div class="col-sm-6 col-lg-7 controls">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <input type="hidden" value="{{$default_img_path.'/blog.jpg'}}" id="default_image">
                        <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                            @if(isset($arr_category['image']) && !empty($arr_category['image']) && $arr_category['image'] != null && file_exists($category_base_path.'/'.$arr_category['image']))
                                <?php $image = $arr_category['image']; ?>                    
                            <img src="{{ $category_public_path.'/'.$arr_category['image'] }}" id="preview" >
                            @else
                            <img src="{{ $default_img_path.'/blog.jpg' }}" id="preview" >                    
                            @endif
                        </div>
                        <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                        <div>
                            <span class="btn btn-default btn-file" style="height:32px;">

                                <span class="fileupload-new">Change</span>
                                <span class="fileupload-exists">Change</span>
                                <input type="file"  data-validation-allowing="jpg, jpeg, png" class="file-input news-image validate-image" name="image" id="image"/><br>
                                <input type="hidden" class="file-input " name="oldimage" id="oldimage" value="{{ $arr_category['image'] }}"/>
                            </span>
                        </div>
                        <i class="red"> 
                            <span class="label label-important">NOTE!</span>
                            <i class="red"> Allowed only jpg | jpeg | png <br/> 
                                Please upload image with Height and Width greater than or equal to 290 X 290 for best result. </i>
                                <input type="hidden" id="invalid_size" value="">
                                <input type="hidden" id="invalid_ext" value="">
                                <span for="cat_img" id="err_cat_image" class='help-block'>{{ $errors->first('image') }}</span> 
                            </i>
                            <div id="file-upload-error" class="error"></div>
                            <span for="image" id="err_image" class="help-block">{{ $errors->first('image') }}</span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
            </div>
            <center>
               <div class="form-group">
                  <button type="submit" name="btn_save" id="valid" class="btn btn-success">Update</button>
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
   var category  = $('#category').val();
   if($.trim(category)=="")
   {
      $('#category').val('');
      $('#err_category').fadeIn();         
      $('#err_category').html('Please enter category.');
      $('#err_category').fadeOut(4000);
      $('#category').focus();
      return false;
   }
  
});
</script>
@endsection

