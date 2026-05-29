<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MateriKurikulum extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ms_materi_kurikulum'; // Nama tabel
    protected $primaryKey = 'ms_materi_kurikulum_id'; // Nama kolom primary key

    protected $fillable = [
        'ms_aspek_kurikulum_id',
        'nama_materi',
        'uraian_materi',
        'urutan',
    ];

    public function trx_penilaian_materi()
    {
        return $this->hasMany(PenilaianMateriKurikulum::class, 'ms_materi_kurikulum_id', 'ms_materi_kurikulum_id');
    }
}
