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
    {
        $modelkategori = new ModelKategori();
        $modelsatuan = new ModelSatuan();

        $tombolCariPart  = $this->request->getPost('tombolCariPart');

        if (isset($tombolCariPart)) {
            $caripart = $this->request->getPost('caripart');
            session()->set('cari_part', $caripart);
            return redirect()->to('/part/index');
        } else {
            $caripart = session()->get('cari_part');
        }

        $dataPart = $caripart ? $this->ModelPart->tampildata_cari($caripart)->paginate(10, 'part') : $this->ModelPart->paginate(10, 'part');

        $totaldata = $caripart ? $this->ModelPart->tampildata_cari($caripart)->countAllResults() : $this->ModelPart->AllData()->countAllResults();

        $nohalaman = $this->request->getVar('page_part') ?? 1;

        $data = [
            'icon' => 'fas fa-cube',
            'judul' => 'Master Data',
            'subjudul' => ' Part',
            'menu' => 'masterdata',
            'submenu' => 'part',
            'page' => 'part/v_part',
            'part' => $dataPart,
            // 'part' => $this->ModelPart->paginate(10, 'part'),
            'totaldata' => $totaldata,
            'pager' => $this->ModelPart->pager,
            'nohalaman' => $nohalaman,
            'datakategori' => $modelkategori->AllData(),
            'datasatuan' => $modelsatuan->AllData(),
        ];
        return view('v_template', $data);
    }

    // public function cariDataPart()
    // {
    //     $keyword = $this->request->getPost('keyword');
    //     $modelPart = new ModelPart();
    //     $data = $modelPart->AllData($keyword);
    //     return $this->response->setJSON($data);
    // }

    public function InsertData()
    {

        $data = [
            'id_part' => $this->request->getPost('id_part'),
            'nama_part' => $this->request->getPost('nama_part'),
            'id_kategori_part' => $this->request->getPost('kategori'),
            'id_satuan_part' => $this->request->getPost('satuan'),
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
            'harga_jual' => $this->request->getPost('harga_jual'),
            'stok' => $this->request->getPost('stok'),
        ];

        $this->ModelPart->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate!');
        return redirect()->to('Part');
    }
    public function DeleteData()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $ModelPart = new ModelPart();
            $ModelPart->delete($id);
            session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
            echo json_encode(['redirect' => base_url('Part')]);
        } else {
            exit('Tidak bisa dipanggil');
        }
    }
}
