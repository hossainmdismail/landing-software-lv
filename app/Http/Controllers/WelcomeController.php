<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WelcomeController extends Controller
{
    public function welcome(){
        return view('welcome');
    }

    public function welcome_store(Request $request){

        $validate = Validator::make($request->all(), [
            'web_name' => 'required',
            'domain' => 'required',
            'email' => 'required',
            'password' => 'required',
        ],[
            'domain' => 'Domain is required',
            'web_name'  => 'Web Name is required',
            'email' => 'Email is required',
            'password' => 'Password is required',
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }
    }
}
