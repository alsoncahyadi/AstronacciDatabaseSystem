<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMrgAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mrg_accounts', function (Blueprint $table) {
            $table->string('accounts_number', 20);
            $table->primary('accounts_number');
            $table->unsignedInteger('master_id');            
            $table->string('account_type', 20)->nullable();
            $table->string('sales_name')->nullable();
            $table->timestamps();

            $table->foreign('master_id')->references('master_id')
                ->on('mrgs')
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
        Schema::dropIfExists('mrg_accounts');
    }
}
