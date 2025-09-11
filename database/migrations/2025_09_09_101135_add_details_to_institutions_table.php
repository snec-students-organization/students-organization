<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToInstitutionsTable extends Migration
{
    public function up()
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->string('full_name')->nullable();
            $table->string('short_name')->nullable();
            $table->string('stream')->nullable();
            $table->string('affiliation_number')->nullable();
            $table->string('place')->nullable();
            $table->text('address')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('organization_short_name')->nullable();
        });
    }

    public function down()
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->dropColumn([
                'full_name',
                'short_name',
                'stream',
                'affiliation_number',
                'place',
                'address',
                'organization_name',
                'organization_short_name',
            ]);
        });
    }
}
