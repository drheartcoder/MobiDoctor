@extends('admin.layout.master')
@section('main_content')
<link rel="stylesheet" href="{{ url('/') }}/public/assets/data-tables/latest/dataTables.bootstrap.min.css">
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
      <i class="fa fa-list"></i>
      <a href="{{ $module_url_path }}">{{ $module_title or ''}}</a>
      </span> 
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<div class="col-md-12">
   <div class="box">
      <div class="box-title">
         <h3>
            <i class="fa fa-text-width"></i>
            {{ $module_title or ''}}
         </h3>
         <div class="box-tool">
            <a data-action="collapse" href="#"></a>
            <a data-action="close" href="#"></a>
         </div>
      </div>
      <div class="box-content">
         @include('admin.layout._operation_status')  
         <form method="post" class="form-horizontal" id="frm_manage" action="{{url($module_url_path.'/category/multi_action')}}">
            {{csrf_field()}}
            <div class="col-md-10">
               <div id="ajax_op_status">
               </div>
               <div class="alert alert-danger" id="no_select" style="display:none;"></div>
               <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
            </div>
            <div class="btn-toolbar pull-right clearfix">
               <div class="btn-group">
                  <a href="{{ $module_url_path.'/create'}}" class="btn btn-primary btn-add-new-records"  title="Add Category">Add Details</a> 
               </div>
               <div class="btn-group"> 
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                     title="Refresh" 
                     href="{{ $module_url_path }}"
                     style="text-decoration:none;">
                  <i class="fa fa-repeat"></i>
                  </a> 
               </div>
            </div>
            <br/>
            <div class="clearfix"></div>
            <div class="table-responsive" style="border:0">
               <input type="hidden" name="multi_action" value="" />
               <table class="table table-advance"  id="blog-table" >
                  <thead>
                     <tr>
                        <th width="15px">Sub Category</th>
                        <th width="15px">Category</th>
                        <th width="15px">Section Name</th>
                        <th width="15px">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($arr_sub_category_details as $value)
                     <tr>
                        <td>{{isset($value['sub_category_details']['name'])?decrypt_value($value['sub_category_details']['name']):''}}</td>
                        <td>{{isset($value['category_details']['name'])?decrypt_value($value['category_details']['name']):''}}</td>
                        <td>{{isset($value['tab_name'])?$value['tab_name']:''}}</td>
                        <td> 
                           <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/edit/'.base64_encode($value['id'])}}"  title="Edit">
                           <i class="fa fa-edit" ></i>
                           </a>  
                           &nbsp; 
                           <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/delete_tab/'.base64_encode($value['id'])}}" 
                            onclick="confirm_action(this,event,'Do you really want to delete this record ?')"  title="Delete">
                           <i class="fa fa-trash" ></i>
                           </a>  
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- END Main Content -->
<script src="{{ url('/') }}/public/assets/data-tables/latest/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/public/assets/data-tables/latest/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {

 $('#blog-table').DataTable( {
       "pageLength": 10
    } );
 

});
</script>
@stop

