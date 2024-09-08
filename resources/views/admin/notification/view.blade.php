@extends('admin.layout.master')                
@section('main_content')
<!-- BEGIN Page Title -->
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
          <i class="fa fa-desktop"></i>
          <a href="{{ $module_url_path }}">{{ $module_title or ''}}</a>
        </span> 
        <span class="divider">
          <i class="fa fa-angle-right"></i>
          <i class="fa fa-list"></i>
        </span>
        <li class="active">{{ $page_title or ''}}</li>
      </ul>
    </div>
    <!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
   <div class="col-md-12">
      <div class="box">
         <div class="box-title">
            <h3>
               <i class="fa fa-list"></i>
               {{ isset($page_title)?$page_title:"" }}
            </h3>
            <div class="box-tool">
               <a data-action="collapse" href="#"></a>
               <a data-action="close" href="#"></a>
            </div>
         </div>
         <div class="box-content">
               @include('admin.layout._operation_status')
           <div class="alert alert-success" id="ajax_success" style="display:none;">
            <button data-dismiss="alert" class="close">×</button>
            <strong>Success!</strong>
            <div id="ajax_sub_success"></div>
         </div>
         <div class="alert alert-danger" id="ajax_error" style="display:none;">
            <button data-dismiss="alert" class="close">×</button>
            <strong>Error!</strong> 
            <div id="ajax_sub_error"></div>
         </div>
           
              <div class="row">
               @if(isset($arr_data) && sizeof($arr_data)>0)
              <form name="validation-form" id="validation-form" method="POST" action="" class="form-horizontal"  enctype="multipart/form-data">
               {{ csrf_field() }}
                <div class="col-md-6">
                   
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Name:</label>
                     <div class="col-sm-9 controls">
                        <div class="client-name-block">{{isset($arr_data['name'])?ucfirst($arr_data['name']):'-'}}</div>
                     </div>
                  </div>
                    <div class="form-group">
                     <label class="col-sm-3 control-label">Email:</label>
                     <div class="col-sm-9 controls">
                        <div class="client-name-block">{{isset($arr_data['email'])?ucfirst($arr_data['email']):'-'}}</div>
                     </div>
                  </div>
                    <div class="form-group">
                     <label class="col-sm-3 control-label">Phone No.:</label>
                     <div class="col-sm-9 controls">
                        <div class="client-name-block">{{isset($arr_data['phone_no'])?ucfirst($arr_data['phone_no']):'-'}}</div>
                     </div>
                  </div>
                    <div class="form-group">
                     <label class="col-sm-3 control-label">Message:</label>
                     <div class="col-sm-9 controls">
                        <div class="client-name-block">{{isset($arr_data['message'])?ucfirst($arr_data['message']):'-'}}</div>
                     </div>
                  </div>
                 
                 
            
       
              
                 
                  
                
                </div>
              </form>
               @endif
            </div>
       </div>
   </div>
</div>
</div>
@stop