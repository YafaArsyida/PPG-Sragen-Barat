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
        Schema::create('presensi_pengurus', function (Blueprint $table) {
            $table->id('presensi_pengurus_id'); // Primary key
            $table->unsignedBigInteger('ms_kegiatan_pengurus_id'); // FK ke kegiatan/event
            $table->unsignedBigInteger('ms_pengurus_id');  // FK ke generus
            $table->timestamp('waktu_hadir')->nullable(); // Waktu presensi
            $table->enum('status_hadir', ['hadir', 'izin', 'alpha'])->default('hadir');
            $table->text('deskripsi')->nullable();       // Catatan tambahan
            $table->timestamps();
            $table->softDeletes();

            // Unique supaya 1 generus hanya bisa presensi 1x per kegiatan
            $table->unique(['presensi_pengurus_id', 'ms_pengurus_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_pengurus');
    }
};
