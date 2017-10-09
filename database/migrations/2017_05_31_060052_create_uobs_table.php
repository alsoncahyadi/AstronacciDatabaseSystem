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

            $table->string('sales_name')->nullable();
            $table->text('sumber_data')->nullable();

            $table->date('join_date')->nullable();
            $table->string('nomor_ktp', 20)->nullable();
            $table->date('tanggal_expired_ktp')->nullable();
            $table->string('nomor_npwp', 40)->nullable();
            $table->text('alamat_surat')->nullable();
            $table->text('saudara_tidak_serumah')->nullable();
            $table->text('nama_ibu_kandung')->nullable();

            $table->string('bank_pribadi')->nullable();
            $table->string('nomor_rekening_pribadi', 50)->nullable();
            $table->date('tanggal_rdi_done')->nullable();
            $table->string('rdi_bank', 20)->nullable();
            $table->string('nomor_rdi')->nullable();
            $table->date('tanggal_top_up')->nullable();
            $table->bigInteger('nominal_top_up')->nullable();
            $table->date('tanggal_trading')->nullable();
            $table->string('status')->nullable();
            $table->string('trading_via')->nullable();

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
