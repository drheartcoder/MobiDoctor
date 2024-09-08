@extends('front.patient.layout.master')
@section('main_content')

	<div class="page-wrapper">
        <div class="container">
            <div class="row">

                <div class="my-consultation-wrapper row">
                    
                    @if( isset( $arr_consultation ) && !empty( $arr_consultation ) )
                            
                        <?php
                            $id = isset( $arr_consultation['id'] ) && !empty( $arr_consultation['id'] ) ? base64_encode( $arr_consultation['id'] ) : '';
                            $consult_id   = isset( $arr_consultation['consultation_id'] ) && !empty( $arr_consultation['consultation_id'] ) ? base64_encode( $arr_consultation['consultation_id'] ) : '';
                            $consult_date = isset( $arr_consultation['date'] ) && !empty( $arr_consultation['date'] ) ? $arr_consultation['date'] : '';
                            $consult_time = isset( $arr_consultation['time'] ) && !empty( $arr_consultation['time'] ) ? $arr_consultation['time'] : '';

                            $booking_datetime = convert_datetime($consult_date.' '.$consult_time, 'user', 'datetime');
                            $consult_datetime = date( "h:i A, l d F, Y", strtotime($booking_datetime) );

                            $pat_first_name = isset( $arr_consultation['user_details']['first_name'] ) && !empty( $arr_consultation['user_details']['first_name'] ) ? decrypt_value( $arr_consultation['user_details']['first_name'] ) : '';
                            $pat_last_name = isset( $arr_consultation['user_details']['last_name'] ) && !empty( $arr_consultation['user_details']['last_name'] ) ? decrypt_value( $arr_consultation['user_details']['last_name'] ) : '';

                            $pat_name = $pat_first_name.' '.$pat_last_name;

                            $pat_profile_img = isset( $arr_consultation['user_details']['profile_image'] ) && !empty( $arr_consultation['user_details']['profile_image'] ) ? $arr_consultation['user_details']['profile_image'] : '';

                            $pat_img_src = $default_img_path .'/profile.jpeg';
                            if(isset($pat_profile_img) && $pat_profile_img != '' && file_exists($patient_image_base_path.'/'.$pat_profile_img)):
                                $pat_img_src = $patient_image_public_path.'/'.$pat_profile_img;
                            endif;

                            $doc_prefix = isset( $arr_consultation['doctor_details']['doctor_prefix']['name'] ) && !empty( $arr_consultation['doctor_details']['doctor_prefix']['name'] ) ? decrypt_value( $arr_consultation['doctor_details']['first_name'] ) : 'Dr.';
                            $doc_first_name = isset( $arr_consultation['doctor_details']['first_name'] ) && !empty( $arr_consultation['doctor_details']['first_name'] ) ? decrypt_value( $arr_consultation['doctor_details']['first_name'] ) : '';
                            $doc_last_name = isset( $arr_consultation['doctor_details']['last_name'] ) && !empty( $arr_consultation['doctor_details']['last_name'] ) ? decrypt_value( $arr_consultation['doctor_details']['last_name'] ) : '';

                            $doc_name = $doc_prefix.' '.$doc_first_name.' '.$doc_last_name;

                            $doc_profile_img = isset( $arr_consultation['doctor_details']['profile_image'] ) && !empty( $arr_consultation['doctor_details']['profile_image'] ) ? $arr_consultation['doctor_details']['profile_image'] : '';

                            $doc_img_src = $default_img_path .'/profile.jpeg';
                            if(isset($doc_profile_img) && $doc_profile_img != '' && file_exists($doctor_image_base_path.'/'.$doc_profile_img)):
                                $doc_img_src = $doctor_image_public_path.'/'.$doc_profile_img;
                            endif;

                            $patient_call_duration = isset( $arr_consultation['patient_call_duration'] ) && !empty( $arr_consultation['patient_call_duration'] ) ? $arr_consultation['patient_call_duration'] : '00:00:00';
                        ?>

                        <div id="div_device" class="panel panel-default" style="display: none;">
                            <div class="select">
                                <label for="audioSource">Audio source: </label><select id="audioSource"></select>
                            </div>
                            <div class="select">
                                <label for="videoSource">Video source: </label><select id="videoSource"></select>
                            </div>
                        </div>
                        
                        <div id="hms">{{ $patient_call_duration }}</div>

                        <div id="div_join" class="panel panel-default video-call-btn">
                            <div class="panel-body">
                                <button id="join" class="btn btn-primary" onclick="join()" style="display:none;">Start</button>
                                <button id="leave" class="btn btn-primary" onclick="leave()">Stop</button>

                                <button id="unmute" class="btn btn-primary" onclick="enableAudio()">Unmute</button>
                                <button id="mute" class="btn btn-primary" onclick="disableAudio()">Mute</button>

                                <button id="start_camera" class="btn btn-primary" onclick="enableVideo()">Start Camera</button>
                                <button id="stop_camera" class="btn btn-primary" onclick="disableVideo()">Stop Camera</button>

                                <!-- <button id="publish" class="btn btn-primary" onclick="publish()">Start My Camera</button>
                                <button id="unpublish" class="btn btn-primary" onclick="unpublish()">Stop My Camera</button> -->
                            </div>
                        </div>
                        
                        <input id="video" type="checkbox" checked></input>
                        
                        <div id="video" style="margin:0 auto;">
                            <div id="agora_local" style="float:right;width:210px;height:147px;display:inline-block;"></div>
                            <div id="agora_remote" style="float:left; width:810px;height:607px;display:inline-block;"></div>
                        </div>

                    @endif

                </div>

            </div>
        </div>
    </div>

    <script src="{{ url('/') }}/public/video/AgoraRTCSDK.js"></script>
    <script src="{{ url('/') }}/public/video/video_jquery.js"></script>

    <script type="text/javascript">
        var current_url = "{{url()->previous()}}";
        var video_jq = jQuery.noConflict(true);
        var video_call_timer;

        if(!AgoraRTC.checkSystemRequirements())
        {
            alert("Your browser does not support WebRTC!");
        }

        var client, localStream, camera, microphone;

        var audioSelect = document.querySelector('select#audioSource');
        var videoSelect = document.querySelector('select#videoSource');

        function CallTimer()
        {
            var startTime = document.getElementById('hms').innerHTML;

            var pieces = startTime.split(":");
            var time = new Date();
            
            time.setHours(pieces[0]);
            time.setMinutes(pieces[1]);
            time.setSeconds(pieces[2]);

            var timedif = new Date(time.valueOf() + 1000);
            var newtime = timedif.toTimeString().split(" ")[0];

            document.getElementById('hms').innerHTML = newtime;
        }

        function join()
        {
            var consult_id = "{{ base64_decode( isset($consult_id) ? $consult_id : '0' ) }}";
            var token      = "{{ csrf_token() }}";

            $.ajax({
                url     : "{{ $module_url_path }}/upcoming/video/initiate_patient_call",
                type    : "GET",
                data    : { _token:token, consult_id:consult_id },
                success : function(res)
                {
                    if(res == 'busy')
                    {
                        swal({
                            title: "",
                            text: 'Doctor is busy with another Call',
                            type: 'warning',
                            confirmButtonText: 'OK'
                        });
                        return false;
                    }

                    if(res == 'success')
                    {
                        //video_call_timer = setInterval(CallTimer, 1000);

                        document.getElementById("join").disabled  = true;
                        document.getElementById("leave").disabled = false;
                        document.getElementById("video").disabled = true;

                        var channel = "{{ base64_decode( isset($consult_id) ? $consult_id : '0' ) }}";
                        var channel_key = null;

                        //console.log("Init AgoraRTC client with App ID: {{ env('VIDEO_APP_ID') }}");
                        client = AgoraRTC.createClient({mode: 'live'});
                        client.init("{{ env('VIDEO_APP_ID') }}", function () 
                        {
                            //console.log("AgoraRTC client initialized");
                            client.join(channel_key, channel, null, function(uid) 
                            {
                                //console.log("User " + uid + " join channel successfully");
                                camera     = videoSource.value;
                                microphone = audioSource.value;

                                localStream = AgoraRTC.createStream({streamID: uid, audio: true, cameraId: camera, microphoneId: microphone, video: true, screen: false});
                                
                                if (document.getElementById("video").checked) 
                                {
                                    localStream.setVideoProfile('720p_3');
                                }

                                // The user has granted access to the camera and mic.
                                localStream.on("accessAllowed", function()
                                {
                                    //console.log("accessAllowed");
                                });

                                // The user has denied access to the camera and mic.
                                localStream.on("accessDenied", function()
                                {
                                    //console.log("accessDenied");
                                });

                                localStream.init(function()
                                {
                                    //console.log("getUserMedia successfully");
                                    localStream.play('agora_local');

                                    client.publish(localStream, function (err)
                                    {
                                        //console.log("Publish local stream error: " + err);
                                    });

                                    client.on('stream-published', function (evt)
                                    {
                                        //console.log("Publish local stream successfully");
                                    });
                                }, function (err)
                                {
                                    //console.log("getUserMedia failed", err);
                                });

                            }, function(err)
                            {
                                //console.log("Join channel failed", err);
                            });
                        }, function (err)
                        {
                            //console.log("AgoraRTC client init failed", err);
                        });

                        channelKey = "";
                        client.on('error', function(err) 
                        {
                            //console.log("Got error msg:", err.reason);
                            if (err.reason === 'DYNAMIC_KEY_TIMEOUT') 
                            {
                                client.renewChannelKey(channelKey, function()
                                {
                                    //console.log("Renew channel key successfully");
                                }, function(err)
                                {
                                    //console.log("Renew channel key failed: ", err);
                                });
                            }
                        });

                        client.on('stream-added', function (evt) 
                        {
                            var stream = evt.stream;
                            client.subscribe(stream, function (err) 
                            {
                                //console.log("Subscribe stream failed", err);
                            });
                        });

                        client.on('stream-subscribed', function (evt) 
                        {
                            video_call_timer = setInterval(CallTimer, 1000);

                            var stream = evt.stream;
                            stream.play('agora_remote');
                        });

                        client.on('peer-online', function (evt)
                        {
                            //video_call_timer = setInterval(CallTimer, 1000);
                        });

                        client.on('stream-removed', function (evt) 
                        {
                            var stream = evt.stream;
                            stream.stop();
                            $('#agora_remote').remove();

                            clearInterval(video_call_timer);

                            swal({
                                title              : 'Call Ended',
                                text               : 'Doctor has end the call.',
                                type               : 'warning',
                                showCancelButton   : false,
                                confirmButtonColor : '#63c2de',
                                confirmButtonText  : 'Ok',
                                cancelButtonText   : 'Reject',
                                closeOnConfirm     : false,
                                closeOnCancel      : true
                            },
                            function(isConfirm)
                            {
                                if(isConfirm == true)
                                {
                                    $("#leave").trigger('click');
                                }
                                else
                                {
                                    $("#leave").trigger('click');
                                }
                            });

                        });

                        client.on('peer-leave', function (evt)
                        {
                            var stream = evt.stream;
                            if (stream)
                            {
                                stream.stop();
                                $('#agora_remote').remove();

                                clearInterval(video_call_timer);

                                swal({
                                    title              : 'Call Ended',
                                    text               : 'Doctor has end the call.',
                                    type               : 'warning',
                                    showCancelButton   : false,
                                    confirmButtonColor : '#63c2de',
                                    confirmButtonText  : 'Ok',
                                    cancelButtonText   : 'Reject',
                                    closeOnConfirm     : false,
                                    closeOnCancel      : true
                                },
                                function(isConfirm)
                                {
                                    if(isConfirm == true)
                                    {
                                        $("#leave").trigger('click');
                                    }
                                    else
                                    {
                                        $("#leave").trigger('click');
                                    }
                                });
                            }
                        });
                    }
                }
            });
        }

        function leave() 
        {
            document.getElementById("join").disabled  = false;
            document.getElementById("leave").disabled = true;
            
            var consult_id = "{{ base64_decode( isset($consult_id) ? $consult_id : '0' ) }}";
            var token      = "{{ csrf_token() }}";
            var call_timer = $('#hms').text();
            
            $.ajax({
                url     : "{{ $module_url_path }}/upcoming/video/drop_patient_call",
                type    : "GET",
                data    : { _token:token, consult_id:consult_id, call_timer:call_timer },
                success : function(res)
                {
                    if(res == 'success')
                    {
                        var call_timer = $('#hms').text();

                        if( client != undefined )
                        {
                            client.leave(function () 
                            {
                                //console.log("Leave channel successfully");
                            },
                            function (err)
                            {
                                //console.log("Leave channel failed");
                            });
                        }

                        clearInterval(video_call_timer);

                        window.location.assign(current_url);
                    }
                }
            });
        }

        function enableAudio()
        {
            document.getElementById("mute").disabled   = false;
            document.getElementById("unmute").disabled = true;

            localStream.enableAudio();
        }

        function disableAudio()
        {
            document.getElementById("mute").disabled   = true;
            document.getElementById("unmute").disabled = false;

            localStream.disableAudio();
        }

        function enableVideo()
        {
            document.getElementById("stop_camera").disabled   = false;
            document.getElementById("start_camera").disabled = true;

            localStream.enableVideo();
        }

        function disableVideo()
        {
            document.getElementById("stop_camera").disabled   = true;
            document.getElementById("start_camera").disabled = false;

            localStream.disableVideo();
        }

        /*function publish()
        {
            document.getElementById("publish").disabled   = true;
            document.getElementById("unpublish").disabled = false;

            client.publish();
        }

        function unpublish()
        {
            document.getElementById("publish").disabled   = false;
            document.getElementById("unpublish").disabled = true;

            client.unpublish();
        }*/

        function getDevices()
        {
            AgoraRTC.getDevices(function (devices)
            {
                for (var i = 0; i !== devices.length; ++i)
                {
                    var device = devices[i];
                    var option = document.createElement('option');
                    option.value = device.deviceId;
                    if (device.kind === 'audioinput')
                    {
                        option.text = device.label || 'microphone ' + (audioSelect.length + 1);
                        audioSelect.appendChild(option);
                    }
                    else if (device.kind === 'videoinput')
                    {
                        option.text = device.label || 'camera ' + (videoSelect.length + 1);
                        videoSelect.appendChild(option);
                    }
                    else
                    {
                        //console.log('Some other kind of source/device: ', device);
                    }
                }
            });
        }

        function update_patient_call_duration()
        {
            var token      = "{{ csrf_token() }}";
            var consult_id = "{{ base64_decode( isset($consult_id) ? $consult_id : '0' ) }}";
            var call_timer = $('#hms').text();

            $.ajax({
                url     : "{{ $module_url_path }}/upcoming/video/update_patient_call_duration",
                type    : "GET",
                data    : { _token:token, consult_id:consult_id, call_timer:call_timer },
                success : function(res)
                {
                    if(res.call_status != '')
                    {
                        if( res.call_status == 'waiting_for_call_to_connect' )
                        {  }

                        if( res.call_status == 'waiting_for_doctor' )
                        {  }

                        if( res.call_status == 'reject_by_doctor' )
                        {
                            clearInterval(video_call_timer);

                            swal({
                                title              : 'Call Rejected',
                                text               : 'Doctor has rejected the call.',
                                type               : 'warning',
                                showCancelButton   : false,
                                confirmButtonColor : '#63c2de',
                                confirmButtonText  : 'Ok',
                                cancelButtonText   : 'Reject',
                                closeOnConfirm     : false,
                                closeOnCancel      : true
                            },
                            function(isConfirm)
                            {
                                if(isConfirm == true)
                                {
                                    $("#leave").trigger('click');
                                }
                                else
                                {
                                    $("#leave").trigger('click');
                                }
                            });
                        }

                        if( res.call_status == 'call_end' )
                        {
                            clearInterval(video_call_timer);

                            swal({
                                title              : 'Call Ended',
                                text               : 'Doctor has end the call.',
                                type               : 'warning',
                                showCancelButton   : false,
                                confirmButtonColor : '#63c2de',
                                confirmButtonText  : 'Ok',
                                cancelButtonText   : 'Reject',
                                closeOnConfirm     : false,
                                closeOnCancel      : true
                            },
                            function(isConfirm)
                            {
                                if(isConfirm == true)
                                {
                                    $("#leave").trigger('click');
                                }
                                else
                                {
                                    $("#leave").trigger('click');
                                }
                            });
                        }
                    }
                }
            });
        }

        getDevices();

        $(document).ready(function()
        {
            setTimeout(function()
            {
                $("#join").trigger('click');
            }, 4000);
            
            setInterval(function()
            {
                update_patient_call_duration();
            },5000);
        });

    </script>

@endsection