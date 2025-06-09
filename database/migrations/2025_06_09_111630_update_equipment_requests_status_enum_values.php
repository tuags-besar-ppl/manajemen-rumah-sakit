<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE equipment_requests CHANGE status status ENUM('pending', 'approved', 'rejected', 'completed', 'cancelled', 'disetujui', 'ditolak') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original enum values (handle existing data if necessary)
        // This might truncate data if 'disetujui' or 'ditolak' statuses exist
        DB::statement("ALTER TABLE equipment_requests CHANGE status status ENUM('pending', 'approved', 'rejected', 'completed', 'cancelled') DEFAULT 'pending'");
    }
};
