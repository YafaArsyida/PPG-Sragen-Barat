<?php

namespace App\Models\TemanPengurus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresensiKegiatan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'presensi_pengurus'; // Nama tabel
    protected $primaryKey = 'presensi_pengurus_id'; // Nama kolom primary key

    protected $fillable = [
        'ms_kegiatan_pengurus_id',
        'ms_pengurus_id',
        'tanggal_presensi',
        'waktu_hadir',
        'status_hadir',
        'verifikasi',  //kartu, manual
        'deskripsi',
    ];

    public function ms_kegiatan_pengurus()
    {
        return $this->belongsTo(KegiatanPengurus::class, 'ms_kegiatan_pengurus_id', 'ms_kegiatan_pengurus_id');
    }

    public function ms_pengurus()
    {
        return $this->belongsTo(Pengurus::class, 'ms_pengurus_id', 'ms_pengurus_id');
    }
}
