<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pelatihan_id')->constrained()->cascadeOnDelete();
            $table->foreignId('peserta_id')->constrained()->cascadeOnDelete();

            $table->integer('interpersonal')->nullable();
            $table->integer('intrapersonal')->nullable();
            $table->integer('organisasi')->nullable();
            $table->integer('spiritual')->nullable();

            $table->timestamps();

            $table->unique(['pelatihan_id', 'peserta_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
