<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGreenProspectProgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('green_prospect_progresses', function (Blueprint $table) {
            $table->increments('progress_id');
            $table->unsignedInteger('green_id');
            $table->date('date');
            $table->string('sales_name');
            $table->string('status', 20); //GOAL - BUY, GOAL - JOIN, NO ANSWER, TIDAK GOAL, DALAM PROSES
            $table->text('nama_product');
            $table->bigInteger('nominal');
            $table->text('keterangan');
            $table->timestamps();
            $table->foreign('green_id')->references('green_id')
                ->on('green_prospect_clients')
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
        Schema::dropIfExists('green_prospect_progresses');
    }
}
