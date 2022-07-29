<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SKPDController extends Controller
{
    public function addprodukhukum(){
        return view('auth.skpd.addprodukhukum');
    }
}
