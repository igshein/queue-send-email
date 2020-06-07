<?php

namespace App\Modules\Mail\Services;

use App\Jobs\SendEmails;
use App\Modules\Common\Factory\CommonServiceFactory;
use App\Modules\Mail\Interfaces\MailInterface;
use Illuminate\Support\Facades\Log;

class MailService implements MailInterface
{
    private $commonServiceFactory;

    public function __construct()
    {
        $this->commonServiceFactory = new CommonServiceFactory;
    }

    public function createWorkSendEmail(string $email, string $content): void
    {
        $data['email'] = $email;
        $data['content'] = $content;
        SendEmails::dispatch($data)->onQueue('send-mails');
    }

    public function send(string $email, string $content): void
    {
        Log::channel('email')->info('email=' . $email . ' | message=' . $content);
    }
}
