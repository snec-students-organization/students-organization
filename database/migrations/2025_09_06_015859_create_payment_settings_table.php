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
    Schema::create('payment_settings', function (Blueprint $table) {
        $table->id();
        $table->string('upi_id')->nullable();
        $table->string('gpay_number')->nullable();
        $table->string('qr_image')->nullable(); // path to uploaded QR image
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_settings');
    }
};
