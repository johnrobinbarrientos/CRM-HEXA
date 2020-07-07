<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_locations', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->string('location_code')->nullable();
            $table->string('location_name')->nullable();
            $table->string('location_shortname')->nullable();
            $table->integer('is_group')->nullable();

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
        Schema::dropIfExists('master_locations');
    }
}
