<?php

namespace App\Http\Controllers;

use App\Modules\Common\Services\CommonService;
use App\Modules\Mail\Interfaces\MailInterface;
use App\Modules\MessageSchedule\Interfaces\MessageScheduleInterface;
use Pheanstalk\Pheanstalk;

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
        $pheanstalkStatus = (Pheanstalk::create('beanstalkd'))->stats();
        return view('home', compact('pheanstalkStatus'));
    }
}
