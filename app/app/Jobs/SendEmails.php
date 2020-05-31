<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class SendEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $messageScheduleID;

    public function __construct($messageScheduleID)
    {
        $this->messageScheduleID = $messageScheduleID;
    }

    public function handle()
    {
        $date = Carbon::now()->timezone(env('DB_TIME_ZONE'))->format('Y-m-d H:i:s');
        Log::info('SEND EMAIL | ' . $this->messageScheduleID . " $date");
    }
}
