@extends('admin.layout.master')
@section('main_content')
<link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/data-tables/latest/dataTables.bootstrap.min.css">
<?php $cnt = 0;  ?>
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
        </span>
        <li class="active">Manage {{ $page_title or ''}}</li>
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
                    {{ isset($page_title)?$page_title:"" }}
                </h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"></a>
                    <a data-action="close" href="#"></a>
                </div>
            </div>
            <div class="box-content">
                @include('admin.layout._operation_status')  

                <form method="post" class="form-horizontal" id="frm_manage" action="{{url($module_url_path.'/multi_action')}}">{{csrf_field()}}
                    <div class="col-md-10">
                        <div id="ajax_op_status">

                        </div>
                        <div class="alert alert-danger" id="no_select" style="display:none;"></div>
                        <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
                    </div>
                    <div class="btn-toolbar pull-right clearfix">
                        <div class="btn-group">
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                                title="Multiple Active/Unblock" 
                                href="javascript:void(0);" 
                                onclick="javascript : return check_multi_action('frm_manage','activate');" 
                                style="text-decoration:none;">
                                <i class="fa fa-unlock"></i>
                            </a> 
                        </div>

                        <div class="btn-group">
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                            title="Multiple Deactive/Block" 
                            href="javascript:void(0);" 
                            onclick="javascript : return check_multi_action('frm_manage','deactivate');"  
                            style="text-decoration:none;">
                            <i class="fa fa-lock"></i>
                            </a> 
                        </div>

                        <div class="btn-group">    
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                            title="Multiple Delete" 
                            href="javascript:void(0);" 
                            onclick="javascript : return check_multi_action('frm_manage','delete');"  
                            style="text-decoration:none;">
                            <i class="fa fa-trash-o"></i>
                            </a>
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
                    <table class="table table-advance"  id="table1" >
                        <thead>
                            <tr>
                                <th style="width:18px"> <input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                                <th>Doctor Name</th>
                                <th>Patient Name</th>
                                <th>Feedback</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($arr_rating) && sizeof($arr_rating)>0)
                            @foreach($arr_rating as $key => $data)
                            <tr>
                                <td> 
                                    <input type="checkbox" name="checked_record[]"  value="{{ base64_encode($data['id']) }}" /> 
                                </td>
                                <td>
                                    {{isset($data['doctor_details']['first_name'])?decrypt_value($data['doctor_details']['first_name']):''}} {{isset($data['doctor_details']['last_name'])?decrypt_value($data['doctor_details']['last_name']):''}}
                                </td>
                                <td>
                                    {{isset($data['patient_details']['first_name'])?decrypt_value($data['patient_details']['first_name']):''}} {{isset($data['patient_details']['last_name'])?decrypt_value($data['patient_details']['last_name']):''}}
                                </td>
                                <td>
                                   {{isset($data['feedback'])?str_limit($data['feedback'],25):''}}
                                </td>
                                <td>
                                    {{isset($data['rating'])?$data['rating']:''}}
                                </td>
                                <td>
                                    @if($data['status']=="1")
                                      <a onclick="confirm_action(this,event,'Do you really want to deactivate this review & rating ?')" href="{{ $module_url_path.'/deactivate/'.base64_encode($data['id']) }}" class="btn btn-success">Active</a>
                                    @else
                                      <a onclick="confirm_action(this,event,'Do you really want to activate this review & rating ?')" href="{{ $module_url_path.'/activate/'.base64_encode($data['id']) }}" class="btn btn-danger">Inactive</a>
                                    @endif 
                                </td>
                                <td>
                                    <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/view/'.base64_encode($data['id']) }}"  title="View">
                                    <i class="fa fa-eye" ></i>
                                    </a>
                                    <a onclick="confirm_action(this,event,'Do you really want to delete this doctor ?')" class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/delete/'.base64_encode($data['id']) }}"  title="Delete">
                                    <i class="fa fa-trash-o" ></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- END Main Content -->
<script src="{{ url('/') }}/public/admin/assets/data-tables/latest/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/public/admin/assets/data-tables/latest/dataTables.bootstrap.min.js"></script>
<script>
    
     $(document).ready(function() {
        $('#table_module').DataTable( {
            "pageLength": 10,
            "aoColumns": [
              { "bSortable": false },
              { "bSortable": false },
              { "bSortable": false },
              { "bSortable": false },
              { "bSortable": false },
              { "bSortable": false },
              { "bSortable": false }
            ]

        });
    });
</script>
@stop                    



