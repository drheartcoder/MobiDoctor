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
      <li>
          <i class="fa fa-list"></i>
         <a href="{{$module_url_path}}/category">{{ $module_title or ''}}</a></li>
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
      <form method="post" action="{{url($module_url_path.'/category/store')}}" id="validation-form" class="form-horizontal" enctype="multipart/form-data" name="Form" >
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
                           <input type="text" name="category_name" class="form-control" id="category" placeholder="Category Name" >
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

