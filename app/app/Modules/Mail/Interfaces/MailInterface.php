<?php

namespace App\Modules\Mail\Interfaces;

interface MailInterface
{
    public function send(int $messageScheduleId): void;
    public function getLogSend(int $limit = 1000): array;
}
