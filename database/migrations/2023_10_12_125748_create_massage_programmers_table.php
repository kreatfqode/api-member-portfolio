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
        Schema::create('massage_programmers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_programmers')->unsigned();
            $table->foreign('id_programmers')->references('id')->on('programmers')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama');
            $table->string('no_telp')->nullable();
            $table->string('email')->nullable();
            $table->text('pesan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('massage_programmers');
    }
};