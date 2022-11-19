<?php

namespace App\Http\Controllers;

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

    public function vuePage()
    {
        return view('vuePage');
    }

    public function reactShow()
    {
        return view('react');
    }

    public function map()
    {
        return view('map');
    }

    public function voiceRecorder()
    {
        return view('voice');
    }
}
