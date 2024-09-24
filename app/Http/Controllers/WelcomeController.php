<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Spatie\Image\Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WelcomeController extends Controller
{
    public function welcome(){
        $setting = Setting::first();
        if($setting){
            return view('dashboard.index');
        }else{

            return view('welcome');
        }
    }

    public function welcome_store(Request $request){

        $validate = Validator::make($request->all(), [
            'web_name'  => 'required',
            'domain'    => 'required',
            'email'     => 'required',
            'password'  => 'required',
        ],[
            'domain'    => 'Domain is required',
            'web_name'  => 'Web Name is required',
            'email'     => 'Email is required',
            'password'  => 'Password is required',
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $setting = new Setting;
        $setting->web_name = $request->web_name;
        if($request->hasFile('web_logo')){
            $file = $request->file('web_logo');
            $file->move(public_path('uploads/web/'), $file->getClientOriginalName());
            $setting->web_logo = $file->getClientOriginalName();
        }
        if($request->hasFile('web_fav')){
            $file = $request->file('web_fav');
            $file->move(public_path('uploads/web/'), $file->getClientOriginalName());
            $setting->web_fav = $file->getClientOriginalName();
        }

        $setting->domain = $request->domain;
        $setting->email = $request->email;
        $setting->address = $request->address;
        $setting->save();
        return redirect('/');






    }
}
