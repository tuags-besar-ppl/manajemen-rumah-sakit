<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeralatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peralatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Name of equipment
            $table->string('kode'); // Equipment code
            $table->string('lokasi'); // Location of equipment
            $table->string('status'); // Status of the equipment
            $table->text('deskripsi'); // Description of the equipment
            $table->string('kategori'); // Category of the equipment
            $table->string('klasifikasi'); // Classification of the equipment
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peralatan');
    }
}
