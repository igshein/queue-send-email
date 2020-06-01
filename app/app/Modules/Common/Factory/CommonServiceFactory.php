<?php

namespace App\Modules\Common\Factory;

use App\Modules\Common\Services\CommonService;

class CommonServiceFactory
{
    public function getCommonService(): CommonService
    {
        return new CommonService;
    }
}
