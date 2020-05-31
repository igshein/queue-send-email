<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class
CreateMessageTable extends Migration
{
    protected $table = 'message';
    protected $primaryKey = false;
    protected $timestamps = false;

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->bigIncrements('message_id');
            $table->unsignedBigInteger('customer_id');
            $table->text('message');
            $table->dateTime('date_create');
        });

        Schema::table($this->table, function (Blueprint $table) {
            $table->foreign('customer_id')->references('customer_id')->on('customer')->onDelete('cascade');
            $table->index('customer_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
