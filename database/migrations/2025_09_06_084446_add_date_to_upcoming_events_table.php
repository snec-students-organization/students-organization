<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('upcoming_events', function (Blueprint $table) {
        $table->date('date')->nullable()->after('title');
    });
}

public function down()
{
    Schema::table('upcoming_events', function (Blueprint $table) {
        $table->dropColumn('date');
    });
}

};
