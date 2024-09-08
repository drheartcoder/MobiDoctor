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
                    <h2>Prescription</h2>
                    <div class="prescription-section" id="list-wrapper">
                        
                        @if( isset( $arr_prescription['data'] ) && sizeof( $arr_prescription['data'] )>0 )  
                            @foreach( $arr_prescription['data'] as $key => $data )
                                <div class="prescri-block">
                                    <div class="prescri-icon bg-img">&nbsp;</div>
                                    <div class="prescri-name"><span class="doc-name"> Prescription  
                                    </span> - {{ isset( $data['created_at'] ) ? date('d-M-Y',strtotime($data['created_at'])) : '00-00-0000' }}</div>
                                    <div class="clearfix"></div>
                                    <div class="view-btns">
                                        
                                        <?php
                                            $file_path = 'javascript:void(0)';
                                            
                                            $file_id = isset( $data['id'] ) ? base64_encode( $data['id'] ) : '';
                                            $file    = isset( $data['name'] ) && !empty( $data['name'] ) ? $data['name'] : '';

                                            if( isset( $file ) && !empty( $file ) && File::exists( $prescription_file_base_path.'/'.$file ) ):
                                                $file_path = $prescription_file_public_path.'/'.$file;
                                            endif;  
                                        ?>

                                        <a class="view" href="{{ $module_url_path }}/view/{{ $file_id }}"><i class="fa fa-eye"></i></a>
                                        
                                        @if($file_path!='')
                                            <a class="download" id="dec_image{{$key}}" data-name="image{{$key}}" data-file="{{ $file }}" data-path="{{ $file_path }}" href="{{$file_path}}" download><i class="fa fa-download"></i></a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            <div class="pagination-block">{{ ( isset( $arr_pagination ) && sizeof( $arr_pagination ) > 0 ) ? $arr_pagination->links() : '' }}</div>

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
</div>
<script type="text/javascript">
    $(document).ready(function()
    {   
        /*--------------------------Decrypt Data Presciption Starts----------------*/
       
        var record_length = $('#list-wrapper').children('div').length - 1;
        
        for( i = 0; i<record_length; i++)
        {
            if( $("#dec_image"+i).length )
            {
                var name = $("#dec_image"+i).data('name');
                var file = $("#dec_image"+i).data('file');
                var path = $("#dec_image"+i).data('path');
                decrypt_file(name, file, path);
            }
        }
        
        /*--------------------------Decrypt Data Presciption End----------------*/
    })
</script>

@endsection