<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageScheduleTable extends Migration
{
    protected $table = 'message_schedule';
    protected $primaryKey = false;
    protected $timestamps = false;

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->unsignedBigInteger('message_id');
            $table->dateTime('date_send');
            $table->string('timezone');
        });

        Schema::table($this->table, function (Blueprint $table) {
            $table->foreign('message_id')->references('message_id')->on('message')->onDelete('cascade');
            $table->index('message_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
