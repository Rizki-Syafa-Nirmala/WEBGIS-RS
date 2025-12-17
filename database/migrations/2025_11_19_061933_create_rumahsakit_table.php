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
            $table->id(); 
            $table->string('nama_rs');  
            $table->string('detail_dokter');
            $table->string('fasilitas_unggulan'); 
            $table->string('alamat'); 
            $table->string('amenity');
            $table->decimal('latitude', 10, 6)->nullable();  
            $table->decimal('longitude', 10, 6)->nullable(); 
            $table->timestamps();  
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
