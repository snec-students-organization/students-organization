<?php

// database/migrations/2025_09_12_000003_create_institution_data_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionDataTable extends Migration
{
    public function up()
    {
        Schema::create('institution_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->string('college_name');
            $table->string('stream');
            $table->string('affiliation_number');
            $table->text('full_address');
            $table->string('college_organization_full_name');
            $table->string('college_organization_short_name');
            $table->string('membership_number');
            $table->string('organization_director_name');
            $table->string('organization_director_contact');
            $table->string('chairman_name');
            $table->string('chairman_contact');
            $table->string('convener_name');
            $table->string('convener_contact');
            $table->string('treasurer_name');
            $table->string('treasurer_contact');
            $table->text('councilers_name_contact'); // Can hold multiple as JSON or text.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('institution_data');
    }
}
