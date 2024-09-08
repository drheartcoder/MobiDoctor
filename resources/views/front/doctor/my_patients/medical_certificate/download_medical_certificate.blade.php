<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/front/css/mobi-doctor.css" /> 
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-9 col-lg-9">
                <div class="content">
                    <div class="white-wrapper prescription-wrapper history-wrapper">   
                        <div class="medical-certificate-section">        
                            <div class="medical-certificate-bx">
                                <div class="medical-certification-title">Medical Certificate</div>
                                <div class="infomation-add-certi">
                                    <div class="medi-info-add">Dr. {{ $doctor_name }}</div>
                                    <div class="medi-info-add">{{$address or ''}}</div>
                                    <div class="medi-info-add">Phone : {{$mobile_no or ''}}</div>
                                    <div class="medi-info-add date-of-certi">Date: {{$todays_date}} </div>
                                    <div class="medi-info-add certi-dr-description">Dr {{$doctor_name}}, after careful examination on {{$todays_date}}, hereby certify that {{$patient_name}} is suffering from {{ $for_reason }}.I consider that a period of absence from {{ $reason }} during {{ $from_date }} to {{ $to_date }} is absolutely necessary for the restoration of their health.</div>
                                </div>
                                <div class="medi-info-add">Yours Sincerely</div>
                                <div class="medi-info-add">Dr. {{ $doctor_name }} </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
