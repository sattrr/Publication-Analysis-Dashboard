<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement('CREATE SCHEMA IF NOT EXISTS penelitian');

        Schema::create('penelitian.publikasi', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_in(md5(now()::text)::cstring)'));
            $table->string('nip', 30)->nullable();
            $table->string('id_scopus', 20)->nullable();
            $table->string('nama')->nullable();
            $table->string('judul')->nullable();
            $table->string('jenis_publikasi')->nullable();
            $table->string('nama_jurnal')->nullable();
            $table->string('tahun', 10)->nullable();
            $table->string('tautan')->nullable();
            $table->string('doi')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penelitian.publikasi');
        DB::statement('DROP SCHEMA IF EXISTS penelitian CASCADE');
    }
};