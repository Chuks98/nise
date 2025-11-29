<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = [
        'session',
        'class',
        'semester',
        's_no',
        'name',
        'reg_no',
        'total',
        'average',
        'position',
        'remarks',
    ];
}
