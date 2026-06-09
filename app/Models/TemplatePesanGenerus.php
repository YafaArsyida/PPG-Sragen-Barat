<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemplatePesanGenerus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'template_pesan_generus';

    protected $primaryKey = 'template_pesan_generus_id';

    protected $fillable = [
        'ms_desa_id',
        'ms_kelompok_id',

        'judul',
        'salam_pembuka',
        'kalimat_pembuka',
        'kalimat_penutup',
        'salam_penutup',

        'status',
    ];

    public function ms_desa()
    {
        return $this->belongsTo(
            Desa::class,
            'ms_desa_id',
            'ms_desa_id'
        );
    }

    public function ms_kelompok()
    {
        return $this->belongsTo(
            Kelompok::class,
            'ms_kelompok_id',
            'ms_kelompok_id'
        );
    }

    public function getNamaTargetAttribute()
    {
        return match ($this->scope) {
            'daerah'   => 'Daerah',
            'desa'     => $this->ms_desa?->nama_desa,
            'kelompok' => $this->ms_kelompok?->nama_kelompok,
            default    => '-',
        };
    }
}
