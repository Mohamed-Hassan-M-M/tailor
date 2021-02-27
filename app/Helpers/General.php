<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

function saveImage($folder, $img){
    $img -> store('/',$folder);//By default, this method will use your default disk. If you would like to specify another disk, pass the disk name as the second argument to the store method:
    $filename = $img->hashName();
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}
function deleteImage($image){
    $photo = Str::after($image, 'Dashboard/');
    $photo = base_path('public/Dashboard/' . $photo);
    unlink($photo);
}

