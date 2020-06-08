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
        $sendEmails = $this->getLogsSendEmails();
        return view('home', compact('pheanstalkStatus', 'sendEmails'));
    }

    public function getStatistic()
    {
        $pheanstalkStatus = (Pheanstalk::create('beanstalkd'))->stats();
        return view('table-statistic', compact('pheanstalkStatus'));
    }

    private function getLogsSendEmails(int $lastRowCount = 10): array
    {
        $path = storage_path().'/logs/email.log';
        $tail = shell_exec("tail -n $lastRowCount $path");
        $rows = explode(PHP_EOL, $tail);
        $sendEmails = [];
        foreach ($rows as $row)
        {
            if ($row !== '') {
                $sendEmails[] = str_replace("local ## production develop local.INFO:", '', $row);
            }
        }
        return $sendEmails;
    }
}
