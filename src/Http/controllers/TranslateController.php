<?php

namespace NextApps\PoeditorSync\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class TranslateController extends Controller
{
    public function send(){
        $upload = Artisan::call('poeditor:upload');
        if($upload){
            return response()->json([
                'success'=>'true',
                'message'=>'local files uploaded successully',
                'code'=>'200',
            ]);
        }
        return response()->json([
            'success'=>'false',
            'message'=>'error uploading local files',
            'code'=>'200',
        ]);
    }
    public function download(){
        $download = Artisan::call('poeditor:download');
        return response()->json([
            'success'=>'true',
            'message'=>'local files downloaded successully',
            'code'=>'200',
        ]);
    }
}
