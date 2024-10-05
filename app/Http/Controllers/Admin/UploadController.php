<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\HttpResponse;

class UploadController extends Controller
{
    use HttpResponse;

    public function upload(Request $request){
        $result = $request->file('file')->store('public/upload-files');
        return $this->success('Upload file thành công', $result, 200);    
    }
}
