<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTempKeluar extends Model
{
    protected $table            = 'temp_trans_keluar';
    protected $primaryKey       = 'id_detjual';

    protected $allowedFields = ['id_detjual', 'faktur_detjual', 'id_part_detjual', 'nama_part_detjual',    'id_jasa_detjual',    'nama_jasa_detjual', 'hargajual_detjual', 'jml_detjual', 'subtotal_detjual'];

    public function tampilDataTemp($faktur)
    {
        return $this->table('temp_trans_keluar')->join('part', 'id_part=id_part_detjual')
        ->join('jasa', 'id_jasa=id_jasa_detjual')
            ->where(['faktur_detjual' => $faktur])->get();
    }
}
