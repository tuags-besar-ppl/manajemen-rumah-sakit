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
    Schema::create('equipment', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('code')->unique(); 
        $table->string('gambar')->nullable(); 
        $table->string('lokasi')->nullable(); 
        $table->enum('status', ['tersedia', 'digunakan', 'rusak'])->default('tersedia');
        $table->text('deskripsi')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
