<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // ms_aspek_kurikulums

    public function up(): void
    {
        Schema::create('ms_aspek_kurikulum', function (Blueprint $table) {
            $table->id('ms_aspek_kurikulum_id');

            $table->foreignId('ms_periode_kurikulum_id')
                ->constrained('ms_periode_kurikulum', 'ms_periode_kurikulum_id')
                ->cascadeOnDelete();

            $table->foreignId('ms_jenjang_kurikulum_id')
                ->constrained('ms_jenjang_kurikulum', 'ms_jenjang_kurikulum_id')
                ->cascadeOnDelete();

            $table->string('nama_aspek', 100);

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
        Schema::dropIfExists('ms_aspek_kurikulum');
    }
};
