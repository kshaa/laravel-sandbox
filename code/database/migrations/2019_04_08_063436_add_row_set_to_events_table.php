<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowSetToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // let's add two more columns to store number of rows and seats for each event
        Schema::table('events', function (Blueprint $table) {
            $table->integer('rows')->nullable();
            $table->integer('seats')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('rows');
            $table->dropColumn('seats');
        });
    }
}
