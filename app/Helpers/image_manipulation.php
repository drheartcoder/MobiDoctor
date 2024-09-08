<?php

/*
    Usage:  get_resized_image_path('d3f5be31e24a194366da81e5ad76a8328e1159df.jpeg','/uploads/cities/',250,260);
*/
    
function get_resized_image($image_file = FALSE,$dir=FALSE,$height=250,$width=250,$fallback_text="No Image Available")
{
    ini_set('memory_limit', '600M' );//THIS MEMORY LIMIT FOR RESOLOTION 10000 * 10000 Approx

    $CACHE_DIR             = 'resize_cache/';
    $CACHE_DIR_BASE_PATH   = base_path().'/uploads/'.$CACHE_DIR;
    $CACHE_DIR_PUBLIC_PATH = url('/').'/uploads/'.$CACHE_DIR;

    $real_dir  = $dir;
    $extension = get_extension($image_file);

    if($image_file == FALSE || $dir == FALSE)
    {
         return "https://placeholdit.imgix.net/~text?txtsize=33&txt=".$fallback_text."&w=".$width."&h=".$height;
    }

    /* Check if File Exists */
    if(!image_exists($real_dir.$image_file))
    {
        return "https://placeholdit.imgix.net/~text?txtsize=33&txt=".$fallback_text."&w=".$width."&h=".$height;
    }

    /* Check if Given file is image*/
    if(!is_valid_image($real_dir.$image_file))
    {   
        return "https://placeholdit.imgix.net/~text?txtsize=33&txt=No+Image&w=".$width."&h=".$height;
    }
    
    /* Generate Expected Resized Image Name */
    $expected_resize_image_name = generate_resized_image_name($image_file,$width,$height,$extension);

    if(!image_exists($CACHE_DIR_BASE_PATH.$expected_resize_image_name))
    {
        /* Create Cache Dir */
        $parent_dir =  dirname($real_dir.$expected_resize_image_name);
        @mkdir($CACHE_DIR_BASE_PATH,0777);
        $real_path   = $real_dir.$image_file;   
        $status = Image::make( $real_path )->resize( $width, $height )->save( $CACHE_DIR_BASE_PATH.$expected_resize_image_name );
    }
    return $CACHE_DIR_PUBLIC_PATH.$expected_resize_image_name;
}

function get_extension($image_file)
{
    $arr_part = array();
    $arr_part = explode('.', $image_file);
    return end($arr_part);
}

function is_valid_image($image_real_path)
{
   return @getimagesize($image_real_path);
}

function image_exists($image_real_path)
{
    if (!is_readable($image_real_path)) 
    {
        return FALSE;
    } 
    return TRUE;
}

function generate_resized_image_name($file_name,$width,$height,$extension)
{
    return substr($file_name, 0, strrpos($file_name, '.')) . '-' . $width . 'x' . $height . '.' . $extension;
}

function image_validate_note($height,$width,$module=false)
{
    if(isset($module) && $module!=false && $module=='country_flag')
    {
         return '<span>Allowed only jpg | jpeg | png '."<br>".'Please upload country flag with Height and Width less than or equal to '.$height.' X '.$width.'.</span>';
    }
    else if(isset($module) && $module!=false && $module=='language_flag')
    {
         return '<span>Allowed only jpg | jpeg | png '."<br>".'Please upload language flag with Height and Width less than or equal to '.$height.' X '.$width.'.</span>';
    }
    else if(isset($module) && $module!=false && $module=='account_setting')
    {
         return '<span>Allowed only jpg | jpeg | png '."<br>".'Please upload image with Height and Width greater than or equal to '.$height.' X '.$width.' for best result.<br>Image size should be upto 2 MB only.</span>';
    }
    else
    {
         return '<span>Allowed only jpg | jpeg | png '."<br>".'Please upload image with Height and Width less than or equal to '.$height.' X '.$width.'.</span>';
    }
   
} 

function email_validate_note($module = false)
{
    if(isset($module) && $module!=false && $module=='account_setting_email')
    {
         return '<span>If you can change email then next time login with this email.</span>';
    }
}

function payment_receipt_note($module = false)
{
    if(isset($module) && $module!=false && $module=='payment')
    {
         return '<span> Allowed only jpg | jpeg | png | pdf | doc | docx | txt. </span>';
    }
}