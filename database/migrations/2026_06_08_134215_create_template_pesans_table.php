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
        Schema::create('template_pesan_generus', function (Blueprint $table) {
            $table->id('template_pesan_generus_id'); // Primary key

            $table->enum('scope', ['kelompok', 'desa', 'daerah'])->default('kelompok');

            $table->unsignedBigInteger('ms_desa_id')->nullable();
            $table->unsignedBigInteger('ms_kelompok_id')->nullable();

            $table->string('judul', 255);
            $table->text('salam_pembuka')->nullable();
            $table->text('kalimat_pembuka')->nullable();
            $table->text('kalimat_penutup')->nullable();
            $table->text('salam_penutup')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_pesan');
    }
};
