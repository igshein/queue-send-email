<?php

namespace App\Modules\Common\Interfaces;

interface CommonInterface
{
    public function now(int $seconds = 0): string;
}
