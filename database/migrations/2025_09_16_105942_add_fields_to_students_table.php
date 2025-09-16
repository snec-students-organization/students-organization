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
        Schema::table('students', function (Blueprint $table) {
            $table->string('stream')->after('uid'); // required, institution sets it
            $table->string('father_name')->nullable()->after('class'); // nullable
            $table->text('address')->nullable()->after('father_name'); // nullable
            $table->string('contact_number', 20)->nullable()->after('address'); // nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['stream', 'father_name', 'address', 'contact_number']);
        });
    }
};
