<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelJasa;

class Jasa extends BaseController
{
    protected $ModelJasa;
    public function __construct()
    {
        $this->ModelJasa = new ModelJasa();
    }
    public function index()
    {
        $data = [
            'icon' => 'fas fa-tools',
            'judul' => 'Master Data',
<<<<<<< HEAD
            'subjudul' => 'Jasa',
=======
            'subjudul' => ' Jasa',
>>>>>>> 5fba8374d417af574a3a4c127161e8378830b650
            'menu' => 'masterdata',
            'submenu' => 'jasa',
            'page' => 'jasa/v_jasa',
            'jasa' => $this->ModelJasa->AllData(),
        ];
        return view('v_template', $data);
    }
    public function InsertData()
    {
        $data = [
            'id_jasa' => $this->request->getPost('id_jasa'),
            'nama_jasa' => $this->request->getPost('nama_jasa'),
            'harga_jasa' => $this->request->getPost('harga_jasa')
        ];
        $this->ModelJasa->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');
        return redirect()->to('Jasa');
    }
    public function UpdateData($id_jasa)
    {
        $data = [
            'id_jasa' => $id_jasa,
            'nama_jasa' => $this->request->getPost('nama_jasa'),
            'harga_jasa' => $this->request->getPost('harga_jasa'),
        ];

        $this->ModelJasa->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate!');
        return redirect()->to('Jasa');
    }
    public function DeleteData($id_jasa)
    {
        $data = [
            'id_jasa' => $id_jasa,
        ];
        $this->ModelJasa->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to('Jasa');
    }
}
