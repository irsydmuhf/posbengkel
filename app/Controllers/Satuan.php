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
            'icon' => 'fas fa-ruler',
            'judul' => 'Master Data',
<<<<<<< HEAD
            'subjudul' => 'Satuan',
=======
            'subjudul' => ' Satuan',
>>>>>>> 5fba8374d417af574a3a4c127161e8378830b650
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
