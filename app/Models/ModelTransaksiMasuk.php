<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksiMasuk extends Model
{
    protected $table            = 'transaksi_masuk';
    protected $primaryKey       = 'faktur_beli';
    protected $allowedFields    = [
        'faktur_beli', 'tgl_beli', 'id_supp_beli', 'total_beli'
    ];

   
}
