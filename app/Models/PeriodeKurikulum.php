<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeriodeKurikulum extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'ms_periode_kurikulum'; // Nama tabel
    protected $primaryKey = 'ms_periode_kurikulum_id'; // Nama kolom primary key

    protected $fillable = [
        'nama_periode',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];
}
