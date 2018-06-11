<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class sms_templates extends Model
{
    //
    use Notifiable;

    protected  $fillable = [
        'id' ,
        'cfid',
        'debtor_name',
        'debtor_number',
        'ptp_amount',
        'ptp_date',
        'client',
        'account_number',
        'paybill_number',
        'acm_name',
        'acm_number',
        'acm_email',
        'balance',
        'waiver_amount',
        'waived_amount',
        'user_id',
        'sms_names_id',
        'updated_at',
        'created_at'
    ];


}
