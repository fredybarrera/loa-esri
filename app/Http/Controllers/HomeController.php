<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', ['title' => 'Home']);
        // return view('authentication/login', ['title' => 'Login']);
    }
}
