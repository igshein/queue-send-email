<?php

namespace App\Http\Controllers;

use App\Modules\MessageSchedule\Interfaces\MessageScheduleInterface;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use Pheanstalk\Pheanstalk;

class MessageController extends Controller
{
    private $messageSchedule;

    public function __construct(MessageScheduleInterface $messageSchedule)
    {
        $this->middleware('auth');
        $this->messageSchedule = $messageSchedule;
    }

    public function createMailQueue(): string
    {
        Artisan::call("create:mail-queue");

        ## return redirect()->route('home');
        header("Location: /home?autoReload=1");
        exit;
    }
}
