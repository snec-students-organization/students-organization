<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('committee_members', function (Blueprint $table) {
    $table->id();
    $table->enum('committee_type', ['main', 'sub']);
    $table->enum('sub_committee', ['media_hub', 'creative_commune', 'literary','cultural_sphere'])->nullable();
    $table->string('name');
    $table->string('position');
    $table->string('college_name')->nullable();
    $table->string('image')->nullable();
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('committee_members');
    }
};
