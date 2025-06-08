<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'branch',
        'password',
        'nik',
        'role',
        'role_desc',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi many-to-many ke pengumuman yang sudah dibaca user
    public function pengumumanDibaca()
    {
        return $this->belongsToMany(Pengumuman::class, 'pengumuman_user_read', 'user_id', 'pengumuman_id')
            ->withPivot('read_at')
            ->withTimestamps();
    }
}
