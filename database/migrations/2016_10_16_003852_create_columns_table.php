<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateColumnsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('columns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('column_name');
            $table->string('data_type');
            $table->string('character_maximum_length')->nullable();
            $table->string('is_foreing')->nullable();
            $table->string('referencian')->nullable();
            $table->string('table');
            $table->string('referenciados')->nullable();
            $table->string('numeric_precision')->nullable();
            $table->string('is_nullable');
            $table->string('constraint_type')->nullable();
            $table->string('column_default')->nullable();
            $table->string('check_clause')->nullable();
            $table->boolean('filled');
            $table->integer('table_id')->unsigned();
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('columns');
    }
}
