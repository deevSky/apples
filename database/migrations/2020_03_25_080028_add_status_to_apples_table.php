<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToApplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apples', function (Blueprint $table) {
            $table->enum('status', ['On tree', 'On ground', 'Spoiled']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apples', function (Blueprint $table) {
           $table->dropIfExists('status');
        });
    }
}
