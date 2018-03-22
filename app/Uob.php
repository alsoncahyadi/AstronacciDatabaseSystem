<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uob extends Model
{
    //
    protected $table = 'uobs';

    protected $primaryKey = 'client_id';

    protected $attributImport = [ "master_id" => "master_id",
                                    "client_id" => "kode_client",
                                    "sales_name" => "sales",
                                    "sumber_data" => "sumber_data",
                                    "join_date" => "tanggal_join",
                                    "nomor_ktp" => "nomor_ktp",
                                    "tanggal_expired_ktp" => "expired_ktp",
                                    "nomor_npwp" => "nomor_npwp",
                                    "alamat_surat" => "alamat_surat_menyurat",
                                    "saudara_tidak_serumah" => "saudara_tidak_serumah",
                                    "nama_ibu_kandung" => "nama_ibu_kandung",
                                    "bank_pribadi" => "bank_pribadi",
                                    "nomor_rekening_pribadi" => "nomor_rekening_pribadi",
                                    "tanggal_rdi_done" => "tanggal_rdi_done",
                                    "rdi_bank" => "rdi_bank",
                                    "nomor_rdi" => "nomor_rdi",
                                    "tanggal_top_up" => "tanggal_top_up",
                                    "nominal_top_up" => "nominal_top_up",
                                    "tanggal_trading" => "tanggal_trading",
                                    "status" => "status",
                                    "trading_via" => "trading_via",
                                    "keterangan" => "keterangan"
                                ];

    public function getAttributesImport() {
        return $this->attributImport;
    }

    public function master() {
        return $this->belongsTo('App\MasterClient', 'master_id', 'master_id');
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
