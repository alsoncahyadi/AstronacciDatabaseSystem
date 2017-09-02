<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMrgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mrgs', function($t) {
            $t->unsignedInteger('master_id');
            $t->primary('master_id');  
            $t->text('sumber_data')->nullable();
            $t->date('join_date')->nullable();
            $t->timestamps();

            $t->foreign('master_id')->references('master_id')
                ->on('master_clients')
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
        Schema::dropIfExists('mrgs');
    }
}
