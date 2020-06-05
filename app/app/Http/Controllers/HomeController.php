<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmails;
use App\Modules\Common\Services\CommonService;
use App\Modules\Customer\Models\Customer;
use App\Modules\Mail\Interfaces\MailInterface;
use App\Modules\MessageSchedule\Interfaces\MessageScheduleInterface;
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
//        for ($i=0; $i<30; $i++) {
//            Log::channel('email')->info("$i TEST MESSAGE $i");
//        }
        //Log::channel('email')->info('TEST MESSAGE');

        $path = storage_path().'/logs/email.log';
        $data = shell_exec("tail -15 $path");
        dd($data);

//        $handle = @fopen(storage_path().'/logs/email.log', "r");
//        $data = fread($handle, 4096);
//        echo '<pre>' . $data .  '</pre>';




//        $fl = fopen(storage_path().'/logs/email.log', "r");
//        for($x_pos = 5, $ln = 0, $output = array(); fseek($fl, $x_pos, SEEK_END) !== -1; $x_pos--) {
//            $char = fgetc($fl);
//            if ($char === "\n") {
//                // analyse completed line $output[$ln] if need be
//                $ln++;
//                continue;
//            }
//            $output[$ln] = $char . ((array_key_exists($ln, $output)) ? $output[$ln] : '');
//        }
//        fclose($fl);
//        dd($output);

        exit;



//        SendEmails::dispatch(1)->delay(now()->addSeconds(10))->onQueue('emails');
//        SendEmails::dispatch(1)->delay(now()->addSeconds(10))->onQueue('emails');
//
//        SendEmails::dispatch(1)->delay(now()->addSeconds(10))->onQueue('users');
//        SendEmails::dispatch(1)->delay(now()->addSeconds(10))->onQueue('users');

        exit('exit');


        $customers = Customer::select()->limit(10)->get();
        $messageSend = $this->mailService->getLogSend(10);
        $messagesInSchedule = $this->messageSchedule->getAll(10);
        $dateTime = $this->commonService->now(10);

        return view('home', compact('customers', 'messagesInSchedule', 'messageSend', 'dateTime'));
    }
}
