<?php

namespace App\Http\Controllers;

use App\Modules\Mail\Interfaces\MailInterface;
use App\Modules\MessageSchedule\Interfaces\MessageScheduleInterface;

class HomeController extends Controller
{
    private $messageSchedule;
    private $mailService;

    public function __construct(MessageScheduleInterface $messageSchedule, MailInterface $mailService)
    {
        $this->middleware('auth');
        $this->messageSchedule = $messageSchedule;
        $this->mailService = $mailService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $messageSend = $this->mailService->getLogSend(10);
        $messagesInSchedule = $this->messageSchedule->getAll(10);

        return view('home', compact('messagesInSchedule', 'messageSend'));
    }
}
