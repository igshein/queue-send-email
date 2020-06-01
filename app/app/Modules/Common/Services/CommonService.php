<?php

namespace App\Modules\Common\Services;

use App\Modules\Common\Interfaces\CommonInterface;
use Carbon\Carbon;

class CommonService implements CommonInterface
{
    public function now(int $seconds = 0): string
    {
        return Carbon::now()->timezone(env('DB_TIME_ZONE'))->addSeconds($seconds)->format('Y-m-d H:i:s');
    }
}
