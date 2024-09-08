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
          <!--   <span class="divider">
                <i class="fa fa-angle-right"></i>
                <i class="fa fa-desktop"></i>
                <a href="{{ $module_url_path }}">{{ $module_title or ''}}</a>
            </span>  -->
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
          
           <form method="post" class="form-horizontal" id="frm_manage" action="{{url($module_url_path.'/multi_action')}}">                     
          
           {{csrf_field()}}
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

          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0">

            <input type="hidden" name="multi_action" value="" />

              <table class="table table-advance"  id="table1" >
               <thead>
                  <tr>
                    <th width="2%"> <input type="checkbox" name="mult_change" id="mult_change" value="delete"/></th>
                    <th>Email</th>
                    <th>Unique id</th>
                    <th>Added on</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($arr_subscriber as $data)
                  <tr>
                     <td> 
                        <input type="checkbox" 
                           name="checked_record[]"  
                           value="{{ base64_encode($data['id']) }}" /> 
                     </td>
                     <td>{{ isset($data['email_address'])?$data['email_address']:'' }}</td>
                     <td>{{ isset($data['unique_email_id'])?$data['unique_email_id']:'' }}</td>
                     <td>{{ isset($data['timestamp_opt'])?date('d M Y h:i A',strtotime($data['timestamp_opt'])):'' }}</td>
                     <td>
                        @if($data['status']!='subscribed')
                            <span class="btn btn-sm btn-danger nocursor">Unsubscribed</span>
                        @else
                            <span class="btn btn-sm btn-success nocursor">Subscribed</span>
                        @endif
                     </td>
                    <td> 
                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/delete/'.base64_encode($data['id'])}}" 
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
<script src="{{ url('/') }}/public/admin/assets/data-tables/latest/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/public/admin/assets/data-tables/latest/dataTables.bootstrap.min.js"></script>
<script>
    
     $(document).ready(function() {
        $('#table_module').DataTable( {
            "pageLength": 10,
            "aoColumns": [
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false }
            ]

        });
    });
            
</script>
@stop                    


