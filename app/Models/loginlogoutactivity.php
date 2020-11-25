<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loginlogoutactivity extends Model
{
    //
    protected $table = 'loginlogoutactivities';
    protected $fillable = [
        'id',
        'user_id',
        'date',
        'time',
        'activity',
        'created_at',
        'updated_at'
    ];

}
