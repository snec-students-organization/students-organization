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
        Schema::create('weekly_talents_meets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained('institutions')->onDelete('cascade');
            $table->string('title');
            $table->date('meet_date');
            $table->string('qiraath')->nullable();
            $table->string('presidential_address')->nullable();
            $table->string('inauguration_talk')->nullable();
            $table->string('welcome_speech')->nullable();
            $table->text('speeches')->nullable(); // Speeches (can list names or descriptions)
            $table->text('songs')->nullable();    // Songs (can list names or descriptions)
            $table->string('vote_of_thanks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_talents_meets');
    }
};
