@extends('front.doctor.layout.master')
@section('main_content')

    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-3 col-lg-3">
                @include('front.doctor.layout._leftbar')
                </div>
                <div class="col-sm-8 col-md-9 col-lg-9">
                    <div class="white-wrapper prescription-wrapper Support-faq-section">
                        <h2>FAQ</h2>
                        <div class="prescription-section">

                            <div id='faq_acc'>
                                @if( isset( $arr_faq['data'] ) && sizeof( $arr_faq['data'] ) > 0 )
                                    <ul>
                                        @foreach( $arr_faq['data'] as $key => $data )
                                            <li class='has-sub'>
                                                <a href='#'><span> {{isset( $data['question'] ) && !empty( $data['question'] ) ? decrypt_value( $data['question'] ) : ''}} </span> </a>
                                                <ul>
                                                    <li>
                                                        <div class="faq-text">
                                                            {{isset( $data['answer'] ) && !empty( $data['answer'] ) ? decrypt_value( $data['answer'] ) : ''}}
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        @endforeach    
                                    </ul>
                                  

                                @else
                                    <div class="no-date-found-bx">
                                        <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                        <div class="no-record-txt">No Record Found </div>                    
                                    </div>
                                @endif    
                            </div>

                            <div class="pagination-block">
                                {{ (isset($arr_paginate) && sizeof($arr_paginate)>0) ? $arr_paginate->links() : ''}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="{{ url('/public/front/js/accordian.js') }}"></script>
@endsection