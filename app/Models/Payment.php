<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $table = 'payments';
    public $timestamps = true;
    protected $fillable = array('resturant_id', 'notes', 'paid');

    public function resturant()
    {
        return $this->belongsTo('App\Models\Resturant');
    }

}
