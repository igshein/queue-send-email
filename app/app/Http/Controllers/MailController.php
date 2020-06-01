<?php

namespace App\Http\Controllers;
use App\Jobs\SendEmails;

class MailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendEmail()
    {
        $messageScheduleID = 2;
        $delay = 2;
        SendEmails::dispatch($messageScheduleID)->delay(now()->addSeconds($delay));

        return redirect()->route('home');
    }
}
