@extends('front.patient.layout.master')
@section('main_content')

<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                @include('front.patient.layout._leftbar')
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="payment-card default-card">
                            <h4><b>VISA</b> <span>Default Card</span></h4>
                            <div class="payment-card-details">
                                <div class="card-info">
                                    <p>Exp: 10 June 2020</p>
                                    <p>**** **** ****5261</p>
                                </div>
                                <div class="two-btns">
                                    <div class="half-btns"><button class="green-trans-btn">Remove Card</button></div>
                                    <div class="half-btns"><button class="green-btn">Select Card</button></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="payment-card">
                            <h4><b>Master Card</b></h4>
                            <div class="payment-card-details">
                                <div class="card-info">
                                    <p>Exp: 22 June 2022</p>
                                    <p>**** **** ****8526</p>
                                </div>
                                <div class="two-btns">
                                    <div class="half-btns"><button class="green-trans-btn">Remove Card</button></div>
                                    <div class="half-btns"><button class="green-btn">Select Card</button></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right-btn">
                    <a href="javascript:void(0)" class="add-card-btn green-btn">+ Add a Card</a>
                </div>
                <div class="white-wrapper prescription-wrapper add-card-form">
                    <h2>Add a Card</h2>
                    <div class="prescription-section">
                        <div class="row">
                            <!--<div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Select Card</label>
                                    <select>
                                        <option>Smoking</option>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Card Type</label>
                                    <select>
                                        <option>Card Type</option>
                                        <option>Master Card</option>
                                        <option>Debit Card</option>
                                        <option>Credit Card</option>
                                    </select>
                                </div>
                            </div>-->
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Card Number</label>
                                    <input type="text" placeholder="Enter Card Number" />
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Card Verification Number</label>
                                    <input type="text" placeholder="Enter Card Verification Number" />
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Name on Card</label>
                                    <input type="text" placeholder="Enter Name on Card" />
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Expiry Date</label>
                                    <div class="date-input relative-block">
                                        <input class="date-input" id="datepicker" type="text" placeholder="Select Expiry Date" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="save-btn">
                            <button class="green-trans-btn">Save</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--datepicker strat-->
<script src="{{url('/')}}/public/front/js/bootstrap-datepicker.min.js"></script>
<link href="{{url('/')}}/public/front/css/bootstrap-datepicker.min.css" rel=stylesheet type="text/css" />
<!--datepicker end-->

<script>
    $("#datepicker").datepicker({
        todayHighlight: true,
        autoclose: true
    });
</script>
<script>
    $('.add-card-btn').click(function(){
        $('.add-card-form').toggleClass('active');
    });
</script>

@endsection