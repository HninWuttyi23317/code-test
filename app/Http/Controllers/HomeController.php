<?php

namespace App\Http\Controllers;

use view;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        return view('layouts.main');
    }
    function contact(){
        return view('contact');
    }
    function about(){
        return view('about');
    }
}
