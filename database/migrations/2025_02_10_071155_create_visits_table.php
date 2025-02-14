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
    Schema::create('visits', function (Blueprint $table) {
        $table->id();
        $table->string('visitor_name');
        $table->string('visitor_last_name');
        $table->string('designation');
        $table->string('organization');
        $table->string('visitor_email');
        $table->string('visitor_number');
        $table->string('id_number');
        $table->string('visit_type');
        $table->string('visit_facility');
        $table->date('visit_date');
        $table->time('visit_from');
        $table->time('visit_to');
        $table->text('purpose_of_visit');
        $table->string('visit_number')->unique(); // Add visit_number column
        $table->foreignId('host_id')->constrained('hosts');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
