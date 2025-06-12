<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZndsuMonitoring extends Model
{
    protected $table = 'monitoring_zndsu';

    protected $fillable = [
        'plant',
        'name',
        'statuses',
        'jml_x',
    ];

    protected $casts = [
        'statuses' => 'array', // supaya bisa langsung pakai array saat ambil dari DB
    ];
}
