<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('programmers', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->string('warna_primary', 20)->nullable()->default('261,97%,71%');
            $table->string('warna_secondary', 20)->nullable()->default('10,97%,71%');
            $table->string('nama_panggilan', 50)->nullable();
            $table->string('nama_lengkap', 100)->nullable();
            $table->string('foto_utama')->nullable();
            $table->string('foto_tentang')->nullable();
            $table->text('tentang_diri')->nullable();
            $table->text('tentang_skill')->nullable();
            $table->text('tentang_pengalaman')->nullable();
            $table->text('tentang_project')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_telp')->nullable();
            $table->date('mulai_karir')->nullable();
            $table->text('moto_project')->nullable();
            $table->string('pdf_cv')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmers');
    }
};
