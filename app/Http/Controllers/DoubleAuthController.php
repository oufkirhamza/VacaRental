<?php

namespace App\Http\Controllers;

use App\Mail\DoubleAuthMailer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DoubleAuthController extends Controller
{
    //
    public function index(){

        return view('auth.dblFa');
    }
    public function authSwitcher()
    {
        $user = User::where("id", auth()->user()->id)->first();

        $code = rand(1000, 9999);

        if ($user) {
            $user->double_auth = !$user->double_auth;
            $user->auth_validate = $user->double_auth ? false : true;
            $user->save();
            if ($user->double_auth) {
                Mail::to($user->email)->send(new DoubleAuthMailer($code));
                $user->validation_code = $code;
                $user->save();    
                return redirect()->route("doubleAuth");
            }
        }
        return back();
    }

    public function validate2fa(Request $request)
    {

        request()->validate([
            "code" => "required"
        ]);
        $user = User::where("id", auth()->user()->id)->first();

        if ($request->code == $user->validation_code) {

            $user->auth_validate = true;
            $user->save();
            return redirect()->route("dashboard");
        }else {
            return back();
        }

    }
}
