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
        //
        Schema::table('movies', function (Blueprint $table) {
        $table->string("release");
        $table->enum('quality', ['hd','fullhd','2k','4k']);
        $table->enum('type',['movie','tvshow']);
        $table->string('back_photo')->default("nothumb.back.png");
        $table->unsignedBigInteger("user_id");

        $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
