<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTempMasuk;
use App\Models\ModelPart;
use App\Models\ModelSupplier;

class TransaksiMasuk extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Transaksi',
            'subjudul' => 'Transaksi Masuk',
            'menu' => 'transaksi',
            'submenu' => 'Masuk',
            'page' => 'transaksi_masuk/v_masuk',
        ];
        return view('v_template', $data);
    }

    function dataTemp()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');
            $modelTemp = new ModelTempMasuk();
            $data = [
                'datatemp' => $modelTemp->tampilDataTemp($faktur)
            ];

            $json = [
                'data' => view('transaksi_masuk/datatemp', $data)
            ];
            echo json_encode($json);
        } else {
            exit('Tidak bisa dipanggil');
        }
    }

    function ambilDataBarang()
    {
        if ($this->request->isAJAX()) {
            $id_part = $this->request->getPost('id_part');

            $modelPart = new ModelPart();
            $ambilData = $modelPart->find($id_part);

            if (empty($ambilData)) {
                $json = [
                    'error' => 'Data barang tidak ditemukan'
                ];
            } else {
                $data = [
                    'nama_part' => $ambilData['nama_part'],
                    'harga_jual' => $ambilData['harga_jual']
                ];

                $json = [
                    'sukses' => $data
                ];
            }

            echo json_encode($json);
        } else {
            exit('Tidak bisa dipanggil');
        }
    }

    public function ambilDataSupplier()
    {
        if ($this->request->isAJAX()) {
            $id_supplier = $this->request->getPost('id_supplier');

            $modelSupplier = new ModelSupplier();
            $ambilData = $modelSupplier->find($id_supplier);

            if (empty($ambilData)) {
                $json = [
                    'error' => 'Data supplier tidak ditemukan'
                ];
            } else {
                $data = [
                    'nama_supplier' => $ambilData['nama_supplier']
                ];

                $json = [
                    'sukses' => $data
                ];
            }

            echo json_encode($json);
        } else {
            exit('Tidak bisa dipanggil');
        }
    }
}
