<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSatuan extends Model
{
    public function AllData()
    {
        return $this->db->table('satuan')->get()->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('satuan')->insert($data);
    }
    public function UpdateData($data)
    {
        $this->db->table('satuan')
        ->where('kode_satuan', $data['kode_satuan'])
        ->update($data);
    }
    public function DeleteData($data)
    {
        $this->db->table('satuan')
        ->where('kode_satuan', $data['kode_satuan'])
        ->delete($data);
    }
}
