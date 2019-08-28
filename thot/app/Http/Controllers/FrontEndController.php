<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function index() {
    	$datos=Usuario::all();
    	//dd($datosusuarios);
    	//return($datosusuarios);
        //return view('web.index', compact(varname:'datos'));
        return view('web.home')->with(['datos'=>$datos]);
        //return view('web.index')->with(['datos'=>$datos, 'variable2'=>$dos]);
    }
    public function usuario(){

    	
    }

}
