<?php

namespace App\Console\Commands;

use App\Modules\MessageSchedule\Interfaces\MessageScheduleInterface;
use Illuminate\Console\Command;

class CreateMailQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:mail-queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Jobs foe queue mails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(MessageScheduleInterface $messageSchedule)
    {
        $messageSchedule->createMailQueue();
    }
}
