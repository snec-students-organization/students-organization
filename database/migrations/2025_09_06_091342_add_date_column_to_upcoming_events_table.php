<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateColumnToUpcomingEventsTable extends Migration
{
    public function up()
{
    if (!Schema::hasColumn('upcoming_events', 'date')) {
        Schema::table('upcoming_events', function (Blueprint $table) {
            $table->date('date')->nullable()->after('title');
        });
    }
}

public function down()
{
    if (Schema::hasColumn('upcoming_events', 'date')) {
        Schema::table('upcoming_events', function (Blueprint $table) {
            $table->dropColumn('date');
        });
    }
}

}
