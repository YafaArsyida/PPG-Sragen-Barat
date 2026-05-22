<?php

namespace App\Models\TemanPengurus;

use App\Models\Desa;
use App\Models\Kelompok;
use App\Models\PresensiKegiatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KegiatanPengurus extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'ms_kegiatan_pengurus'; // Nama tabel
    protected $primaryKey = 'ms_kegiatan_pengurus_id'; // Nama kolom primary key

    protected $fillable = [
        'nama_kegiatan',
        'token',
        'tempat',
        'alamat',
        'peta',
        'tanggal',
        'waktu',
        'status',

        'deskripsi',
    ];

    protected static function booted()
    {
        static::creating(function ($kegiatan) {
            if (empty($kegiatan->token)) {
                $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
                do {
                    $token = '';
                    for ($i = 0; $i < 8; $i++) {
                        $token .= $chars[random_int(0, strlen($chars) - 1)];
                    }
                    $kegiatan->token = $token;
                } while (self::where('token', $token)->exists());
            }
        });
    }
    
    // public function ms_kelompok()
    // {
    //     return $this->belongsTo(Kelompok::class, 'ms_kelompok_id', 'ms_kelompok_id');
    // }

    // /** 🔗 Relasi ke Desa */
    // public function ms_desa()
    // {
    //     return $this->belongsTo(Desa::class, 'ms_desa_id', 'ms_desa_id');
    // }

    // public function ms_presensi()
    // {
    //     return $this->hasMany(PresensiKegiatan::class, 'ms_kegiatan_id');
    // }
}
