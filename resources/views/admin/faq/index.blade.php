@extends('admin.layout.master')
@section('main_content')
<link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/data-tables/latest/dataTables.bootstrap.min.css">

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
                               <th style="width: 150px;">Question</th>
                               <th style="width: 600px;">Answer</th>
                               <th style="width: 100px;">Added On</th>
                               <th>Status</th>
                               <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @if(isset($arr_faq) && sizeof( $arr_faq )>0)
                                @foreach($arr_faq as $data)
                                    <tr>
                                        <td><input type="checkbox" name="checked_record[]"  value="{{ base64_encode($data['id']) }}" /></td>
                                        <td> {{isset( $data['question'] ) ? decrypt_value( $data['question'] ) : ''}} </td>
                                        <td> {{ isset( $data['answer'] ) ? decrypt_value( $data['answer'] ) : '' }} </td>
                                        <td>{{isset($data['created_at']) ? date('d-M-Y',strtotime($data['created_at'])):''}}</td>
                                        <td>
                                            @if($data['status']=="1")
                                                <a onclick="confirm_action(this,event,'Do you really want to blocked this record ?')" href="{{ $module_url_path.'/deactivate/'.base64_encode($data['id']) }}" title="Active" class="btn btn-success">Active</a>
                                            @else
                                                <a onclick="confirm_action(this,event,'Do you really want to activate this record ?')" href="{{ $module_url_path.'/activate/'.base64_encode($data['id']) }}" title="Block" class="btn btn-danger">Block</a>
                                            @endif
                                         </td>
                                        <td>
                                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/edit/'.base64_encode($data['id']) }}"  title="Edit Faq">
                                            <i class="fa fa-edit" ></i>
                                            </a>  

                                            &nbsp;
                                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/delete/'.base64_encode($data['id'])}}" 
                                              onclick="confirm_action(this,event,'Do you really want to delete this record ?')"  title="Delete Faq">
                                            <i class="fa fa-trash" ></i>
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
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false }
            ]

        });
    });
</script>
@stop                    



