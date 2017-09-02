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
            $table->foreign('user_id')->references('user_id')
                ->on('aclub_members')
                ->onDelete('cascade');
            // $table->unsignedInteger('master_id');
            // $table->foreign('master_id')->references('master_id')
            //     ->on('master_clients')
            //     ->onDelete('cascade');
            $table->date('payment_date')->nullable();
            $table->string('kode', 5);
            $table->string('status', 20);
            $table->bigInteger('nominal');
            $table->date('start_date');
            $table->date('expired_date');
            $table->date('masa_tenggang');
            $table->date('yellow_zone');
            $table->date('red_zone');
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
        Schema::dropIfExists('aclub_transactions');
    }
}
