<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPart;
use App\Models\ModelKategori;
use App\Models\ModelSatuan;

class Part extends BaseController
{
    protected $ModelPart;

    public function __construct()
    {
        $this->ModelPart = new ModelPart();
    }
    public function index()
    {
        $modelkategori = new ModelKategori();
        $modelsatuan = new ModelSatuan();
        
        $data = [
            'judul' => 'MasterData',
            'subjudul' => 'Part',
            'menu' => 'masterdata',
            'submenu' => 'part',
            'page' => 'part/v_part',
            'part' => $this->ModelPart->AllData(),
            'datakategori' => $modelkategori->AllData(),
            'datasatuan' => $modelsatuan->AllData(),
        ];
        return view('v_template', $data);
    }

    public function InsertData()
    {

        $data = [
            'nama_part' => $this->request->getPost('nama_part'),
        ];
        $this->ModelPart->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');
        return redirect()->to('Part');
    }
    public function UpdateData($id_part)
    {
        $data = [
            'id_part' => $id_part,
            'nama_part' => $this->request->getPost('nama_part'),
        ];

        $this->ModelPart->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate!');
        return redirect()->to('Part');
    }
    public function DeleteData($id_part)
    {
        $data = [
            'id_part' => $id_part,
        ];
        $this->ModelPart->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to('Part');
    }
}
