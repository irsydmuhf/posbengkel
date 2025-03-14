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
        $tombolCariSupplier  = $this->request->getPost('tombolCariSupplier');

        if (isset($tombolCariSupplier)) {
            $carisupplier = $this->request->getPost('carisupplier');
            session()->set('cari_supplier', $carisupplier);
            return redirect()->to('/supplier/index');
        } else {
            $carisupplier = session()->get('cari_supplier');
        }

        $dataSupplier = $carisupplier ? $this->ModelSupplier->cariData($carisupplier)->paginate(10, 'supplier') : $this->ModelSupplier->paginate(10, 'supplier');

        $nohalaman = $this->request->getVar('page_supplier') ?? 1;

        $data = [
            'icon' => 'fas fa-truck',
            'judul' => 'Master Data',
            'subjudul' => 'Supplier',
            'menu' => 'masterdata',
            'submenu' => 'supplier',
            'page' => 'v_supplier',
            'supplier' => $dataSupplier,
            'pager' => $this->ModelSupplier->pager,
            'nohalaman' => $nohalaman
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

        session()->setFlashdata('pesan', 'Data Berhasil Ditambah!');
        return redirect()->to('Supplier');
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
