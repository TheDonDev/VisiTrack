<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVisitorsTable extends Migration
{
    public function up()
    {
        Schema::table('visitors', function (Blueprint $table) {
            // Remove the visit_number column if it exists
            if (Schema::hasColumn('visitors', 'visit_number')) {
                $table->dropColumn('visit_number');
            }
        });
    }

    public function down()
    {
        Schema::table('visitors', function (Blueprint $table) {
            // Re-add the visit_number column if needed
            $table->string('visit_number')->nullable();
        });
    }
}
