<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('mapel', function (Blueprint $table) {
            // Senjata rahasianya ada di kata ->change()
            // Ini ngasih tau Laravel: "Jangan bikin kolom baru, tapi edit kolom yang udah ada"
            $table->unsignedBigInteger('dosen_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('mapel', function (Blueprint $table) {
            // Ini buat jaga-jaga kalau lu mau ngebatalin (rollback) perubahannya
            $table->unsignedBigInteger('dosen_id')->nullable(false)->change();
        });
    }
};