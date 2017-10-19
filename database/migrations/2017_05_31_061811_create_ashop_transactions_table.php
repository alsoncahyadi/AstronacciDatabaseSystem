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
            $table->string('product_type')->nullable(); // Video, E-Book, Seasonal Report, Event, Other
            $table->string('product_name')->nullable();
            $table->bigInteger('nominal')->nullable();
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
        Schema::dropIfExists('ashop_transactions');
    }
}
