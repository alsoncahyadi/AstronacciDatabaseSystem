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
            $table->text('interest');
            $table->string('pemberi');
            $table->text('sumber_data');
            $table->text('keterangan_perintah');
            // $table->unique('email');
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
        Schema::dropIfExists('green_prospect_clients');
    }
}
