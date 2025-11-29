<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('scores', function (Blueprint $table) {
            // Remove old columns
            $table->dropColumn([
                'sheet_name',
                'subject',
                'ca_i',
                'ca_ii',
                'ca_iii',
                'test_total',
                'exam',
                'grade',
                'highest_in_class',
                'lowest_in_class',
            ]);

            // New structure
            if (!Schema::hasColumn('scores', 'semester')) {
                $table->string('semester')->nullable();
            }
            if (!Schema::hasColumn('scores', 'average')) {
                $table->string('average')->nullable();
            }

            // Modify to match new fields
            $table->string('session')->nullable()->change();
            $table->string('class')->nullable()->change();
            $table->string('total')->nullable()->change();
            $table->string('position')->nullable()->change();
            $table->string('remarks')->nullable()->change();
        });
    }

    public function down()
    {
        // optional rollback
    }
};
