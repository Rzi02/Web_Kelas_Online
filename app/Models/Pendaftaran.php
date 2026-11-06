<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\StatusPendaftaran;


class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $primaryKey = 'id_pendaftaran';

    protected $fillable = [
        'id_kelas',
        'id_pendaftar',
        'status',
        'tanggal_daftar',
    ];

    protected function casts(): array
    {
        return [
            'status' => StatusPendaftaran::class,
            'tanggal_daftar' => 'datetime',
        ];
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(
            Kelas::class,
            'id_kelas',
            'id_kelas'
        );
    }

    public function pendaftar(): BelongsTo
    {
        return $this->belongsTo(
            Pendaftar::class,
            'id_pendaftar',
            'id_pendaftar'
        );
    }
}