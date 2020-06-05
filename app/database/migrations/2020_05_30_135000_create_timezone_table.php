<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimezoneTable extends Migration
{
    protected $table = 'timezone';
    protected $primaryKey = false;
    protected $timestamps = false;

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('timezone_id');
            $table->string('timezone_name')->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
