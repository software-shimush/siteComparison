<?php

namespace App\Http\Controllers;
// ini_set('max_execution_time', 200);

use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $file = uniqid('img_').'.png'; 
        Browsershot::url('https://Google.com')->fullPage()->save($file);
        return view('home');
    }
}
