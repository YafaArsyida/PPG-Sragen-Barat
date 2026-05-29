<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenilaianMateriKurikulum extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'trx_penilaian_materi'; // Nama tabel
    protected $primaryKey = 'trx_penilaian_materi_id'; // Nama kolom primary key

    protected $fillable = [
        'ms_kelompok_id',
        'ms_periode_kurikulum_id',
        'ms_jenjang_kurikulum_id',
        'ms_materi_kurikulum_id',
        'kehadiran',
        'keberhasilan',
        'catatan',
    ];

    // Kelompok
    public function ms_kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'ms_kelompok_id', 'ms_kelompok_id');
    }

    // Periode
    public function ms_periode_kurikulum()
    {
        return $this->belongsTo(PeriodeKurikulum::class, 'ms_periode_kurikulum_id', 'ms_periode_kurikulum_id');
    }

    // Jenjang
    public function ms_jenjang_kurikulum()
    {
        return $this->belongsTo(JenjangKurikulum::class, 'ms_jenjang_kurikulum_id', 'ms_jenjang_kurikulum_id');
    }

    // Materi
    public function ms_materi_kurikulum()
    {
        return $this->belongsTo(MateriKurikulum::class, 'ms_materi_kurikulum_id', 'ms_materi_kurikulum_id');
    }
}
