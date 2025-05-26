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
        Schema::table('hospital_equipment', function (Blueprint $table) {
            $table->string('location')->after('status')->nullable();
            $table->string('building')->after('location')->nullable();
            $table->string('floor')->after('building')->nullable();
            $table->string('room')->after('floor')->nullable();
            $table->string('room_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hospital_equipment', function (Blueprint $table) {
            $table->dropColumn(['location', 'building', 'floor', 'room', 'room_name']);
        });
    }
};
