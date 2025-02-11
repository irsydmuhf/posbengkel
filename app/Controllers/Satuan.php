<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelSatuan;

class Satuan extends BaseController
{
    protected $ModelSatuan;
    public function __construct()
    {
        $this->ModelSatuan = new ModelSatuan();
    }
    public function index()
    {
        $data = [
            'judul' => 'MasterData',
            'subjudul' => 'Satuan',
            'menu' => 'masterdata',
            'submenu' => 'satuan',
            'page' => 'v_satuan',
            'satuan' => $this->ModelSatuan->AllData(),
        ];
        return view('v_template', $data);
    }
    public function InsertData()
    {
        $data = ['nama_satuan' => $this->request->getPost('nama_satuan')];
        $this->ModelSatuan->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');
        return redirect()->to('Satuan');
    }
    public function UpdateData($kode_satuan)
    {
        $data = [
            'kode_satuan' => $kode_satuan,
            'nama_satuan' => $this->request->getPost('nama_satuan')
        ];

        $this->ModelSatuan->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate!');
        return redirect()->to('Satuan');
    }
    public function DeleteData($kode_satuan)
    {
        $data = [
            'kode_satuan' => $kode_satuan,
        ];
        $this->ModelSatuan->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to('Satuan');
    }
}
