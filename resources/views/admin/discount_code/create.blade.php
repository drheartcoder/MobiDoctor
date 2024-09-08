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

                <form method="post" id="frm_discount_code" name="frm_discount_code" action="{{ url($module_url_path.'/store') }}" class="form-horizontal">
                   {{ csrf_field() }}
                   
                    <div class="col-sm-6 col-lg-6">
                      
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-4 control-label" for="status">Price
                            <i class="red">*</i>
                            </label>
                            <div class="col-sm-6 col-lg-8 controls">
                                <input type="text" name="price" id="price" class="form-control"  placeholder="Price">   
                             <span id="err_price" style="color:red;">{{ $errors->first('price') }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-4 control-label" for="start_date">Start Date 
                            <i class="red">*</i>
                            </label>
                            <div class="col-sm-6 col-lg-8 controls">
                                <input type="text" name="start_date" placeholder="Start Date" id="start_date" class="form-control datepicker">
                                <span id="err_start_date" style="color:red;">{{ $errors->first('start_date') }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-4 control-label" for="end_date">End Date 
                            <i class="red">*</i>
                            </label>
                            <div class="col-sm-6 col-lg-8 controls">
                                <input type="text" name="end_date" placeholder="End Date" id="end_date" class="form-control datepicker">
                                <span id="err_end_date" style="color:red;">{{ $errors->first('end_date') }}</span>
                            </div>
                        </div>
                    

                        <div class="form-group">
                          <label class="col-sm-3 col-lg-4 control-label" for="status">Status
                          <i class="red">*</i>
                          </label>
                          <div class="col-sm-6 col-lg-8 controls">
                              <select class="form-control" id="status" name="status">
                                <option value="">-Status-</option>
                                <option value="1" >Active</option>
                                <option value="0" >Deactive</option>
                              </select>
                             <span id="err_status" style="color:red;">{{ $errors->first('status') }}</span>
                          </div>
                        </div>
                    </div>

                    <br>
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                         <button type="button" id="btn_save" name="btn_save" class="btn btn-success" >Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

<!-- END Main Content -->

<link href="{{url('/')}}/public/front/css/bootstrap-datepicker.min.css" rel=stylesheet type="text/css" />

<script>
$(document).ready(function ()
{
    var today = new Date();
    var end_date = $('#end_date').val();
    
    $('#start_date').datepicker({
        format    : 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose : true,
        endDate : end_date
    });

    $('#end_date').datepicker({
        format    : 'yyyy-mm-dd',
        autoclose : true,
        startDate   : end_date
    });
});

$('#btn_save').click(function(){
    var price          = $('#price').val();
    var status         = $('#status').val();
    var start_date     = $('#start_date').val();
    var end_date       = $('#end_date').val();

    if ($.trim(price) == '') 
    {
        $('#err_price').show();
        $('#price').focus();
        $('#err_price').html('Please enter price');
        $('#err_price').fadeOut(8000);
        return false;
    }
    else if ($.trim(start_date) == '')
    {
        $('#err_start_date').show();
        $('#status').focus();
        $('#err_start_date').html('Please select start expiry date.');
        $('#err_start_date').fadeOut(8000);
        return false;
    }
    else if ($.trim(end_date) == '')
    {
        $('#err_end_date').show();
        $('#status').focus();
        $('#err_end_date').html('Please select end expiry date.');
        $('#err_end_date').fadeOut(8000);
        return false;
    }
    else if(Date.parse(start_date) >= Date.parse(end_date)) {
        $('#err_end_date').show();
        $('#err_end_date').html('End date should not be equal or should be greater than start date');
        $('#err_end_date').fadeOut(8000);
        return false;
    }
    else if ($.trim(status) == '')
    {
        $('#err_status').show();
        $('#status').focus();
        $('#err_status').html('Please select status');
        $('#err_status').fadeOut(8000);
        return false;
    }
    else
    {
        $('#frm_discount_code').submit();
    }
  });
</script>
@stop                    
