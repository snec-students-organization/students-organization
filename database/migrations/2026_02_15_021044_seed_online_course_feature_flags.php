<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('feature_flags')->insert([
            ['feature_name' => 'online_course_registration', 'is_active' => false, 'created_at' => now(), 'updated_at' => now()],
            ['feature_name' => 'online_course_attendance', 'is_active' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('feature_flags')->whereIn('feature_name', ['online_course_registration', 'online_course_attendance'])->delete();
    }
};
