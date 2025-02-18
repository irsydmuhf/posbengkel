<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPart;
use App\Models\ModelKategori;
use App\Models\ModelSatuan;
use CodeIgniter\Commands\Server\Serve;
use Config\Services;
use PSpell\Config;

class Part extends BaseController
{
    protected $ModelPart;

    public function __construct()
    {
        $this->ModelPart = new ModelPart();
    }
    public function index()
    {        ('tombolcari');
        $modelkategori = new ModelKategori();
        $modelsatuan = new ModelSatuan();

        $data = [
            'judul' => 'Master Data',
            'subjudul' => 'Part',
            'menu' => 'masterdata',
            'submenu' => 'part',
            'page' => 'part/v_part',
            'part' => $this->ModelPart->AllData(),
            // 'part' => $this->ModelPart->paginate(10),
            // 'pager' => $this->ModelPart->pager,
            'datakategori' => $modelkategori->AllData(),
            'datasatuan' => $modelsatuan->AllData(),
        ];
        return view('v_template', $data);
    }

    public function InsertData()
    {

        $data = [
            'id_part' => $this->request->getPost('id_part'),
            'nama_part' => $this->request->getPost('nama_part'),
            'id_kategori_part' => $this->request->getPost('kategori'),
            'id_satuan_part' => $this->request->getPost('satuan'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'stok' => $this->request->getPost('stok'),
        ];
         
        $this->ModelPart->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');
        return redirect()->to('Part');
    }
    public function UpdateData($id_part)
    {
        $data = [
            'id_part' => $this->request->getPost('id_part'),
            'nama_part' => $this->request->getPost('nama_part'),
            'id_kategori_part' => $this->request->getPost('kategori'),
            'id_satuan_part' => $this->request->getPost('satuan'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'stok' => $this->request->getPost('stok'),
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
