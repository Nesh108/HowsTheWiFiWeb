<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWifiSpeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wifispeeds', function (Blueprint $table) {
            $table->increments('id');
            $table->double('latitude', 12, 10); // TODO: Check again
            $table->double('longitude', 13, 10); // TODO: Check again
            $table->double('accuracy', 10, 4); // TODO: Check again
            $table->integer('download');
            $table->integer('upload');
            $table->double('ping', 10, 1); // TODO: Check again
            $table->integer('packet_loss');
            $table->string('name');
            $table->text('comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('wifispeeds');
    }
}
