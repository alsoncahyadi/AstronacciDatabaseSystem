<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAshopTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ashop_transactions', function (Blueprint $table) {
            $table->increments('transaction_id');
            $table->unsignedInteger('master_id');
            $table->foreign('master_id')->references('master_id')
                ->on('master_clients')
                ->onDelete('cascade');
            $table->string('product_type'); // Video, E-Book, Seasonal Report, Event, Other
            $table->string('product_name');
            $table->bigInteger('nominal');
            // $table->bigInteger('total');
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
        Schema::dropIfExists('ashop_transactions');
    }
}
