<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('rank_id')->unsigned();
            $table->integer('drugAddiction');
            $table->string('description');
            $table->integer('countSession');
            $table->string('hepatitisB');
            $table->string('hepatitisC');
            $table->string('HIV');
            $table->string('staphylococcus');
            $table->string('allergies');
            $table->string('vision');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
