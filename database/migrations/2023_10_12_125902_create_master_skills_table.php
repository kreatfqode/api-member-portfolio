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
        Schema::create('master_skills', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_programmers')->unsigned();
            $table->foreign('id_programmers')->references('id')->on('programmers')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('id_skills')->unsigned()->unique();
            $table->foreign('id_skills')->references('id')->on('skills')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_skills');
    }
};