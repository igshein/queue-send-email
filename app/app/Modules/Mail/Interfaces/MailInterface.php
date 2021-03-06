<?php

namespace App\Modules\Mail\Interfaces;

interface MailInterface
{
    public function createWorkSendEmail(string $email, string $content): void;
    public function send(string $email, string $content): void;
}
