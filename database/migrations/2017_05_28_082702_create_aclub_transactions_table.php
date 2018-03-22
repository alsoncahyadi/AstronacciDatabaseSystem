<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclubTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aclub_transactions', function (Blueprint $table) {
            $table->increments('transaction_id');
            $table->string('user_id', 50);
            $table->date('payment_date')->nullable();
            $table->string('kode', 5)->nullable();
            $table->string('status', 20)->nullable();
            $table->bigInteger('nominal')->nullable();
            $table->date('start_date')->nullable();
            $table->date('expired_date')->nullable();
            $table->date('masa_tenggang')->nullable();
            $table->date('yellow_zone')->nullable();
            $table->date('red_zone')->nullable();
            $table->timestamps();
            $table->string('sales_name');

            $table->foreign('user_id')->references('user_id')
                ->on('aclub_members')
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
        Schema::dropIfExists('aclub_transactions');
    }
}
