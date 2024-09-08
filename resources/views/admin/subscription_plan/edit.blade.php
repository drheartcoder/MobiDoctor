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
          <i class="fa fa-envelope"></i>
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
            <form method="post" action="{{$module_url_path.'/update/'.$enc_id}}" id="validation-form" class="form-horizontal" files="true" enctype="multipart/form-data" > 
            {{ csrf_field() }}
              
            <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label" for="name">Name<i class="red">*</i></label>
                <div class="col-sm-6 col-lg-4 controls">
                <input type="text" name="name" placeholder="Name" id="name" class="form-control"  data-rule-required="true" value="{{isset($arr_subscription_plan['name'])?$arr_subscription_plan['name']:''}}">
                </div>
            </div>  

            <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label" for="name">Monthly Price<i class="red">*</i></label>
                <div class="col-sm-6 col-lg-4 controls">
                <input type="text" name="monthly_price" placeholder="Monthly Price" id="monthly_price" class="form-control"  data-rule-required="true" value="{{isset($arr_subscription_plan['monthly_price'])?$arr_subscription_plan['monthly_price']:'0'}}">
                </div>
            </div> 

            <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label" for="price">Yearly Price<i class="red">*</i></label>
                <div class="col-sm-6 col-lg-4 controls">
                <input type="text" name="yearly_price" placeholder="Yearly Price" id="yearly_price" class="form-control" data-rule-number="true" data-rule-required="true" value="{{isset($arr_subscription_plan['yearly_price'])?$arr_subscription_plan['yearly_price']:''}}" disabled>
                </div>
            </div> 

            <input type="hidden" name="total_price" id="total_price">

            <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label" for="name">Consultation Price<i class="red">*</i></label>
                <div class="col-sm-6 col-lg-4 controls">
                <input type="text" name="consultation_price" placeholder="Consultation Price" id="consultation_price" class="form-control"  data-rule-required="true" value="{{isset($arr_subscription_plan['consultation_price'])?$arr_subscription_plan['consultation_price']:''}}">
                </div>
            </div> 

            <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label" for="name">Prescription fee<i class="red">*</i></label>
                <div class="col-sm-6 col-lg-4 controls">
                <input type="text" name="prescription_fee" placeholder="Prescription fee" id="prescription_fee" class="form-control"  data-rule-required="true" value="{{isset($arr_subscription_plan['prescription_fee'])?$arr_subscription_plan['prescription_fee']:''}}">
                </div>
            </div>  

            <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label" for="name">Sick note fee<i class="red">*</i></label>
                <div class="col-sm-6 col-lg-4 controls">
                <input type="text" name="sick_note" placeholder="Sick note fee" id="sick_note" class="form-control"  data-rule-required="true" value="{{isset($arr_subscription_plan['sick_note'])?$arr_subscription_plan['sick_note']:''}}">
                </div>
            </div>  

            <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label" for="name">Referrals<i class="red">*</i></label>
                <div class="col-sm-6 col-lg-4 controls">
                <input type="text" name="referrals" placeholder="Referrals" id="referrals" class="form-control"  data-rule-required="true" value="{{isset($arr_subscription_plan['referrals'])?$arr_subscription_plan['referrals']:''}}">
                </div>
            </div>   

            <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label" for="price">Type                       
                </label>
                <div class="col-sm-6 col-lg-4 controls">
                <input type="text" name="type" readonly id="type" class="form-control" value="Yearly">
                </div>
            </div> 

            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
              <button type="submit" name="btn_subscription_plan" id="btn_subscription_plan" class="btn btn-success">Update</button>
             </div>
            </div>
            </form>
          </div>

        </div>
      </div>
    
 <script type="text/javascript">
    $(document).ready(function()
    {
        
        $("#monthly_price").keyup(function(){
            var monthly_price = $("#monthly_price").val();
            var yearly_price  = (monthly_price * 12);
            $("#yearly_price").val(yearly_price);
            $("#total_price").val(yearly_price);
        });

    });
   
 </script>
  <!-- END Main Content -->
  @stop
