<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        return view('dashboard.admin.profile');
    }

    public function login()
    {
        if(!Auth::check()){
            $setting = Setting::first();
            return view('dashboard.admin.login',[
                'setting' => $setting
            ]);
        }else{
            return redirect('/');
        }

    }
    public function login_check(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                Auth::login($user);
                return redirect('/');
            }else{
                return back()->with('error', 'Credentials not matched');
            }
        }else{
            return back()->with('error', 'Credentials not found');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
