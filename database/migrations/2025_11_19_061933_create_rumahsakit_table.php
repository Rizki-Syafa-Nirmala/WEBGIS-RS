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
        Schema::create('rumah_sakits', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->string('nama_rs');  // Nama Rumah Sakit
            $table->string('amenity');
            $table->string('alamat');  // Alamat Rumah Sakit
            $table->decimal('latitude', 10, 6)->nullable();  // Latitude
            $table->decimal('longitude', 10, 6)->nullable(); // Longitude
            $table->timestamps();  // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rumah_sakits');
    }
};
