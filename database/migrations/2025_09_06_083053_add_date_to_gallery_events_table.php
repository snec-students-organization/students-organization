<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateToGalleryEventsTable extends Migration
{
    public function up(): void
    {
        Schema::table('gallery_events', function (Blueprint $table) {
            $table->date('date')->nullable()->after('marked');
        });
    }

    public function down(): void
    {
        Schema::table('gallery_events', function (Blueprint $table) {
            $table->dropColumn('date');
        });
    }
}
