<?php

namespace App\Http\Controllers;

use App\Modules\Common\Services\CommonService;
use App\Modules\Customer\Models\Customer;
use App\Modules\Mail\Interfaces\MailInterface;
use App\Modules\MessageSchedule\Interfaces\MessageScheduleInterface;

class HomeController extends Controller
{
    private $messageSchedule;
    private $mailService;
    private $commonService;

    public function __construct(MessageScheduleInterface $messageSchedule, MailInterface $mailService, CommonService $commonService)
    {
        $this->middleware('auth');
        $this->messageSchedule = $messageSchedule;
        $this->mailService = $mailService;
        $this->commonService = $commonService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customers = Customer::select()->limit(10)->get();
        $messageSend = $this->mailService->getLogSend(10);
        $messagesInSchedule = $this->messageSchedule->getAll(10);
        $dateTime = $this->commonService->now(10);

        return view('home', compact('customers', 'messagesInSchedule', 'messageSend', 'dateTime'));
    }
}
