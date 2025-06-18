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
        Schema::create('synclogs', function (Blueprint $table) {
            $table->id();
            $table->string('process_name'); // Nama proses sinkronisasi
            $table->timestamp('last_synced_at')->useCurrent(); // Waktu terakhir sinkronisasi
            $table->enum('status', ['success', 'failed', 'partial'])->default('success'); // Status sinkronisasi
            $table->text('message')->nullable(); // Pesan error jika gagal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('synclogs');
    }
};
