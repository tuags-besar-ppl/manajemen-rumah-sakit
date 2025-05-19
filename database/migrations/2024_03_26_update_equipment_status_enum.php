<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // First, modify any existing records to match new status values
        DB::table('hospital_equipment')
            ->where('status', 'available')
            ->update(['status' => 'tersedia']);
            
        DB::table('hospital_equipment')
            ->where('status', 'in_use')
            ->update(['status' => 'sedang_digunakan']);
            
        DB::table('hospital_equipment')
            ->whereIn('status', ['maintenance', 'broken'])
            ->update(['status' => 'rusak']);

        // Then modify the enum
        DB::statement("ALTER TABLE hospital_equipment MODIFY COLUMN status ENUM('tersedia', 'sedang_digunakan', 'rusak')");
    }

    public function down()
    {
        // First, convert back the status values
        DB::table('hospital_equipment')
            ->where('status', 'tersedia')
            ->update(['status' => 'available']);
            
        DB::table('hospital_equipment')
            ->where('status', 'sedang_digunakan')
            ->update(['status' => 'in_use']);
            
        DB::table('hospital_equipment')
            ->where('status', 'rusak')
            ->update(['status' => 'broken']);

        // Then restore the original enum
        DB::statement("ALTER TABLE hospital_equipment MODIFY COLUMN status ENUM('available', 'in_use', 'maintenance', 'broken')");
    }
}; 