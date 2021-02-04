<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('do_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('do');
            $table->string('status');
            $table->integer('order_item')->default('1');
            $table->integer('user_id');
            $table->timestamps();

            $table->index('id');
            $table->unique('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('do_lists');
    }
}
