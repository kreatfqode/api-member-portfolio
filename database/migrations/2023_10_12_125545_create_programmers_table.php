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
            $table->string('warna_primary', 20)->default('261,97%,71%');
            $table->string('warna_secondary', 20)->default('10,97%,71%');
            $table->string('nama_panggilan', 50)->nullable();
            $table->string('nama_lengkap', 100)->nullable();
            $table->string('foto_utama')->nullable();
            $table->string('foto_tentang')->nullable();
            $table->text('tentang_diri')->default('My name is NAMA_LENGKAP and I am a student at the State Islamic University 🎓 Jakarta in the process being educated Computer Science study program😊, with a great passion for starting a career in programming world like LIST_PEKERJAAN_IMPIAN.');
            $table->text('tentang_skill')->default('develop simple, intuitive and responsive user interface that helps users get things done with less effort and time with those technologies.');
            $table->text('tentang_pengalaman')->default('have been developing sites and apps for 3 years and i know for sure the main trends and directions of modern design, I have been a visionary and a reliable software engineering partner for world-class brands. You will get a decent result as you expect. ');
            $table->text('tentang_project')->default('We develop the best quality website that serves for the long-term. Well-documented, clean, easy and elegant interface helps any non-technical clients.');
            $table->string('alamat')->nullable();
            $table->string('no_telp')->nullable();
            $table->date('mulai_karir')->nullable();
            $table->text('moto_project')->default('We Design & Build
            Creative Products');
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
