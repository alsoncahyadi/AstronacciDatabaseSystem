    <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uobs', function (Blueprint $table) {
            $table->string('client_id', 50);
            $table->primary('client_id');
            $table->unsignedInteger('master_id');            
           
            $table->string('sales_name');
            $table->text('sumber_data')->nullable();

            $table->date('join_date');
            $table->string('nomor_ktp', 20);
            $table->date('tanggal_expired_ktp')->nullable();
            $table->string('nomor_npwp', 40);
            $table->text('alamat_surat')->nullable();
            $table->text('saudara_tidak_serumah')->nullable();
            $table->text('nama_ibu_kandung')->nullable();

            $table->string('bank_pribadi');
            $table->string('nomor_rekening_pribadi', 50);
            $table->date('tanggal_rdi_done');
            $table->string('rdi_bank', 20);
            $table->string('nomor_rdi');
            $table->date('tanggal_top_up');
            $table->bigInteger('nominal_top_up');
            $table->date('tanggal_trading');
            $table->string('status');
            $table->string('trading_via');

            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('uobs');
    }
}
