<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelSupplier;

class Supplier extends BaseController
{
    protected $ModelSupplier;

    public function __construct()
    {
        $this->ModelSupplier = new ModelSupplier();
    }
    public function index()
    {
        $data = [
            'judul' => 'MasterData',
            'subjudul' => 'Supplier',
            'menu' => 'masterdata',
            'submenu' => 'supplier',
            'page' => 'v_supplier',
            'supplier' => $this->ModelSupplier->AllData(),
        ];
        return view('v_template', $data);
    }
    public function InsertData()
    {
        $data = [
            'nama_supplier' => $this->request->getPost('nama_supplier'),
            'alamat_supplier' => $this->request->getPost('alamat_supplier'),
            'telp_supplier' => $this->request->getPost('telp_supplier')
        ];

        $this->ModelSupplier->InsertData($data);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Data Berhasil Ditambahkan!']);
    }
    public function UpdateData($id_supplier)
    {
        $data = [
            'id_supplier' => $id_supplier,
            'nama_supplier' => $this->request->getPost('nama_supplier'),
            'telp_supplier' => $this->request->getPost('telp_supplier'),
        ];

        $this->ModelSupplier->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate!');
        return redirect()->to('Supplier');
    }
    public function DeleteData($id_supplier)
    {
        $data = [
            'id_supplier' => $id_supplier,
        ];
        $this->ModelSupplier->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to('Supplier');
    }
}
