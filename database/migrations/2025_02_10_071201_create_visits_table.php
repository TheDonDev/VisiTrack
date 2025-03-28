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
            $table->id(); // Auto-incrementing primary key
            $table->string('visit_number')->unique(); // Ensure visit_number is unique
            $table->foreignId('visitor_id')->constrained('visitors');
            $table->foreignId('host_id')->constrained('hosts');
            $table->string('visit_type');
            $table->string('visit_facility');
            $table->date('visit_date');
            $table->time('visit_from');
            $table->time('visit_to');
            $table->string('purpose_of_visit');
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
