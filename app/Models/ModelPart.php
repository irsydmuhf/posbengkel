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

    public function tampildata_cari($caripart)
    {
        return $this->db->table('part')
            ->join('kategori', 'id_kategori_part = id_kategori')
            ->join('satuan', 'id_satuan_part = id_satuan')
            ->groupStart()
            ->like('id_part', $caripart)
            ->orLike('nama_part', $caripart)
            ->orLike('nama_kategori', $caripart)
            ->groupEnd()
            ->get()
            ->getResultArray();
    }
}
