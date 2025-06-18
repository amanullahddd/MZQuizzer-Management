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
        Schema::create('questionmedias', function (Blueprint $table) {
            $table->id();
            $table->string('guid')->unique();
            $table->string('question');
            $table->boolean('image');
            $table->boolean('audio');
            $table->unsignedBigInteger('sheetname_id');
            $table->foreign('sheetname_id')->references('id')->on('sheetnames')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionmedias');
    }
};
