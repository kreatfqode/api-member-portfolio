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
        Schema::create('master_tools', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_programmers')->unsigned();
            $table->foreign('id_programmers')->references('id')->on('programmers')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('id_tools')->unsigned()->unique();
            $table->foreign('id_tools')->references('id')->on('tools')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_tools');
    }
};