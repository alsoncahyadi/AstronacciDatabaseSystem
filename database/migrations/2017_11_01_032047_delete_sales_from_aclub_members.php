<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteSalesFromAclubMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aclub_members', function (Blueprint $table) {
            //
            $table->dropColumn('sales_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aclub_members', function (Blueprint $table) {
            //
            $table->string('sales_name')->nullable();
        });
    }
}
