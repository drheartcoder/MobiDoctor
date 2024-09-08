function validateImage (files,height,width,file_type) 
{
    var image_height = height || "";
    var image_width = width || "";
    if (typeof files !== "undefined") 
    {
        for (var i=0, l=files.length; i<l; i++) 
        {


            var blnValid = false;
            var ext = files[0]['name'].substring(files[0]['name'].lastIndexOf('.') + 1);
            if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG")
            {
                blnValid = true;
            }

            if(blnValid ==false) 
            { 
                //console.log('heres');
                swal("Invalid File","Sorry, " + files[0]['name'] + " is invalid, allowed extensions are: jpeg , jpg , png", "error");

                $(".fileupload-preview").html("");
                $(".fileupload").attr('class',"fileupload fileupload-new");
                $(".fileupload-preview").attr("src",$('#default_image').val());
                $('#remove').hide();
                $("#image").val('');
                if(typeof element_id != 'undefined')
                {
                    $("#"+element_id).val('');
                }


                return false;
            }
            else
            {   
                if(files[i].size > 2200000)
                {
                    swal('','Image size should be upto 2 MB only.','error');
                    $(".fileupload-preview").html("");
                    $(".fileupload").attr('class',"fileupload fileupload-new");
                    $(".fileupload-preview").attr("src",$('#default_image').val());
                    $('#remove').hide();
                    $("#image").val('');
                    if(typeof element_id != 'undefined')
                    {
                        $("#"+element_id).val('');
                    }
                    return false;
                }

                var reader = new FileReader();
                reader.readAsDataURL(files[0]);
                reader.onload = function (e) 
                {
                    $('#preview').attr('src', e.target.result);
                    $('#remove').show();
                    var image = new Image();
                    image.src = e.target.result;

                   
                     image.onload = function () 
                    {
                        var height = this.height;
                        var width = this.width;

                        if (height < image_height || width < image_width ) 
                        {
                            file_url = "";
                            if($('#oldimage').val() != '')
                            {
                                file_url = $('#prev_image_url').val();
                                
                            }
                            else if($('#default_image').val() != '')
                            {
                                file_url = $('#prev_image_url').val();
                            }

                            file_url = $('#prev_image_url').val();
                            swal("","Height and Width must be greater than or equal to "+image_height+" X "+image_width+"." ,"error");
                            $(".fileupload-preview").next().attr("src",file_url);
                            $(".fileupload").attr('class',"fileupload fileupload-new up-image-block" );
                            $("#preview").attr("src",$('#default_image').val());
                            $("#image").val('');
                            $('#remove').hide();
                            if(typeof element_id != 'undefined')
                            {
                                $("#"+element_id).val('');
                            }
                            return false;
                        }
                        else
                        {
                        //swal("Uploaded image has valid Height and Width.");
                            return true;
                        }
                    };

                }

            }                

        }

    }
    else
    {
        swal("","No support for the File API in this web browser" ,"error");
    } 
}
function removeImagePreview(file_type)
{
    $(".fileupload-preview").html("");
    $(".fileupload").attr('class',"fileupload fileupload-new");
    $("#preview").attr("src",$('#default_image').val());

    if(file_type=='admin_profile_image')
    {
        $("#image").val('');
        $('#remove').hide();

    }

}
function removeFile()
{
    $('.fileupload-preview').attr('src',$('#prev_image_url').val());
    $("#image").val('');
    $('#remove').hide();
}

function validatePanCard (files,height,width,file_type) 
{
    var image_height = height || "";
    var image_width = width || "";
    if (typeof files !== "undefined") 
    {
        for (var i=0, l=files.length; i<l; i++) 
        {


            var blnValid = false;
            var ext = files[0]['name'].substring(files[0]['name'].lastIndexOf('.') + 1);
            if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG"|| ext == "PDF" || ext == "pdf")
            {
                blnValid = true;
            }

            if(blnValid ==false) 
            { 
                swal("Invalid File","Sorry, " + files[0]['name'] + " is invalid, allowed extensions are: jpeg , jpg , png", "error");

                $("#preview_pan_card").attr("src","http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+file");
                $("#file_pan_card").val('');
                if(typeof element_id != 'undefined')
                {
                    $("#"+element_id).val('');
                }


                return false;
            }
            else
            {   
                if(files[i].size > 2200000)
                {
                    swal('','Image size should be upto 2 MB only.','error');
                    $("#preview_pan_card").attr("src","http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+file");
                    $("#file_pan_card").val('');

                    if(typeof element_id != 'undefined')
                    {
                        $("#"+element_id).val('');
                    }
                    return false;
                }

                var reader = new FileReader();
                reader.readAsDataURL(files[0]);
                reader.onload = function (e) 
                {

                    if(ext == "PDF" || ext == "pdf")
                    {
                        $("#preview_pan_card").attr("src",$('#pdf_image').val());
                    }
                    else
                    {
                        $('#preview_pan_card').attr('src', e.target.result);
                    }
                    $('#remove').show();
                    var image = new Image();
                    image.src = e.target.result;
                }

            }                

        }

    }
    else
    {
        swal("","No support for the File API in this web browser" ,"error");
    } 
}

function validateAadharCard (files,height,width,file_type) 
{
    var image_height = height || "";
    var image_width = width || "";
    if (typeof files !== "undefined") 
    {
        for (var i=0, l=files.length; i<l; i++) 
        {


            var blnValid = false;
            var ext = files[0]['name'].substring(files[0]['name'].lastIndexOf('.') + 1);
            if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG"|| ext == "PDF" || ext == "pdf")
            {
                blnValid = true;
            }

            if(blnValid ==false) 
            { 
                swal("Invalid File","Sorry, " + files[0]['name'] + " is invalid, allowed extensions are: jpeg , jpg , png", "error");
                $("#preview_aadhar_card").attr("src","http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp?text=no+file");
                $("#file_aadhar_card").val('');
                if(typeof element_id != 'undefined')
                {
                    $("#"+element_id).val('');
                }


                return false;
            }
            else
            {   
                if(files[i].size > 2200000)
                {
                    swal('','Image size should be upto 2 MB only.','error');
                    $("#preview_aadhar_card").attr("src","http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+file");
                    $("#file_aadhar_card").val('');
                    if(typeof element_id != 'undefined')
                    {
                        $("#"+element_id).val('');
                    }
                    return false;
                }

                var reader = new FileReader();
                reader.readAsDataURL(files[0]);
                reader.onload = function (e) 
                {
                    if(ext == "PDF" || ext == "pdf")
                    {
                        $("#preview_aadhar_card").attr("src",$('#pdf_image').val());
                    }
                    else
                    {
                        $('#preview_aadhar_card').attr('src', e.target.result);
                    }
                    $('#remove').show();
                    var image = new Image();
                    image.src = e.target.result;

                }

            }                

        }

    }
    else
    {
        swal("","No support for the File API in this web browser" ,"error");
    } 
}