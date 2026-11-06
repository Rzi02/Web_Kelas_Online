<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pendaftar extends Model
{
    protected $table = 'pendaftar';

    protected $primaryKey = 'id_pendaftar';

    protected $fillable = [
        'nama',
        'email',
        'no_telepon',
    ];

    public function pendaftaran(): HasMany
    {
        return $this->hasMany(
            Pendaftaran::class,
            'id_pendaftar',
            'id_pendaftar'
        );
    }
}