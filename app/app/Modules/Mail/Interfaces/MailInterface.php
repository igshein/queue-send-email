<?php

namespace App\Modules\Mail\Interfaces;

interface MailInterface
{
    public function send(string $email, string $content): void;
    public function createWorkSendEmail(string $email, string $content): void;
    public function getLogSend(int $limit = 1000): array;
}
