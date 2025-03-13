<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKategori extends Model
{

    protected $table            = 'kategori';
    protected $primaryKey       = 'id_kategori';
    protected $allowedFields    = [
        'id_kategori',
        'nama_kategori',
    ];
    // public function AllData()
    // {
    //     return $this->db->table('kategori')->get()->getResultArray();
    // }

    public function InsertData($data)
    {
        $this->db->table('kategori')->insert($data);
    }
    public function UpdateData($data)
    {
        $this->db->table('kategori')
            ->where('id_kategori', $data['id_kategori'])
            ->update($data);
    }
    public function DeleteData($data)
    {
        $this->db->table('kategori')
            ->where('id_kategori', $data['id_kategori'])
            ->delete($data);
    }

    public function cariData($carikategori)
    {
        return $this->table('kategori')->like('nama_kategori', $carikategori);
    }
}
