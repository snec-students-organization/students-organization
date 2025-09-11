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
    Schema::table('gallery_events', function (Blueprint $table) {
        $table->boolean('marked')->default(false)->after('cover_image');
    });
}

public function down()
{
    Schema::table('gallery_events', function (Blueprint $table) {
        $table->dropColumn('marked');
    });
}

};
