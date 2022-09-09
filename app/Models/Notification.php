<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('content', 'notifiable_id', 'notifiable_type', 'is_read');

    public function notificable()
    {
        return $this->morphTo();
    }

}
