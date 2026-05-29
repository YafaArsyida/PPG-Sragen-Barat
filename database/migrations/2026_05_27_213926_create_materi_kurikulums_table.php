<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // ms_materi_kurikulums

    public function up(): void
    {
        Schema::create('ms_materi_kurikulum', function (Blueprint $table) {
            $table->id('ms_materi_kurikulum_id');

            $table->foreignId('ms_aspek_kurikulum_id')
                ->constrained('ms_aspek_kurikulum', 'ms_aspek_kurikulum_id')
                ->cascadeOnDelete();

            $table->string('nama_materi', 150);

            $table->text('uraian_materi')
                ->nullable();

            $table->unsignedInteger('urutan')
                ->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_materi_kurikulum');
    }
};
