<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZndsuMonitoring extends Model
{
    protected $fillable = ['plant', 'name', 'statuses', 'status_headers', 'jml_x'];

    protected $casts = [
        'statuses' => 'array',
        'status_headers' => 'array',
    ];
}
