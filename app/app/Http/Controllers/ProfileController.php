<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(){
        $user = auth()->user();
        return view('profile.show',['user'=>$user]);
    }

    public function save(ProfileRequest $request){
        $user = ProfileService::saveProfile($request);
        return new ProfileResource($user);
    }
}
