<?php

namespace App\Http\Controllers;
use App\Jobs\SendEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendEmail()
    {
        $messageScheduleID = 2;
        SendEmails::dispatch($messageScheduleID)->delay(now()->addSeconds(10));

        return redirect()->route('home');
    }
}
