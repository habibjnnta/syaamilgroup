<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detail_transaksis';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'no_invoice',
        'barang_id',
        'jumlah',
        'harga',
    ];

    public function barang()
    {
        return $this->belongsTo('App\Barang', 'barang_id');
    }
}
