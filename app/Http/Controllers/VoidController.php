<?php

namespace App\Http\Controllers;

class VoidController extends Controller
{

    public function un_404()
    {
        return view('layouts.404');
    }


    public function unavailable(){
        return view('layouts.unavailable');
    }


}
