<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresensiKegiatanGenerus extends Model
{
    use HasFactory;

    protected $table = 'presensi_kegiatan_generus'; // Nama tabel
    protected $primaryKey = 'presensi_kegiatan_generus_id'; // Nama kolom primary key

    protected $fillable = [
        'ms_kegiatan_generus_id',
        'ms_generus_id',
        'tanggal_presensi',
        'waktu_hadir',
        'status_hadir',
        'tempat',
        'alamat',
        'peta',
        'verifikasi',  //kartu, manual
        'deskripsi',
    ];

    public function ms_kegiatan_generus()
    {
        return $this->belongsTo(KegiatanGenerus::class, 'ms_kegiatan_generus_id', 'ms_kegiatan_generus_id');
    }

    public function ms_generus()
    {
        return $this->belongsTo(Generus::class, 'ms_generus_id', 'ms_generus_id');
    }
}
