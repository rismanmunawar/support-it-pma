<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $fillable = ['user_id', 'judul', 'isi', 'kategori', 'gambar'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dibacaOleh(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'pengumuman_user_read', 'pengumuman_id', 'user_id')
            ->withPivot('read_at')
            ->withTimestamps();
    }
}
