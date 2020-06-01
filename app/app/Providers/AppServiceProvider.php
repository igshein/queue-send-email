<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Modules\MessageSchedule\Interfaces\MessageScheduleInterface', 'App\Modules\MessageSchedule\Services\MessageScheduleService');
        $this->app->bind('App\Modules\Common\Interfaces\CommonInterface', 'App\Modules\Common\Services\CommonService');
        $this->app->bind('App\Modules\Mail\Interfaces\MailInterface', 'App\Modules\Mail\Services\MailService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
