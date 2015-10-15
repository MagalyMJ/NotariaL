<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceParticipatTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // this table es the result of many to many between expenses table and servcies table
        Schema::create('participant_type_service', function(Blueprint $table)
        {
            $table->integer('service_id')->unsigned();
            $table->integer('participant_type_id')->unsigned();
    
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('participant_type_service');
    }
}
