<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('institution_data', function (Blueprint $table) {
            $table->string('email')->after('membership_number')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('institution_data', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
};
