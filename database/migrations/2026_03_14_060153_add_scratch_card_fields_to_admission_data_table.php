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
        Schema::table('admission_data', function (Blueprint $table) {
            $table->integer('scratch_card_amount')->nullable()->after('application_number');
            $table->boolean('is_scratched')->default(false)->after('scratch_card_amount');
            $table->string('gpay_number')->nullable()->after('is_scratched');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admission_data', function (Blueprint $table) {
            $table->dropColumn(['scratch_card_amount', 'is_scratched', 'gpay_number']);
        });
    }
};
