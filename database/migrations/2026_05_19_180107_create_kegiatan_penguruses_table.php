<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ms_kegiatan_pengurus', function (Blueprint $table) {
            $table->id('ms_kegiatan_pengurus_id');

            // Scope kegiatan
            $table->enum('scope', ['kelompok', 'desa', 'daerah'])
                ->default('daerah');

            // Relasi wilayah
            $table->unsignedBigInteger('ms_kelompok_id')->nullable();
            $table->unsignedBigInteger('ms_desa_id')->nullable();

            // Informasi kegiatan
            $table->string('nama_kegiatan', 150);
            $table->string('tempat', 255)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('peta', 255)->nullable();

            // Jadwal
            $table->date('tanggal');
            $table->time('waktu')->nullable();

            // Target peserta pengurus
            $table->string('target', 150);

            // Status
            $table->enum('status', ['draft', 'aktif', 'selesai'])
                ->default('draft');

            // Token akses
            $table->string('token', 100)->unique();

            // Deskripsi
            $table->text('deskripsi')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('scope');
            $table->index('ms_kelompok_id');
            $table->index('ms_desa_id');
            $table->index('tanggal');
            $table->index('status');
            $table->index('target_pengurus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_kegiatan_pengurus');
    }
};
