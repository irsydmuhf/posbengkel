<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksiKeluar;
use App\Models\ModelPelanggan;
use App\Models\ModelJasa;
use App\Models\ModelPart;

class TransaksiKeluar extends BaseController
{
    protected $ModelTransaksiKeluar;

    public function __construct()
    {
        $this->ModelTransaksiKeluar = new ModelTransaksiKeluar();
    }
    public function index()
    {
        $modelpart = new ModelPart();
        $modeljasa = new ModelJasa();

        $data = [
            'judul' => 'Transaksi',
            'subjudul' => '',
            'menu' => 'transaksi',
            'submenu' => 'Transaksi Keluar',
            'page' => 'transaksi_keluar/v_keluar',
            'datapart' => $modelpart->AllData(),
            'datajasa' => $modeljasa->AllData(),
        ];
        return view('v_template', $data);
    }
    public function ambilDataPelanggan()
    {
        if ($this->request->isAJAX()) {
            $id_pelanggan = $this->request->getPost('id_pelanggan');

            $modelPelanggan = new ModelPelanggan();
            $ambilData = $modelPelanggan->find($id_pelanggan);

            if ($ambilData) {
                $data = [
                    'nama_pelanggan' => $ambilData['nama_pelanggan']
                ];

                $json = [
                    'sukses' => $data
                ];
            } else {
                $json = [
                    'error' => 'Pelanggan tidak ditemukan'
                ];
            }

            echo json_encode($json);
        } else {
            exit('Tidak bisa dipanggil');
        }
    }
}
