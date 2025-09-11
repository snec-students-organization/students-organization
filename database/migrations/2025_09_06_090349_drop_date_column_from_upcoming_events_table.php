<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('upcoming_events', 'date')) {
            Schema::table('upcoming_events', function (Blueprint $table) {
                $table->dropColumn('date');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('upcoming_events', 'date')) {
            Schema::table('upcoming_events', function (Blueprint $table) {
                $table->date('date')->nullable()->after('title');
            });
        }
    }
};
