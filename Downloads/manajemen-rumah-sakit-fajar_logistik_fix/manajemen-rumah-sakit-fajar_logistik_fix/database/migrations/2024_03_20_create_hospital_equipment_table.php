<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hospital_equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('category');
            $table->integer('quantity');
            $table->integer('minimum_stock');
            $table->string('unit');
            $table->text('description')->nullable();
            $table->enum('status', ['available', 'in_use', 'maintenance', 'broken']);
            $table->date('purchase_date');
            $table->date('last_maintenance_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hospital_equipment');
    }
}; 