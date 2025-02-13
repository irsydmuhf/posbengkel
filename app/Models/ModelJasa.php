<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelJasa extends Model
{
    protected $table            = 'jasa';
    protected $primaryKey       = 'id_jasa';
    protected $allowedFields    = ['id_jasa', 'nama_jasa', 'harga_jasa'];

    public function AllData()
    {
        return $this->db->table('jasa')->get()->getResultArray();
    }

    public function InsertData($data)
    {
        return $this->insert($data);
    }

    public function UpdateData($data)
    {
        return $this->update($data['id_jasa'], $data);
    }
    public function DeleteData($data)
    {
        $this->db->table('jasa')
        ->where('id_jasa', $data['id_jasa'])
        ->delete($data);
    }
}
