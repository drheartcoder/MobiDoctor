@extends('admin.layout.master')
@section('main_content')
<link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/data-tables/latest/dataTables.bootstrap.min.css">

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
        </li>
        <span class="divider">
            <i class="fa fa-angle-right"></i>
            <i class="fa fa-user"></i>
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
            <i class="fa fa-text-width"></i>
            {{ isset($page_title) ? $page_title : "" }}
            </h3>
            <div class="box-tool">
                <a data-action="collapse" href="#"></a>
                <a data-action="close" href="#"></a>
            </div>
        </div>
        <div class="box-content">
          @include('admin.layout._operation_status')  
          <form method="post" class="form-horizontal" id="frm_manage" action="{{url($module_url_path.'/multi_action')}}">{{csrf_field()}}
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
                <table class="table table-advance"  id="table1" >
                    <thead>
                        <tr>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Gender</th>
                           <th>Relation</th>
                           <th>Birth Date</th>
                           <th>Mobile No.</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@if(isset($arr_family_member) && sizeof($arr_family_member)>0)
                    		@foreach($arr_family_member as $key => $data)
                                <tr>
                            		<td>
                                        {{ isset($data['first_name']) ? decrypt_value($data['first_name']) : '' }} {{ isset($data['last_name']) ? decrypt_value($data['last_name']) : '' }}
                                    </td>
                            		<td>
                                        {{ isset($data['email']) ? $data['email'] : '' }}
                                    </td>
                                    <td>
                                        {{ isset($data['gender']) ? decrypt_value($data['gender']) : '' }}
                                    </td>
                                    <td>
                                        {{ isset($data['relation']) ? decrypt_value($data['relation']) : '' }}
                                    </td>
                                    <td>
                                        {{ isset($data['birth_date']) ? $data['birth_date'] : '' }}
                                    </td>
                                    <td>
                                        +{{ isset($data['phone_code']) ? $data['phone_code'] : '' }}{{ isset($data['mobile_no']) ? $data['mobile_no'] : '' }}
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

@stop                    



