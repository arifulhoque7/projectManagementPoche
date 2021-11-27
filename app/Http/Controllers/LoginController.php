<?php

namespace App\Http\Controllers;

use App\Models\AdminModal;
use App\Models\UserModal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function index()
    {
        return view('login');
    }

    function checkLogin(Request $request)
    {
        // return $request;
        $validateData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);


        $findEmailinUser = UserModal::where('email', $request->email)->first();

        if ($findEmailinUser != null) {
            if (Hash::check($request->password, $findEmailinUser->password)) {
                session()->put([
                    'name' => $findEmailinUser->name,
                    'designation' =>  $findEmailinUser->designation,
                    'mobile' => $findEmailinUser->mobile,
                    'email' => $findEmailinUser->email,
                    'user_type' => $findEmailinUser->user_type
                ]);

                if ($request->checked == 'true') {
                    cookie('email', $findEmailinUser->email, 1051200);
                }
                return response()->json(['status' => 'true', 'message' => 'Password is correct']);
            } else {
                return response()->json(['status' => 'false', 'message' => 'Please Enter Correct Password']);
            }
        } else {
            $findEmailinAdmin = AdminModal::where('email', $request->email)->first();
            if ($findEmailinAdmin != null) {
                if (Hash::check($request->password, $findEmailinAdmin->password)) {
                    session()->put([
                        'name' => $findEmailinAdmin->name,
                        'designation' =>  $findEmailinAdmin->designation,
                        'mobile' => $findEmailinAdmin->mobile,
                        'email' => $findEmailinAdmin->email,
                        'user_type' => $findEmailinAdmin->user_type
                    ]);

                    if ($request->checked == 'true') { 
                        cookie('email', $findEmailinUser->email, 1051200); 
                    }

                    return response()->json(['status' => 'true', 'message' => 'Password is correct']);
                } else {
                    return response()->json(['status' => 'false', 'message' => 'Please Enter Correct Password']);
                }
            }
        }


        return response()->json(['status' => 'false', 'message' => 'Please Enter Correct Email and Password to Login']);
    }
    function logout()
    {
        session()->forget('name');
        session()->forget('designation');
        session()->forget('mobile');
        session()->forget('email');
        session()->forget('user_type');
        return redirect()->route('login.view');
    }
}
