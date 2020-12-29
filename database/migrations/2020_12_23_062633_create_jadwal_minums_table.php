<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalMinumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_minums', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('data_pasien_id')->unsigned();
            $table->foreign('data_pasien_id')->references('id')->on('data_pasiens')->onDelete('cascade');
            $table->string('terapi');
            $table->string('dosis');
            $table->string('jadwalminum');
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
        Schema::dropIfExists('jadwal_minums');
    }
}
