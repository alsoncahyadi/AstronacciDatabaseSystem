<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclubMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aclub_members', function (Blueprint $table) {
            $table->string('user_id', 50);
            $table->primary('user_id');
            $table->unsignedInteger('master_id');
            $table->string('sales_name')->nullable();
            $table->string('group', 5); // S, F atau RD
            $table->timestamps();
            // Tanggal-tanggal penting didapatkan dari transaksi
            // Cara mendapatkan date untuk aclub ya tinggal ambil transaksi terakhir
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
        Schema::dropIfExists('aclub_members');
    }
}
