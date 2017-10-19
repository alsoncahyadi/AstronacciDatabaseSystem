<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclubInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aclub_informations', function (Blueprint $table) {
          $table->unsignedInteger('master_id');
          $table->primary('master_id');
          $table->text('sumber_data')->nullable();
          $table->text('keterangan')->nullable();
          $table->timestamps();
          
          $table->foreign('master_id')->references('master_id')
              ->on('master_clients')
              ->onDelete('cascade');
          $table->unsignedInteger('created_by')->references('id')
              ->on('users')
              ->onDelete('cascade');
          $table->unsignedInteger('updated_by')->references('id')
              ->on('users')
              ->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aclub_informations');
    }
}
