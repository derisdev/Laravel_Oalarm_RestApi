<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataPasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pasiens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('norekammedik');
            $table->string('nama');
            $table->string('tanggallahir');
            $table->string('umur');
            $table->string('alamat');
            $table->string('kodediagnosa');
            $table->string('kodedx');
            $table->string('terapi');
            $table->string('dosis');
            $table->string('pmo');
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
        Schema::dropIfExists('data_pasiens');
    }
}
