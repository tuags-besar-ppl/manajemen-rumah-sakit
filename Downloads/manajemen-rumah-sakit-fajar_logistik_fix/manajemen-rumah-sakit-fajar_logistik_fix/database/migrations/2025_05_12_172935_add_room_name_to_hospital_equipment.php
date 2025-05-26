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
            if (!Schema::hasColumn('hospital_equipment', 'room_name')) {
                $table->string('room_name')->nullable()->after('room');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hospital_equipment', function (Blueprint $table) {
            if (Schema::hasColumn('hospital_equipment', 'room_name')) {
                $table->dropColumn('room_name');
            }
        });
    }
};
