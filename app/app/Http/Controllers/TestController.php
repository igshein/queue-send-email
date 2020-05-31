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

    public function index()
    {
        $messageScheduleID = 'your_email@gmail.com';
        SendEmails::dispatch($messageScheduleID)->delay(now()->addSeconds(10));

        return 'Test';

    }
}
