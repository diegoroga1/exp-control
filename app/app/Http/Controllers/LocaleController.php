<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function setLocale(){
        $locale = request()->post('locale');
        Session::put('locale',$locale);
        return back();
    }

    public function getLocaleMessages(){
        $data = json_decode(file_get_contents(__DIR__.'/../../../resources/lang/'.session('locale').'.json',true));
        return response()->json($data);
    }
}
