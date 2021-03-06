<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStokObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok_obat', function (Blueprint $table) {
            $table->increments('id');
			
			$table->integer('id_jenis_obat')->unsigned();			
			$table->foreign('id_jenis_obat')
				  ->references('id')->on('jenis_obat')
                  ->onDelete('restrict');

            $table->string('nomor_batch')->nullable();		
			$table->integer('jumlah');
            $table->dateTime('kadaluarsa');
            $table->string('barcode')->nullable();                  

            $table->integer('lokasi')->unsigned();                     
            $table->foreign('lokasi')
                  ->references('id')->on('lokasi_obat')
                  ->onDelete('restrict');
				  
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
        Schema::dropIfExists('stok_obat');
    }
}
