<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKategori;

class Kategori extends BaseController
{
    protected $ModelKategori;

    public function __construct()
    {
        $this->ModelKategori = new ModelKategori();
    }
    public function index()
    {
        $nohalaman = $this->request->getVar('page_kategori') ? $this->request->getVar('page_kategori') : 1;
        $data = [
            'icon' => 'fas fa-th-list',
            'judul' => 'Master Data',
            'subjudul' => 'Kategori',
            'menu' => 'masterdata',
            'submenu' => 'kategori',
            'page' => 'v_kategori',
            // 'kategori' => $this->ModelKategori->AllData(),
            'kategori' => $this->ModelKategori->paginate(5, 'kategori'),
            'pager' => $this->ModelKategori->pager,
            'nohalaman' => $nohalaman
        ];
        return view('v_template', $data);
    }
    public function InsertData()
    {
        $data = ['nama_kategori' => $this->request->getPost('nama_kategori')];
        $this->ModelKategori->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');
        return redirect()->to('Kategori');
    }
    public function UpdateData($id_kategori)
    {
        $data = [
            'id_kategori' => $id_kategori,
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ];

        $this->ModelKategori->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate!');
        return redirect()->to('Kategori');
    }
    public function DeleteData($id_kategori)
    {
        $data = [
            'id_kategori' => $id_kategori,
        ];
        $this->ModelKategori->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to('Kategori');
    }
}
