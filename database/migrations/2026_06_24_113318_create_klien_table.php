<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('klien', function (Blueprint $table) {
            $table->id();
            $table->string('nama_klien');
            $table->string('nama_perusahaan');
            $table->string('email')->nullable();
            $table->string('no_telpon')->nullable();
            $table->text('alamat')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->date('tanggal_kerjasama')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('klien');
    }
};