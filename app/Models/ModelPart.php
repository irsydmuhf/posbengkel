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
        return $this->table('part')
        ->join('kategori', 'id_kategori_part = id_kategori', 'left')
        ->join('satuan', 'id_satuan_part = id_satuan', 'left');
    }
    // public function AllData($keyword = null, $page = 1)
    // {
    //     $perPage = 10;
    //     $offset = ($page - 1) * $perPage;

    //     $builder = $this->db->table('part')
    //         ->join('kategori', 'id_kategori_part = id_kategori')
    //         ->join('satuan', 'id_satuan_part = id_satuan')
    //         ->groupBy('part.id_part');

    //     if (!empty($keyword)) {
    //         $builder->groupStart()
    //             ->like('part.id_part', $keyword)
    //             ->orLike('part.nama_part', $keyword)
    //             ->orLike('kategori.nama_kategori', $keyword)
    //             ->groupEnd();
    //     }

    //     $builder->limit($perPage, $offset);

    //     return $builder->get()->getResultArray();
    // }

    public function InsertData($data)
    {
        return $this->insert($data);
    }

    public function UpdateData($data)
    {
        return $this->update($data['id_part'], $data);
    }

    public function DeleteData($data)
    {
        $this->db->table('part')
            ->where('id_part', $data['id_part'])
            ->delete($data);
    }

    public function tampildata_cari($caripart)
    {
        return $this->table('part')
            ->join('kategori', 'id_kategori_part = id_kategori')
            ->join('satuan', 'id_satuan_part = id_satuan')
            ->like('id_part', $caripart)
            ->orLike('nama_part', $caripart)
            ->orLike('nama_kategori', $caripart);
    }
}
