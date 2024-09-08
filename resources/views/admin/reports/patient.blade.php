@extends('admin.layout.master')
@section('main_content')
<link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/data-tables/latest/dataTables.bootstrap.min.css">
<?php $cnt = 0;  ?>

<style type="text/css">
  .table>tbody>tr>td:last-child{white-space: nowrap;}
  .dataTables_filter, .dataTables_info { display: none; }
  .col-sm-2 { margin-left: 1100px; }
  .form-horizontal .btn-group { margin-bottom: -43px;}
</style>

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
            <li class="active">Patients {{ $page_title or ''}}</li>
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
               Patients {{ isset($page_title) ? $page_title : "" }}
                </h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"></a>
                    <a data-action="close" href="#"></a>
                </div>
            </div>
        <div class="box-content">

          @include('admin.layout._operation_status')  

          <form method="post" class="form-horizontal" id="frm_manage" action="{{url($module_url_path.'/export')}}">{{csrf_field()}}
            <div class="col-md-10">
                <div id="ajax_op_status">
                    
                </div>
              <div class="alert alert-danger" id="no_select" style="display:none;"></div>
              <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
            </div>
            <div class="btn-toolbar pull-right clearfix">
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

            <div class="btn-group">
                <div class="col-sm-2">
                  <input type="submit" value="Export to CSV" class="btn btn-primary">
                </div>
            </div>
        </form>  
            <div class="clearfix"></div>
            <div class="table-responsive" style="border:0">

              <input type="hidden" name="multi_action" value="" />

                <table class="table table-advance"  id="table1" >
                 <thead>
                    <tr>
                       <th style="display: none;">ID</th>
                       <th>Name</th>
                       <th>Email</th>
                       <th>Mobile No.</th>
                       <th>Gender</th>
                       <th>Address</th>
                       <th>Registration date</th>
                       <th>Status</th>
                    </tr>
                 </thead>
                 <tbody>
                  	@if(isset($arr_patient) && sizeof($arr_patient)>0)
                  		@foreach($arr_patient as $key => $data)

                        <tr>
                          <td style="display: none;">
                            {{ ++$cnt }}
                          </td>
                  				<td>
                              {{ isset($data['first_name']) ? decrypt_value($data['first_name']) : '' }} {{ isset($data['last_name']) ? decrypt_value($data['last_name']) : '' }}
                          </td>
                  				<td>{{ isset($data['email']) ? $data['email'] : '' }}</td>
                  				<td>+{{ isset($data['phone_code']) ? $data['phone_code'] : '' }}{{ isset($data['mobile_no']) ? $data['mobile_no'] : '' }}</td>
                  				<td>{{ isset($data['gender']) ? $data['gender'] : '' }}</td>
                  				<td>{{ isset($data['address']) ? decrypt_value($data['address']) : '' }}</td>
                          <td>{{ isset($data['created_at']) ? date('d-M-Y',strtotime($data['created_at'])) : '00-00-0000' }}</td>
                  				<td> 
                            @if($data['status']=="1")
                              <a href="javascript:void(0);" class="btn btn-success">Active</a>
                            @else
                              <a href="javascript:void(0);" class="btn btn-danger">Inactive</a>
                            @endif
                          </td>
                  			</tr>
                  		@endforeach
                  	@endif
                 </tbody>
              </table>
            </div>
        </div>
  </div>
</div>

<!-- END Main Content -->
<script src="{{ url('/') }}/public/admin/assets/data-tables/latest/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/public/admin/assets/data-tables/latest/dataTables.bootstrap.min.js"></script>
<script>
    
     $(document).ready(function() {
        $('#table_module').DataTable({
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



