<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmails;
use App\Modules\Common\Services\CommonService;
use App\Modules\Customer\Models\Customer;
use App\Modules\Mail\Interfaces\MailInterface;
use App\Modules\MessageSchedule\Interfaces\MessageScheduleInterface;
use App\Modules\MessageSchedule\Models\MessageSchedule;
use App\Modules\Timezone\Models\Timezone;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
        $current_timeStamp = (now())->format('Y-m-d H:i');
        $current_timezone = env('DB_TIME_ZONE');

        ## 1. Создание очередей на создение очередей отправки писем
        ## string $current_timeStamp
        ## string $current_timezone
        $timezones = Timezone::all()->toArray();
        $current_date = Carbon::createFromFormat('Y-m-d H:i', $current_timeStamp, $current_timezone);
        foreach ($timezones as $timezone) {
            $convert_time = $current_date->setTimezone($timezone['timezone_name'])->format('H:i');
            $messages = MessageSchedule::select('message.message_content')->where('message_schedule_time', $convert_time)->leftJoin('message', 'message_schedule.message_id', '=', 'message.message_id')->get()->toArray();

            ## 2. Создание очереди для отправки писем
            ## int   $timezone['timezone_id']
            ## array $messages
            $customers = Customer::select('customer_email')->where('timezone_id', $timezone['timezone_id'])->get()->toArray();
            foreach ($customers as $customer) {
                foreach ($messages as $message) {
                    Log::channel('email')->info('email=' . $customer['customer_email'] . ' | ' . 'message=' . $message['message_content']);
                }
            }
        }

//        $customers = Customer::where('timezone_id', 8)->get()->toArray();
//        var_dump(count($customers));


//        $time_start = microtime(true);
//
//        $time_end = microtime(true);
//        $execution_time = ($time_end - $time_start);
//        echo '<b>Total Execution Time:</b> '.$execution_time.' sec';

        exit('exit');


        $customers = Customer::select()->limit(10)->get();
        $messageSend = $this->mailService->getLogSend(10);
        $messagesInSchedule = $this->messageSchedule->getAll(10);
        $dateTime = $this->commonService->now(10);

        return view('home', compact('customers', 'messagesInSchedule', 'messageSend', 'dateTime'));
    }
}
