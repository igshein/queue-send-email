<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsSendMessageTable extends Migration
{
    protected $table = 'logs_send_message';

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->bigIncrements('logs_send_message_id');
            $table->bigInteger('message_id');
            $table->bigInteger('customer_id');
            $table->text('message');
            $table->dateTime('date_send');
        });
    }

    public function down()
    {
        Schema::dropIfExists('logs_send_message');
    }
}
