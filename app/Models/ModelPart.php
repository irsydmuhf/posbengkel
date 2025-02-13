<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPart extends Model
{
    protected $table            = 'part';
    protected $primaryKey       = 'id_part';
    protected $allowedFields    = [
        'id_part',
        'nama_part',
        'id_kategori_part',
        'id_satuan_part',
        'harga_jual',
        'harga_beli',
        'stok'
    ];
    public function AllData()
    {
        return $this->db->table('part')->join('kategori', 'id_kategori_part=id_kategori')
            ->join('satuan', 'id_satuan_part=id_satuan')->get()->getResultArray();
    }

    public function InsertData($data)
    {
        return $this->insert($data);
    }

    public function UpdateData($data)
    {
        return $this->update($data['id_part'], $data);
    }

    public function tampildata_search($search) {
        return $this->table('part')
        ->join('kategori','id_kategori_part=id_kategori')
        ->orlike('id_part', $search)
        ->orlike('nama_part', $search)
        ->orlike('nama_kategori', $search);
    }
}
