<?php

namespace App\Jobs;

use App\Modules\Mail\Services\MailService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $messageScheduleID;

    public function __construct($messageScheduleID)
    {
        $this->messageScheduleID = $messageScheduleID;
    }

    public function handle(MailService $mailService)
    {
        $mailService->send($this->messageScheduleID);
    }
}
