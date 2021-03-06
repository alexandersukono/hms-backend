<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObatEceranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obat_eceran', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_transaksi')->unsigned()->nullable();
            $table->foreign('id_transaksi')
                  ->references('id')->on('transaksi_eksternal')
                  ->onDelete('restrict');

            $table->integer('id_pembayaran')->unsigned()->nullable();  
            $table->foreign('id_pembayaran')
                  ->references('id')->on('pembayaran')
                  ->onDelete('restrict');

            $table->dateTime('waktu_transaksi');
                  
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
        Schema::dropIfExists('obat_eceran');
    }
}
