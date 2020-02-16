<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUpload extends Controller
{
    //
    public function uploadImages()
        {
        $folder = uniqid();
        if (!\Storage::exists($folder)) {
                \Storage::disk('posts')->makeDirectory($folder);
        }

        $imgpath = \Storage::disk('posts')->put($folder,request()->file('file'));

        return \Response::json(['folder' => $folder, 'location' => '/storage/uploads/posts/'.$imgpath]);
    }
}
