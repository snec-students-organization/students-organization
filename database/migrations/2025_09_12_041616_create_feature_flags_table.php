// database/migrations/2025_09_12_000001_create_feature_flags_table.php

<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeatureFlagsTable extends Migration
{
    public function up()
    {
        Schema::create('feature_flags', function (Blueprint $table) {
            $table->id();
            $table->string('feature_name')->unique();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        // Seed initial flag for data collection
        DB::table('feature_flags')->insert([
            'feature_name' => 'data_collection',
            'is_active' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('feature_flags');
    }
}
