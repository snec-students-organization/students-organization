<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->enum('status', ['pending', 'verified'])
                  ->default('pending')
                  ->after('institution_id'); // adjust position if needed
        });
    }

    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
