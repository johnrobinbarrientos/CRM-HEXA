<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterLocationGroupRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_location_group_relations', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->string('location_id')->nullable();
            $table->string('location_group_id')->nullable();


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
        Schema::dropIfExists('master_location_group_relations');
    }
}
