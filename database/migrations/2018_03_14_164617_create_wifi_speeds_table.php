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
        Schema::create('wifi_speeds', function (Blueprint $table) {
            $table->increments('id');
            $table->double('latitude', 10, 8);
            $table->double('longitude', 11, 8);
            $table->double('accuracy', 6, 2);
            $table->integer('download');
            $table->integer('upload');
            $table->double('ping', 5, 1);
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
        Schema::drop('wifi_speeds');
    }
}
