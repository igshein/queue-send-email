<?php

namespace App\Jobs;

use App\Modules\Mail\Interfaces\MailInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    //protected $mailService;

    public function __construct($data)
    {
        $this->data = $data;
        //$this->mailService = $mailService;
    }

    public function handle(MailInterface $mailService)
    {
        $mailService->send($this->data['email'], $this->data['content']);
    }
}
