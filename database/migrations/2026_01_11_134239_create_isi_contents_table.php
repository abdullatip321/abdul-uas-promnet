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
        Schema::create('isi_contents', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor')->nullable();
            $table->string('subjudul')->nullable();
            $table->text('isi')->nullable();
            $table->foreignId('gambar_id')->on('gambars')->nullable()->index();
            $table->foreignId('content_id')->on('contents')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isi_contents');
    }
};
