<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'perusahaans';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'nama', 
    ];
}