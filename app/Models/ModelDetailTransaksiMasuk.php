<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDetailTransaksiMasuk extends Model
{
    protected $table            = 'det_transaksi_masuk';
    protected $primaryKey       = 'id_detbeli';
    protected $allowedFields    = [
        'id_detbeli', 'faktur_detbeli', 'id_part_detbeli', 'nama_part_detbeli',
        'hargabeli_detbeli', 'hargajual_detbeli', 'jml_detbeli', 'subtotal_detbeli'
    ];
}
