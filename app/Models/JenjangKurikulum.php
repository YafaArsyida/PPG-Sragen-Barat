<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenjangKurikulum extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ms_jenjang_kurikulum'; // Nama tabel
    protected $primaryKey = 'ms_jenjang_kurikulum_id'; // Nama kolom primary key

    protected $fillable = [
        'nama_jenjang',
        'deskripsi',
    ];
}
