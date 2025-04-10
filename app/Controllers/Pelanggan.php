<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPelanggan;

class Pelanggan extends BaseController
{
    protected $ModelPelanggan;

    public function __construct()
    {
        $this->ModelPelanggan = new ModelPelanggan();
    }
    public function index()
    {
        $data = [
            'icon' => 'fas fa-users',
            'judul' => 'Master Data',
            'subjudul' => 'Pelanggan',
            'menu' => 'masterdata',
            'submenu' => 'pelanggan',
            'page' => 'pelanggan/v_pelanggan',
            'pelanggan' => $this->ModelPelanggan->AllData(),
        ];
        return view('v_template', $data);
    }
    public function InsertData()
    {
        $data = [
            'nopol' => $this->request->getPost('nopol'),
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'mobil_pelanggan' => $this->request->getPost('mobil_pelanggan'),
            'alamat_pelanggan' => $this->request->getPost('alamat_pelanggan'),
            'telp_pelanggan' => $this->request->getPost('telp_pelanggan')
        ];
        $this->ModelPelanggan->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');
        return redirect()->to('Pelanggan');
    }
    public function UpdateData($nopol)
    {
        $data = [
            'nopol' => $this->request->getPost('nopol'),
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'mobil_pelanggan' => $this->request->getPost('mobil_pelanggan'),
            'alamat_pelanggan' => $this->request->getPost('alamat_pelanggan'),
            'telp_pelanggan' => $this->request->getPost('telp_pelanggan'),
        ];

        $this->ModelPelanggan->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate!');
        return redirect()->to('Pelanggan');
    }
    public function DeleteData($nopol)
    {
        $data = [
            'nopol' => $nopol,
        ];
        $this->ModelPelanggan->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to('Pelanggan');
    }
}
