@extends('front.patient.layout.master')
@section('main_content')

    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-3 col-lg-3">
                   @include('front.patient.layout._leftbar')
                </div>
                <div class="col-sm-8 col-md-9 col-lg-9">
                    <div class="white-wrapper prescription-wrapper">
                    <h2>Consultation</h2>
                        @if(isset($arr_transactions['data']) && sizeof($arr_transactions['data'])>0)
                            <div class="table-responsive custom-table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="trans-date">Transaction ID</th>
                                            <th>Consultation ID</th>
                                            <th class="trans-date">Transaction Date</th>
                                            <th style="min-width: 110px;">Invoice No.</th>
                                            <th>Paid Amount<b> (€)</b></th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($arr_transactions['data'] as $key => $transactions)    
                                        <tr>
                                            <td>{{isset($transactions['transaction_id'])?$transactions['transaction_id']:'-'}}</td>
                                            <td>{{isset($transactions['consultation_id'])?$transactions['consultation_id']:'-'}}</td>
                                            <td>{{isset($transactions['created_at'])?date('d-M-Y',strtotime($transactions['created_at'])) : '00-00-0000'}}</td>
                                            <td>{{isset($transactions['invoice_no'])?$transactions['invoice_no']:'-'}}</td>
                                            <td>{{isset($transactions['paid_amount'])?$transactions['paid_amount']:'0.00'}}</td>
                                            <td class="green-text" @if(isset($transactions['status']) && $transactions['status']!='paid') style="color: red;"@endif>{{isset($transactions['status'])?ucfirst($transactions['status']):'-'}}</td>
                                            <td> <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{$module_url_path}}/consultation/view_transaction?id={{isset($transactions['id'])?base64_encode($transactions['id']):0}}"  title="View"><i class="fa fa-eye" ></i></a> </td>
                                        </tr>
                                    @endforeach    
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination-block">
                                {{-- <ul>
                                    <li><a class="arrow" href="javascript:void(0)"><i class="fa fa-angle-left"></i></a></li>
                                    <li><a class="active" href="javascript:void(0)">1</a></li>
                                    <li><a href="javascript:void(0)">2</a></li>
                                    <li><a href="javascript:void(0)">3</a></li>
                                    <li><a class="arrow" href="javascript:void(0)"><i class="fa fa-angle-right"></i></a></li>
                                </ul> --}}
                                {{-- <ul> --}}
                                {{ (isset($arr_pagination) && sizeof($arr_pagination)>0) ? $arr_pagination->links() : ''}}
                                {{-- </ul> --}}
                            </div>
                        @else
                            <div class="no-date-found-bx">
                                <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                <div class="no-record-txt">No Record Found </div>                    
                            </div>
                        @endif    
                    </div>
                </div>
            </div>
        </div>
    </div> 
    
@endsection