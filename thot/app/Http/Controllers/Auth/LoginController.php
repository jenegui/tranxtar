<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
class LoginController extends Controller
{
    public function login()
    {
        $credentials=$this->validate(request(), [
            'email' => 'email|required|string', 
            'password' => 'required|string'
        ]);

        //return $credentials;
        if(Auth::attempt($credentials))
         {
            //return 'Iniciaste session';
            return redirect()->route('dashboard'); 
         }
            //return back()->withErrors(['email'=>'Las credenciales ingresadas no concuerdan con nuestros registros.']);
            return back()
            ->withErrors(['email'=> trans('auth.failed')])
            ->withInput(request(['email']));

    } 
}
