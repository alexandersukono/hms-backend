<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $table = 'resep';

    /**
    *	Get the ResepItem of the Resep
    */
    public function resepItem()
    {
    	return $this->hasMany('App\ResepItem');
    }

    /**
    * Get the Transaksi of the Resep.
    */
    public function transaksi()
    {
        return $this->belongsTo('App\Transaksi', 'id_transaksi');
    }

    /**
    * Get the TransaksiEksternal of the Resep.
    */
    public function transaksiEksternal()
    {
        return $this->belongsTo('App\TransaksiEksternal', 'id_transaksi_eksternal');
    }
}
