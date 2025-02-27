<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSupplier extends Model
{
    protected $table            = 'supplier';
    protected $primaryKey       = 'id_supplier';
    protected $allowedFields    = [
        'id_supplier',
        'nama_supplier',
        'telp_supplier',
        'alamat_supplier'
    ];
    public function AllData()
    {
        return $this->db->table('supplier')->get()->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('supplier')->insert($data);
    }
    public function UpdateData($data)
    {
        $this->db->table('supplier')
            ->where('id_supplier', $data['id_supplier'])
            ->update($data);
    }
    public function DeleteData($data)
    {
        $this->db->table('supplier')
            ->where('id_supplier', $data['id_supplier'])
            ->delete($data);
    }

    public function tampildata_cari($carisupplier)
    {
        return $this->db->table('supplier')
            ->groupStart()
            ->like('id_supplier', $carisupplier)
            ->orLike('nama_supplier', $carisupplier)
            ->orLike('alamat_supplier', $carisupplier)
            ->orLike('telp_supplier', $carisupplier)
            ->groupEnd()
            ->get()
            ->getResultArray();
    }
}
