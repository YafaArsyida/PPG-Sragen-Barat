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
        Schema::create('trx_penilaian_materi', function (Blueprint $table) {
            $table->id('trx_penilaian_materi_id');

            $table->foreignId('ms_kelompok_id')
                ->constrained('ms_kelompok', 'ms_kelompok_id')
                ->cascadeOnDelete();
            $table->foreignId('ms_periode_kurikulum_id')
                ->constrained('ms_periode_kurikulum', 'ms_periode_kurikulum_id')
                ->cascadeOnDelete();
            $table->foreignId('ms_jenjang_kurikulum_id')
                ->constrained('ms_jenjang_kurikulum', 'ms_jenjang_kurikulum_id')
                ->cascadeOnDelete();

            $table->string('kehadiran', 10);
            $table->string('keberhasilan', 10);

            $table->text('catatan')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trx_penilaian_materi');
    }
};
