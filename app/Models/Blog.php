<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    // Optional: specify table name if different from 'blogs'
    protected $table = 'blogs';

    // Mass assignable fields
    protected $fillable = [
        'title',
        'message',
        'image',
        'comments', // JSON field
    ];

    // Automatically cast 'comments' JSON to array
    protected $casts = [
        'comments' => 'array',
    ];
}
