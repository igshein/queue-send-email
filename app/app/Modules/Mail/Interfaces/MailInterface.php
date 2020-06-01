<?php

namespace App\Modules\Mail\Interfaces;

interface MailInterface
{
    public function send(int $messageScheduleId): void;
}
