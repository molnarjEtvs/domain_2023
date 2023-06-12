<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class domainController extends Controller
{
    public function listazas(){
        return view("welcome");
    }

    public function domainForm(){
        return view("domainform");
    }
}
