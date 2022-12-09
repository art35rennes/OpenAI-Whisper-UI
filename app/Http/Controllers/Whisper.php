<?php

namespace App\Http\Controllers;


use App\Jobs\WhisperJob;
use Illuminate\Http\Request;

class Whisper extends Controller
{
    function post(Request $request){
        //dd($request->input());
        $file = $request->file("audio-file");

        $originalFileName = $file->getClientOriginalName();
        $timestamp = now()->toDateString();
        $directory = 'AudioFile/'.$originalFileName;
        $file->storeAs($directory, $originalFileName."-".$timestamp);

        $this->dispatch(new WhisperJob($originalFileName."-".$timestamp, $request->input("origine-audio"), $request->input("target-audio"), $request->input("name")));
    }
}
