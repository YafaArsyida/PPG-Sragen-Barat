<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ms_pengguna';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ms_pengguna_id'; // Ganti 'id' dengan nama kolom primary key yang sesuai

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'password',
        'peran',
        'current_session',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function isSuperAdmin(): bool
    {
        return $this->peran === 'SUPERADMIN';
    }

    public function isAdmin(): bool
    {
        return $this->peran === 'ADMIN';
    }

    public function isUser(): bool
    {
        return $this->peran === 'USER';
    }
    public function isAdminDaerah(): bool
    {
        return $this->aksesDaerah()->exists();
    }
    
    // Di model User
    public function ms_akses_pengguna()
    {
        return $this->hasMany(AksesPengguna::class, 'ms_pengguna_id', 'ms_pengguna_id');
    }

    public function aksesDesa()
    {
        return $this->ms_akses_pengguna()->where('scope_type', 'desa');
    }

    public function aksesKelompok()
    {
        return $this->ms_akses_pengguna()->where('scope_type', 'kelompok');
    }

    public function aksesDaerah()
    {
        return $this->ms_akses_pengguna()->where('scope_type', 'daerah');
    }

    public function canManageKelompok($kelompokId): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        if ($this->isAdminDaerah()) {
            return true;
        }

        $kelompok = Kelompok::find($kelompokId);

        if (!$kelompok) {
            return false;
        }

        // akses langsung kelompok
        if (
            $this->ms_akses_pengguna()
            ->where('scope_type', 'kelompok')
            ->where('scope_id', $kelompokId)
            ->exists()
        ) {
            return true;
        }

        // akses desa
        return $this->ms_akses_pengguna()
            ->where('scope_type', 'desa')
            ->where('scope_id', $kelompok->ms_desa_id)
            ->exists();
    }
}
