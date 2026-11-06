<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\StatusKelas;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $primaryKey = 'id_kelas';

    protected $fillable = [
        'id_kategori',
        'judul',
        'deskripsi',
        'instruktur',
        'harga',
        'gambar',
        'status',
    ];

    protected function casts(): array
{
    return [
        'harga' => 'decimal:2',
        'status' => StatusKelas::class,
    ];
}

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function pendaftaran(): HasMany
    {
        return $this->hasMany(Pendaftaran::class, 'id_kelas', 'id_kelas');
    }
}