<?php

namespace App\Jobs;

use App\Modules\Customer\Models\Customer;
use App\Modules\Mail\Interfaces\MailInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateEmailQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    //protected $mailService;

    public function __construct($data)
    {
        $this->data = $data;
        //$this->mailService = $mailService;
    }

    public function handle(MailInterface $mailService)
    {
        $customers = Customer::select('customer_email')->where('timezone_id', $this->data['timezone_id'])->get()->toArray();
        foreach ($customers as $customer) {
            foreach ($this->data['messages'] as $message) {
                // Log::channel('email')->info('email=' . $customer['customer_email'] . ' | ' . 'message=' . $message['message_content']);
                $mailService->createWorkSendEmail($customer['customer_email'], $message['message_content']);
            }
        }
        unset($customers);
        gc_collect_cycles();
    }
}
