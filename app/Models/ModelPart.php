<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPart extends Model
{
    public function AllData()
    {
        return $this->db->table('part')->join('kategori', 'id_kategori_part=id_kategori')
        ->join('satuan','id_satuan_part=id_satuan')->get()->getResultArray();
    }
    // protected $table            = 'part';
    // protected $primaryKey       = 'id_part';
    // protected $allowedFields    = [
    //     'id_part', 'nama_part', 'id_kategori_part', 'id_satuan_part',
    //     'harga_jual', 'harga_beli', 'stok'
    // ];

    // public function tampilData(){
    //    return $this->table('part')->join('kategori', 'id_kategori_part=id_kategori')
    //    ->join('satuan','id_satuan_part=id_satuan')->get;
    // }
}
