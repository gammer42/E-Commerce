<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Milon\Barcode\DNS1D;

class BarcodeController extends Controller
{
    public function generate(){
        return view('test');
    }
}
