<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTempMasuk;
use App\Models\ModelPart;
use App\Models\ModelSupplier;
use App\Models\ModelTransaksiMasuk;
use App\Models\ModelDetailTransaksiMasuk;
use CodeIgniter\CLI\Console;
use CodeIgniter\Database\Query;

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

    function cariDataPart()
    {
        if ($this->request->isAJAX()) {
            $json = [
                'data' => view('transaksi_masuk/modalcaripart')
            ];
            echo json_encode($json);
        } else {
            exit('Tidak bisa dipanggil');
        }
    }
    function detailCariPart()
    {
        if ($this->request->isAJAX()) {
            $caripart = $this->request->getPost('caripart');
            $modelPart = new ModelPart();
            $data = $modelPart->tampildata_cari($caripart);

            return $this->response->setJSON([
                'data' => view('transaksi_masuk/detaildatapart', [
                    'tampildata' => $data
                ])
            ]);
        }

        exit('Tidak bisa dipanggil');
    }

    public function buatFaktur()
    {
        $tgl = date('Y-m-d');
        $modelTransaksiKeluar = new ModelTransaksiMasuk();

        $hasil = $modelTransaksiKeluar->noFaktur($tgl)->getRowArray();
        $data = $hasil['nofaktur'];

        if (!$hasil['nofaktur']) {
            $fakturBeli = 'B' . date('dmy', strtotime($tgl)) . '0001';
        } else {
            $lastNoUrut = substr($data, -4);
            $nextNoUrut = intval($lastNoUrut) + 1;
            $fakturBeli = 'B' . date('dmy', strtotime($tgl)) . sprintf('%04d', $nextNoUrut);
        }

        $msg = ['fakturbeli' => $fakturBeli];
        echo json_encode($msg);
    }
    function simpanTemp()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');
            $id_part = $this->request->getPost('id_part');
            $nama_part = $this->request->getPost('nama_part');
            $harga_jual = $this->request->getPost('harga_jual');
            $harga_beli = $this->request->getPost('harga_beli');
            $jml_item = $this->request->getPost('jml_item');

            $modelTemp = new ModelTempMasuk();
            $isExist = $modelTemp->where('faktur_detbeli', $faktur)
                ->where('id_part_detbeli', $id_part)
                ->countAllResults();

            if ($isExist > 0) {
                $json = [
                    'error' => 'Barang sudah ada dalam keranjang'
                ];
            } else {
                $modelTemp->insert([
                    'faktur_detbeli' => $faktur,
                    'id_part_detbeli' => $id_part,
                    'nama_part_detbeli' => $nama_part,
                    'hargabeli_detbeli' => $harga_beli,
                    'hargajual_detbeli' => $harga_jual,
                    'jumlah_detbeli' => $jml_item,
                    'subtotal_detbeli' => intval($harga_beli) * intval($jml_item)
                ]);

                $json = [
                    'sukses' => 'Item berhasil ditambahkan'
                ];
                echo json_encode($json);
            }
        }

        // public function simpanTemp()
        // {
        //     if ($this->request->isAJAX()) {
        //         try {
        //             $faktur = $this->request->getPost('faktur');
        //             $id_part = $this->request->getPost('id_part');
        //             $nama_part = $this->request->getPost('nama_part');
        //             $harga_jual = $this->request->getPost('harga_jual');
        //             $harga_beli = $this->request->getPost('harga_beli');
        //             $jml_item = $this->request->getPost('jml_item');

        //             $modelTemp = new ModelTempMasuk();

        //             if ($modelTemp->cekItem($id_part, $faktur) > 0) {
        //                 return $this->response->setJSON([
        //                     'error' => 'Item sudah ada dalam transaksi'
        //                 ]);
        //             }

        //             $modelTemp->insert([
        //                 'faktur_detbeli' => $faktur,
        //                 'id_part_detbeli' => $id_part,
        //                 'nama_part_detbeli' => $id_part,
        //                 'hargabeli_detbeli' => $harga_beli,
        //                 'hargajual_detbeli' => $harga_jual,
        //                 'jumlah_detbeli' => $jml_item,
        //                 'subtotal_detbeli' => $harga_beli * $jml_item
        //             ]);

        //             return $this->response->setJSON([
        //                 'sukses' => 'Item berhasil ditambahkan'
        //             ]);
        //         } catch (\Exception $e) {
        //             return $this->response->setJSON([
        //                 'error' => 'Terjadi kesalahan: ' . $e->getMessage()
        //             ]);
        //         }
        //     } else {
        //         return $this->response->setJSON([
        //             'error' => 'Request harus menggunakan AJAX'
        //         ]);
        //     }
        // }


        // function simpanTransaksi()
        // {
        //     if ($this->request->isAJAX()) {
        //         $faktur_beli = $this->request->getPost('faktur');
        //         $tglfaktur = $this->request->getPost('tglfaktur');

        //         $modelTemp = new ModelTempMasuk();
        //         $dataTemp = $modelTemp->getWhere(['faktur_detbeli' => $faktur_beli]);

        //         if ($dataTemp->getNumRows() == 0) {
        //             $json = [
        //                 'error' => 'Maaf, data item untuk faktur ini belum ada'
        //             ];
        //         } else {
        //             // simpan ke transaksi masuk
        //             $modelTransaksiMasuk = new ModelTransaksiMasuk();
        //             $totalSubtotal = 0;
        //             foreach ($dataTemp->getResultArray() as $total) {
        //                 $totalSubtotal += intval($total['subtotal_detbeli']);
        //             }

        //             $modelTransaksiMasuk->insert([
        //                 'faktur_beli' => $faktur,
        //                 'tgl_beli' => $tgl_faktur,
        //                 'id_supp_beli' => $id_supplier,
        //                 'total_beli' => $totalSubtotal
        //             ]);

        //             $json = [
        //                 'sukses' => 'Transaksi Berhasil Disimpan'
        //             ];
        //         }

        //         echo json_encode($json);
        //     } else {
        //         exit('Maaf tidak bisa dipanggil');
        //     }
        // }
    }
}
