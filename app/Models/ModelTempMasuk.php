<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTempMasuk extends Model
{
    protected $table            = 'temp_trans_masuk';
    protected $primaryKey       = 'id_detbeli';
    protected $allowedFields    = [
        'id_detbeli', 'faktur_detbeli', 'id_part_detbeli','id_supp_detbeli', 'nama_part_detbeli',
        'hargabeli_detbeli', 'hargajual_detbeli', 'jml_detbeli', 'subtotal_detbeli'
    ];

    public function tampilDataTemp($faktur) {
        return $this->table('temp_trans_masuk')->join('part', 'id_part=id_part_detbeli')
        ->where(['faktur_detbeli' => $faktur])->get();
    }
}
