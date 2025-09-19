<?php

// database/migrations/2025_09_19_000000_create_monthly_reports_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('monthly_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->string('college_name');
            $table->string('month'); // e.g., "September"
            $table->year('year');
            $table->string('file_path'); // path to uploaded file
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('monthly_reports');
    }
};

