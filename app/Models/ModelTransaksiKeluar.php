<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksiKeluar extends Model
{
    protected $table            = 'transaksi_keluar';
    protected $primaryKey       = 'faktur_jual';
    protected $allowedFields    = [
        'faktur_jual', 'tgl_jual', 'id_pel_jual', 'total_jual'
    ];

    public function noFaktur($tgl)
    {
        return $this->table('transaksi_keluar ')->SELECT('MAX(faktur_jual) AS nofaktur')->WHERE('tgl_jual', $tgl)->get();
    }
}


