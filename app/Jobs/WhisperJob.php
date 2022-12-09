<?php

namespace App\Jobs;

use App\Notifications\WhisperNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class WhisperJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filepath, $org_lang, $target_lang, $model, $device = "cuda")
    {
        $this->filepath = $filepath;
        $this->org_lang = $org_lang;
        $this->target_lang = $target_lang;
        $this->model = $model;
        $this->device = $device;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $command = "whisper $this->filepath --lang $this->org_lang --model $this->model --device $this->device";

        $process = new Process([$command]);
        $process->run();

        if(!$process->isSuccessful())
            throw new ProcessFailedException($process);

        $user = Auth::user();
        Notification::send($user, new WhisperNotification());
        Cookie::queue('transcriptedFile', $this->filepath);
    }
}
