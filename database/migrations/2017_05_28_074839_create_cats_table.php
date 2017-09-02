<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
  *User ID
  *Batch
  *Sales
  *Sumber Data
  *INFO ATA
  *Nomer Induk
  *DP Date
  *DP Nominal
  *Payment Date
  *Payment Nominal
  *Opening Class
  *End Class
  *Ujian
  *Status
  *Keterangan
*/

class CreateCatsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cats', function (Blueprint $table) {
          // This segment is really needed to asked
            $table->string('user_id', 50);
            $table->primary('user_id');
            $table->string('nomor_induk', 50);
            $table->unique('nomor_induk');
          //
            $table->unsignedInteger('master_id');
            $table->foreign('master_id')->references('master_id')
                ->on('master_clients')
                ->onDelete('cascade');

            $table->string('batch', 20)->nullable();
            $table->string('sales', 100)->nullable();
            $table->string('sumber_data', 20)->nullable();
            $table->date('DP_date')->nullable();
            $table->bigInteger('DP_nominal')->nullable();
            $table->date('payment_date')->nullable();
            $table->bigInteger('payment_nominal')->nullable();
            $table->date('tanggal_opening_class')->nullable();
            $table->date('tanggal_end_class')->nullable();
            $table->date('tanggal_ujian', 20)->nullable();
            $table->string('status', 20)->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('cats');
    }
}
