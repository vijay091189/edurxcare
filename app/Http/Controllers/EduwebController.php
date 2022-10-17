<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EduwebController extends Controller
{
    public function homepage(Request $request){
        return view("welcome")->with($data);
    }
}
