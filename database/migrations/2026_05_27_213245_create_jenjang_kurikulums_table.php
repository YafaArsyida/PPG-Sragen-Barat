<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // ms_jenjang_kurikulums

    public function up(): void
    {
        Schema::create('ms_jenjang_kurikulum', function (Blueprint $table) {
            $table->id('ms_jenjang_kurikulum_id');

            $table->string('nama_jenjang', 50);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_jenjang_kurikulum');
    }
};
