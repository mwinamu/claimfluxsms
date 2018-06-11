<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class sms_messages extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'id',
        'cfid',
        'message_string',
        'user_id',
        'sms_names_id',
        'dispatched',
        'dispatch_time',
        'created_at',
        'updated_at',
        'debtor_number',
        'external_id',
        'cost',
        'sent',
        'error_message'
    ];
}
