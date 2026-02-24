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
        Schema::table('pelatihans', function (Blueprint $table) {
            // drop kolom lama
            $table->dropColumn('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelatihans', function (Blueprint $table) {
            // kalau rollback, tambahkan kembali kolom tanggal
            $table->date('tanggal')->nullable();
        });
    }
};