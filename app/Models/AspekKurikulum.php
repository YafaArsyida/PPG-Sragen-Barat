<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AspekKurikulum extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ms_aspek_kurikulum'; // Nama tabel
    protected $primaryKey = 'ms_aspek_kurikulum_id'; // Nama kolom primary key

    protected $fillable = [
        'ms_periode_kurikulum_id',
        'ms_jenjang_kurikulum_id',
        'nama_aspek',
        'urutan',
        'deskripsi',
    ];
    public function ms_materi_kurikulum()
    {
        return $this->hasMany(MateriKurikulum::class, 'ms_aspek_kurikulum_id','ms_aspek_kurikulum_id');
    }
}
