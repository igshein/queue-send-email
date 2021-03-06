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
            $table->increments('message_id');
            $table->text('message_content');
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
