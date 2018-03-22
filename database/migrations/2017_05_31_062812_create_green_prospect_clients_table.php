<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGreenProspectClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('green_prospect_clients', function (Blueprint $table) {
            $table->increments('green_id');
            $table->date('date');
            $table->string('name', 100)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('email', 255);
            $table->text('interest')->nullable();
            $table->string('pemberi')->nullable();
            $table->text('sumber_data')->nullable();
            $table->text('keterangan_perintah')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('green_prospect_clients');
    }
}
