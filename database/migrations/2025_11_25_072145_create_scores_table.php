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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();

            // General info
            $table->string('sheet_name')->nullable(); // e.g Basic Technology, Agric, etc.
            $table->string('session')->nullable();
            $table->string('subject')->nullable();
            $table->string('term')->nullable();
            $table->string('class')->nullable();

            // Table data
            $table->integer('s_no')->nullable();
            $table->string('name')->nullable();
            $table->string('reg_no')->nullable();
            $table->integer('ca_i')->nullable();
            $table->integer('ca_ii')->nullable();
            $table->integer('ca_iii')->nullable();
            $table->integer('test_total')->nullable();
            $table->integer('exam')->nullable();
            $table->integer('total')->nullable();
            $table->string('grade')->nullable();
            $table->integer('highest_in_class')->nullable();
            $table->integer('lowest_in_class')->nullable();
            $table->integer('position')->nullable();
            $table->string('remarks')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
