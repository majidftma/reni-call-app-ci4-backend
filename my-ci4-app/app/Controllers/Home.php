<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // return view('welcome_message');
        // return view('home_page');
        return view('wp-home-page');
    }
    public function terms(){
        return view('terms-and-conditions');
    }

    public function privacy(){
        return view('privacy-policy');
    }

    public function about(){
        return view('about-us');
    }


}
