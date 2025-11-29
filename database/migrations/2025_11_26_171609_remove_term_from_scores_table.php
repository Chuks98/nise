<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('scores', function (Blueprint $table) {
            if (Schema::hasColumn('scores', 'term')) {
                $table->dropColumn('term');
            }
        });
    }

    public function down()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->string('term')->nullable();
        });
    }
};
