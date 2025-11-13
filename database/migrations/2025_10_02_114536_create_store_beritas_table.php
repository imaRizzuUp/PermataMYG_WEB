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
        Schema::create('store_beritas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_permata_id')->constrained('admin_permatas')->onDelete('cascade');
            $table->string('judul');
            $table->string('gambar')->nullable(); // path gambar
            $table->text('isi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_beritas');
    }
};
