<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
Schema::create('visitors', function (Blueprint $table) {
    $table->id(); // Auto-incrementing primary key
    $table->string('first_name');
    $table->string('last_name');
    $table->string('email');
    $table->string('phone_number');
    $table->string('designation')->nullable();
    $table->string('organization')->nullable();
    $table->string('id_number')->nullable();
    $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
