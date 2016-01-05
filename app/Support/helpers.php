<?php
use Image;
function web_url()
{
    return URL::to('/');
}

function upload_image($file){
    $file_name = time();
    $file_name .= rand();

    $ext =  $file->getClientOriginalExtension();
    $big=Image::make($file)->resize(150,150);
    $big->save(public_path()."/uploads/big/".$file_name.".".$ext,100);
    return $file_name.".".$ext;
}
function upload_program_image($file){
    $file_name = time();
    $file_name .= rand();

    $ext =  $file->getClientOriginalExtension();
    $img=Image::make($file);
    $big=Image::make($file)->resize(1920,null);
    $big->save(public_path()."/uploads/big/".$file_name.".".$ext,100);
    $medium=$img->resize(1280,null);
    $img->save(public_path()."/uploads/medium/".$file_name.".".$ext,100);
    $small=$img->resize(600,null);
    $img->save(public_path()."/uploads/small/".$file_name.".".$ext,100);
    return $file_name.".".$ext;
}