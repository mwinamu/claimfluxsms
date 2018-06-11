<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class sms_names extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'id',
        'name',
        'user_id',
        'created_at',
        'updated_at',
        'dispatched',
        'rejected',
        'network',
        'dispatch_time'
    ];
}
