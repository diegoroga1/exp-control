<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileService {
    /**
     * Set or unset password with hash for save
     * @param Request $request
     * @return array
     */
    public static function parseSaveData(Request $request): array{
        $req = $request->all();
        if(!$req['password']){
            unset($req['password']);
        }else{
            $req['password'] = Hash::make($req['password']);
        }
        return $req;
    }

    public static function saveProfile(Request $request){
        $req = self::parseSaveData($request);
        $user = User::updateOrCreate(['id'=>$req['id']],$req);
        return $user;
    }
}
