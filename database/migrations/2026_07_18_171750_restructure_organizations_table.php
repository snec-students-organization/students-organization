<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->string('affiliation_number')->after('college_name');
            $table->string('contact_number')->after('organization_name');
            $table->string('email')->after('contact_number');

            $table->dropColumn([
                'organization_director_name',
                'organization_director_number',
                'counciler_name',
                'counciler_number',
                'chairman_name',
                'chairman_number',
                'convenor_name',
                'convenor_number',
                'stream'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn(['affiliation_number', 'contact_number', 'email']);

            $table->string('organization_director_name');
            $table->string('organization_director_number');
            $table->string('counciler_name');
            $table->string('counciler_number');
            $table->string('chairman_name');
            $table->string('chairman_number');
            $table->string('convenor_name');
            $table->string('convenor_number');
            $table->string('stream')->nullable();
        });
    }
};
