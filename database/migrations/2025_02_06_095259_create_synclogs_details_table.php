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
        Schema::create('synclogs_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('synclog_id');
            $table->foreign('synclog_id')->references('id')->on('synclogs')->onDelete('cascade');
            $table->enum('category', ['added', 'deleted', 'updated', 'error'])->default('added'); // Status sinkronisasi
            $table->text('message')->nullable(); // Pesan error jika gagal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('synclogs_details');
    }
};
