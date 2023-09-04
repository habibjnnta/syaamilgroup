<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaksis';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'no_invoice',
        'perusahaan_id', 
        'total',
    ];

    /**
     * getLinkDetail
    */
    public function getLinkDetailAttribute()
    {
        return url('transaksi/' . $this->id);
    }

    public function perusahaan()
    {
        return $this->belongsTo('App\Perusahaan', 'perusahaan_id');
    }

    public function detail()
    {
        return $this->belongsToMany('App\DetailTransaksi', 'no_invoice');
    }

    /**
     * getExport
    */
    public function getExport()
    {
        return url('export/' . $this->id);
    }
}
