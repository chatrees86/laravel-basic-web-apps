<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function welcome(){

        $url = "https://bx.in.th/api/";
        $channel = curl_init($url);
        curl_setopt($channel, CURLOPT_RETURNTRANSFER, true);
        $bx_json = curl_exec($channel);
        if(curl_errno($channel)){
            echo 'Request Error:' . curl_error($channel);
            $bx_json = "{}";
        }
        $bx_markets = json_decode($bx_json, TRUE);
        
        return view('welcome', compact('bx_markets'));
    }
}
