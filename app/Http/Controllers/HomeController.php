<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;


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
    public function index(){
        $images = Image::orderBy('id', 'desc')->paginate(12);
        return view('home',[
            'images' => $images
        ]);
    }
}
