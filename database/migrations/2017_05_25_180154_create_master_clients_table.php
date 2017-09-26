<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_clients', function(Blueprint $table) {
            $table->increments('master_id');
            $table->string('redclub_user_id', 100)->nullable();
            $table->string('redclub_password')->nullable();
            $table->string('name', 100)->nullable();
            $table->string('telephone_number', 50)->nullable();
            $table->string('email', 255);
            $table->unique('email');
            $table->date('birthdate')->nullable();
            $table->string('address', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('province', 100)->nullable();
            $table->string('gender', 1)->nullable();
            $table->string('line_id', 20)->nullable();
            $table->string('bbm', 20)->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->string('facebook', 20)->nullable();
            $table->timestamps();
            $table->unsignedInteger('created_by')->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedInteger('updated_by')->references('id')
                ->on('users')
                ->onDelete('cascade');            
        });

        $statement = "ALTER TABLE master_clients AUTO_INCREMENT = 100001;";
        DB::unprepared($statement);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_clients');
    }
}
