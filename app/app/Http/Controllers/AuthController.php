<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\Team;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\UnauthorizedException;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function auth(AuthRequest $request){
        try{
            $auth = Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ],true);
            if(!$auth) throw new UnauthorizedException(__('errors.auth_invalid'));
            $user = auth()->user();

            return redirect(RouteServiceProvider::HOME);

        }catch (\Exception $e){
            $this->destroy();
            return back()->withInput($request->all())->withErrors($e->getMessage());
        }
    }

    public function destroy(){
        Session::flush();
        Auth::logout();
    }

    public function logout(Request $request){
       $this->destroy();
        return redirect(route('login'));
    }


}
