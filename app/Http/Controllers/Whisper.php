<?php

namespace App\Http\Controllers;


use http\Client\Request;
use Symfony\Component\Console\Input\Input;

class Whisper extends Controller
{
    function postFile(Request $request){
        dd(Input::all());
    }
}
