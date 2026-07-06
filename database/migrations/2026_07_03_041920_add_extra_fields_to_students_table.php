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
        Schema::table('students', function (Blueprint $table) {
            $table->string('whatsapp_number', 20)->nullable()->after('contact_number');
            $table->string('country', 100)->nullable()->after('whatsapp_number');
            $table->string('state', 100)->nullable()->after('country');
            $table->string('district', 100)->nullable()->after('state');
            $table->string('constituency', 100)->nullable()->after('district');
            $table->string('place', 100)->nullable()->after('constituency');
            $table->date('date_of_birth')->nullable()->after('place');
            $table->string('photo')->nullable()->after('date_of_birth');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'whatsapp_number',
                'country',
                'state',
                'district',
                'constituency',
                'place',
                'date_of_birth',
                'photo',
            ]);
        });
    }
};
