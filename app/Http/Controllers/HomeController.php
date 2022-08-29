<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showChat()
    {
        return view('chat');
    }
    public function viewMessage()
    {
        return view('viewMessage');
    }
}
