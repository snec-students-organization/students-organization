<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('institution_id'); // Add this column

    $table->string('stream')->nullable();
    
    $table->unique('institution_id'); // Unique constraint after column definition

    $table->string('college_name');
    $table->string('organization_name');
    $table->string('organization_director_name');
    $table->string('organization_director_number');
    $table->string('counciler_name');
    $table->string('counciler_number');
    $table->string('chairman_name');
    $table->string('chairman_number');
    $table->string('convenor_name');
    $table->string('convenor_number');
    $table->timestamps();
});


    }

    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
