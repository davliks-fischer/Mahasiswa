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
        Schema::create('absensi', function (Blueprint $table) {
    $table->id();
    $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->cascadeOnDelete();
    $table->foreignId('mapel_id')->constrained('mapel')->cascadeOnDelete();
    $table->date('tanggal');
    $table->time('clock_in')->nullable();
    $table->time('clock_out')->nullable();
    $table->enum('status', ['hadir', 'telat', 'tidak hadir']);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
