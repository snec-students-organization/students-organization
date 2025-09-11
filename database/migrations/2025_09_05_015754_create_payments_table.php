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
    {Schema::create('payments', function (Blueprint $table) {
    $table->id();
    $table->enum('type', ['user', 'institution']); // who made payment
    $table->string('upi_id')->nullable();
    $table->string('gpay_number')->nullable();
    $table->string('qr_code_path')->nullable();
    $table->string('screenshot_path')->nullable();

    // User fields
    $table->string('uid_number')->nullable();
    $table->string('college_name')->nullable();
    $table->string('name')->nullable();
    $table->string('class')->nullable();

    // Institution fields
    $table->string('institution_name')->nullable();
    $table->integer('no_of_students')->nullable();
    $table->json('paid_students_uid')->nullable(); // store as array

    $table->decimal('amount', 10, 2);

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
