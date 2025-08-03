<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->nullable();
            $table->string('id_scopus')->nullable();
            $table->string('nama');
            $table->string('judul');
            $table->string('jenis_publikasi');
            $table->string('nama_jurnal')->nullable();
            $table->string('tautan')->nullable();
            $table->string('doi')->nullable();
            $table->integer('tahun');
            $table->string('sumber_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
