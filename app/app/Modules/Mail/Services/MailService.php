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
        Log::channel('email')->info('send-email | '. date('Y-m-d H:i:s') . ' | email=' . $email . ' | message=' . $content);
    }

    public function getLogSend(int $limit = 1000): array
    {
        $arr = [];
        $path = storage_path().'/logs/email.log';
        $data = shell_exec("tail -15 $path");
        if(!empty($data)) {
            $arr = explode(PHP_EOL, $data);
        }
        return $arr;
    }
}
