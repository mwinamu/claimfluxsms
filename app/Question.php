<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Question extends Model
{
    //
    
    //
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'string', 'sequence', 'path_id', 'user_id','progress','is_dichotomous','is_optional','has_options','has_multiple'
    ];
    /* changes the TINYINT TO boolean entry to true or false AND BACK RESP*/
    protected $casts = [
        'is_optional' => 'boolean',
        'is_dichotomous'  => 'boolean',
        'has_options'  => 'boolean',
        'has_multiple' => 'boolean',
    ];
}
