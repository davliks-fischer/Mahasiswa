<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_id')->constrained('dosen')->cascadeOnDelete();
            $table->foreignId('mapel_id')->nullable()->constrained('mapel')->nullOnDelete();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_size')->nullable();
            $table->date('deadline')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
