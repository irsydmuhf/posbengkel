<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPelanggan extends Model
{
    protected $table            = 'pelanggan';
    protected $primaryKey       = 'nopol';
    protected $allowedFields    = [
        'nopol',
        'nama_pelanggan',
        'telp_pelanggan',
        'alamat_pelanggan'
    ];
    public function AllData()
    {
        return $this->db->table('pelanggan')->get()->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('pelanggan')->insert($data);
    }
    public function UpdateData($data)
    {
        $this->db->table('pelanggan')
        ->where('nopol', $data['nopol'])
        ->update($data);
    }
    public function DeleteData($data)
    {
        $this->db->table('pelanggan')
        ->where('nopol', $data['nopol'])
        ->delete($data);
    }
}
