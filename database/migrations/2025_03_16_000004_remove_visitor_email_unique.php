<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveVisitorEmailUniqueConstraintFinalVersion extends Migration
{
    public function up()
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropUnique('visitors_visitor_email_unique');
        });
    }

    public function down()
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->string('visitor_email')->unique()->change();
        });
    }
}
