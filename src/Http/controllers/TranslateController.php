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
            return true;
        }
        return false;
    }
    public function download(){
        $download = Artisan::call('poeditor:download');
        if($download){
            return true;
        }
        return false;
    }
}
