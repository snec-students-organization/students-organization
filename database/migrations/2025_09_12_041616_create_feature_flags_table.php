<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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

        // Seed initial flags
        DB::table('feature_flags')->insert([
            [
                'feature_name' => 'data_collection',
                'is_active'   => false,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'feature_name' => 'student_data',
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('feature_flags');
    }
}
