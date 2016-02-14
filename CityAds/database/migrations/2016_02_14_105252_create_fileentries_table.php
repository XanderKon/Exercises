<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_logs', function (Blueprint $table) {
            $table->integer('transaction_id');
            $table->dateTime('tdate');
            $table->string('tvalue');
            $table->unique('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('file_logs', function (Blueprint $table) {
            //
        });
    }
}
