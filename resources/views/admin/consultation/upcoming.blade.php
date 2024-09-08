@extends('admin.layout.master')
@section('main_content')

<link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/data-tables/latest/dataTables.bootstrap.min.css">
<style type="text/css">
  .table>tbody>tr>td:last-child{white-space: nowrap;}
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
            <li class="active">{{ $page_title or ''}}</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-medkit"></i>{{ isset($page_title) ? $page_title : "" }}</h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"></a>
                    <a data-action="close" href="#"></a>
                </div>
            </div>
        <div class="box-content">
            @include('admin.layout._operation_status')  
            <form method="post" class="form-horizontal" id="frm_manage" action="{{url($module_url_path.'/multi_action')}}">
                {{ csrf_field() }}
                <div class="col-md-10">
                    <div id="ajax_op_status"></div>
                    <div class="alert alert-danger" id="no_select" style="display:none;"></div>
                    <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
                </div>

                <div class="btn-toolbar pull-right clearfix">
                    <div class="btn-group"> 
                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href="{{ $module_url_path }}" style="text-decoration:none;"><i class="fa fa-repeat"></i></a>
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
                                <th>Consultation ID</th>
                                <th>Patient Type</th>
                                <th>Patient Name</th>
                                <th>Doctor Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Payment</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                      	@if(isset($arr_consultation) && sizeof($arr_consultation)>0)
                      		@foreach($arr_consultation as $key => $data)

                            @php
                                $consultation_id = isset($data['consultation_id']) && !empty($data['consultation_id']) ? $data['consultation_id'] : '';
                                $who_is_patient = isset($data['who_is_patient']) && !empty($data['who_is_patient']) ? ucfirst($data['who_is_patient']) : '';

                                $user_id = isset($data['user_id']) && !empty($data['user_id']) ? $data['user_id'] : '';
                                $patient_id = isset($data['patient_id']) && !empty($data['patient_id']) ? $data['patient_id'] : '';

                                if( $who_is_patient == 'Family' ):
                                    $arr_family = get_family_member($user_id, $patient_id);

                                    $patient_fname = isset($arr_family['first_name']) && !empty($arr_family['first_name']) ? decrypt_value($arr_family['first_name']) : '';
                                    $patient_lname = isset($arr_family['last_name']) && !empty($arr_family['last_name']) ? decrypt_value($arr_family['last_name']) : '';

                                else:
                                    $patient_fname = isset($data['user_details']['first_name']) && !empty($data['user_details']['first_name']) ? decrypt_value($data['user_details']['first_name']) : '';
                                    $patient_lname = isset($data['user_details']['last_name']) && !empty($data['user_details']['last_name']) ? decrypt_value($data['user_details']['last_name']) : '';

                                endif;

                                $doctor_prefix = isset($data['doctor_details']['doctor_prefix']['name']) && !empty($data['doctor_details']['doctor_prefix']['name']) ? $data['doctor_details']['doctor_prefix']['name'] : 'Dr';
                                $doctor_fname  = isset($data['doctor_details']['first_name']) && !empty($data['doctor_details']['first_name']) ? decrypt_value($data['doctor_details']['first_name']) : '';
                                $doctor_lname  = isset($data['doctor_details']['last_name']) && !empty($data['doctor_details']['last_name']) ? decrypt_value($data['doctor_details']['last_name']) : '';

                                $date = isset($data['date']) && !empty($data['date']) ? date("d-M-Y",strtotime($data['date'])) : '';
                                $time = isset($data['time']) && !empty($data['time']) ? date("H:i A",strtotime($data['time'])) : '';
                                $payment = isset($data['payment']) && !empty($data['payment']) ? ucfirst($data['payment']) : '';

                            @endphp

                            <tr>
                      			<td> 
                                  <input type="checkbox" name="checked_record[]"  value="{{ base64_encode($data['id']) }}" /> 
                                </td>
                      			<td>{{ $consultation_id }}</td>
                                <td>{{ $who_is_patient }}</td>
                      			<td>{{ $patient_fname.' '.$patient_lname }}</td>
                      			<td>{{ $doctor_prefix.'. '.$doctor_fname.' '.$doctor_lname }}</td>
                      			<td>{{ $date }}</td>
                                <td>{{ $time }}</td>
                                <td>{{ $payment }}</td>
                      			<td>
                                    <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/upcoming/details/'.base64_encode($data['id']) }}" title="Details"><i class="fa fa-eye" ></i></a>
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
    $(document).ready(function() 
    {
        $('#table_module').DataTable({
            "pageLength" : 10,
            "aoColumns"  : [
                { "bSortable" : true },
                { "bSortable" : true },
                { "bSortable" : true },
                { "bSortable" : false },
                { "bSortable" : false },
                { "bSortable" : false },
                { "bSortable" : false }
            ]
        });
    });
</script>
@stop
