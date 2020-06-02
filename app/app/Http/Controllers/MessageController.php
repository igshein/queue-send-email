<?php

namespace App\Http\Controllers;

use App\Modules\MessageSchedule\Services\MessageScheduleService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private $messageSchedule;

    public function __construct(MessageScheduleService $messageSchedule)
    {
        $this->middleware('auth');
        $this->messageSchedule = $messageSchedule;
    }

    public function sendEmail(Request $request)
    {
        $requestData['customer_id'] = $request->get('customer_id');
        $requestData['message'] = $request->get('message');
        $requestData['timezone'] = $request->get('timezone');
        $requestData['request_date'] = $this->validDataTime($request->get('request_date'));

        $this->messageSchedule->sendNewMessage($requestData);

        return redirect()->route('home');
    }

    private function validDataTime(string $requestDate): string
    {
        try {
            $dataTime = (new \DateTime($requestDate))->format('Y-m-d H:i:s');
        } catch (\Exception $exception) {
            if (env('APP_ENV') == 'local') {
                throw new $exception;
            } else {
                echo 'Error: dataTime not valid';
                exit;
            }
        }
        return $dataTime;
    }
}
