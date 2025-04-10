<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksiKeluar;
use App\Models\ModelPelanggan;
use App\Models\ModelPart;
use App\Models\ModelJasa;
use App\Models\ModelTempKeluar;

class TransaksiKeluar extends BaseController
{

    public function dataKeluar()
    {

        $data = [
            'icon' => 'fas fa-cash-register',
            'judul' => 'Transaksi',
            'subjudul' => 'Keluar',
            'menu' => 'transaksi',
            'submenu' => 'Keluar',
            'page' => 'transaksi_keluar/data_transaksi',
        ];
        return view('v_template', $data);
    }
    public function index()
    {
        $data = [
            'icon' => 'fas fa-cash-register',
            'judul' => 'Transaksi',
            'subjudul' => 'Keluar',
            'menu' => 'Keluar',
            'submenu' => 'Masuk',
            'page' => 'transaksi_keluar/v_keluar',
        ];
        return view('v_template', $data);
    }

    public function buatFaktur()
    {
        $tgl = date('Y-m-d');
        $modelTransaksiKeluar = new ModelTransaksiKeluar();

        $hasil = $modelTransaksiKeluar->noFaktur($tgl)->getRowArray();
        $data = $hasil['nofaktur'];

        if (!$hasil['nofaktur']) {
            $fakturJual = 'J' . date('dmy', strtotime($tgl)) . '0001';
        } else {
            $lastNoUrut = substr($data, -4);
            $nextNoUrut = intval($lastNoUrut) + 1;
            $fakturJual = 'J' . date('dmy', strtotime($tgl)) . sprintf('%04d', $nextNoUrut);
        }

        $msg = ['fakturjual' => $fakturJual];
        echo json_encode($msg);
    }
    function dataTemp()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');
            $modelTemp = new ModelTempKeluar();
            $data = [
                'datatemp' => $modelTemp->tampilDataTemp($faktur)
            ];

            $json = [
                'data' => view('transaksi_keluar/datatemp', $data)
            ];
            echo json_encode($json);
        } else {
            exit('Tidak bisa dipanggil');
        }
    }
    function cariDataPelanggan()
    {
        if ($this->request->isAJAX()) {
            $json = [
                'data' => view('transaksi_keluar/modalcaripelanggan')
            ];
            echo json_encode($json);
        } else {
            exit('Tidak bisa dipanggil');
        }
    }

    function detailCariPelanggan()
    {
        if ($this->request->isAJAX()) {
            $caripelanggan = $this->request->getPost('caripelanggan');
            $modelPelanggan = new ModelPelanggan();
            $data = $modelPelanggan->tampildata_cari($caripelanggan)->get();
            if ($data != null) {
                $json = [
                    'data' => view('transaksi_keluar/detaildatapelanggan', [
                        'tampildata' => $data
                    ])
                ];

                echo json_encode($json);
            }
        } else {
            exit('Tidak bisa dipanggil');
        }
    }
    function ambilDataPelanggan()
    {
        if ($this->request->isAJAX()) {
            $nopol = $this->request->getPost('nopol');

            $modelPelanggan = new ModelPelanggan();
            $ambilData = $modelPelanggan->find($nopol);

            if (empty($ambilData)) {
                $json = [
                    'error' => 'Data pelanggan tidak ditemukan'
                ];
            } else {
                $data = [
                    'nama_pelanggan' => $ambilData['nama_pelanggan']
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
    function cariDataItem()
    {
        if ($this->request->isAJAX()) {
            $json = [
                'data' => view('transaksi_keluar/modalcariitem')
            ];
            echo json_encode($json);
        } else {
            exit('Tidak bisa dipanggil');
        }
    }

    function detailCariItem()
    {
        if ($this->request->isAJAX()) {
            $tipe = $this->request->getPost('tipe');
            $cariitem = $this->request->getPost('cariitem');

            if ($tipe == 'part') {
                $model = new ModelPart();
                $data = $model->tampildata_cari($cariitem)->get();
                $view = 'transaksi_keluar/detaildatapart';
            } elseif ($tipe == 'jasa') {
                $model = new ModelJasa();
                $data = $model->tampildata_cari($cariitem)->get();
                $view = 'transaksi_keluar/detaildatajasa';
            } else {
                $data = null;
                $view = null;
            }

            if ($data != null && $view != null) {
                $json = [
                    'data' => view($view, [
                        'tampildata' => $data
                    ])
                ];
                echo json_encode($json);
            }
        } else {
            exit('Tidak bisa dipanggil');
        }
    }



    function ambilDataJasa()
    {
        if ($this->request->isAJAX()) {
            $id_jasa = $this->request->getPost('id_jasa');

            $modelJasa = new ModelJasa();
            $ambilData = $modelJasa->find($id_jasa);

            if (empty($ambilData)) {
                $json = [
                    'error' => 'Data jasa tidak ditemukan'
                ];
            } else {
                $data = [
                    'nama_jasa' => $ambilData['nama_jasa']
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

    public function ambilDataItem()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id_item');
            $modelPart = new ModelPart();
            $modelJasa = new ModelJasa();

            $part = $modelPart->find($id);
            if ($part) {
                $json = [
                    'sukses' => [
                        'nama' => $part['nama_part'],
                        'harga' => $part['harga_jual']
                    ]
                ];
            } else {
                $jasa = $modelJasa->find($id);
                if ($jasa) {
                    $json = [
                        'sukses' => [
                            'nama' => $jasa['nama_jasa'],
                            'harga' => $jasa['harga_jasa']
                        ]
                    ];
                } else {
                    $json = ['error' => 'Item tidak ditemukan'];
                }
            }
            echo json_encode($json);
        }
    }

    function simpanTemp()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');
            $id_part = $this->request->getPost('id_part');
            $nopol = $this->request->getPost('nopol');
            $nama_part = $this->request->getPost('nama_part');
            $harga_jual = intval($this->request->getPost('harga_jual'));
            $diskon = floatval($this->request->getPost('diskon'));
            $jml_item = intval($this->request->getPost('jml_item'));

            $modelTemp = new ModelTempKeluar();

            $isExist = $modelTemp->where('faktur_detbeli', $faktur)
                ->where('id_part_detbeli', $id_part)
                ->countAllResults();

            if ($isExist > 0) {
                $json = [
                    'error' => 'Barang sudah ada dalam keranjang'
                ];
            } else {
                $potongan = ($harga_jual * $diskon) / 100;
                $harga_akhir = $harga_jual - $potongan;
                $subtotal = $harga_akhir * $jml_item;

                $modelTemp->insert([
                    'faktur_detjual'    => $faktur,
                    'id_part_detjual'   => $id_part,
                    'nopol_detjual'     => $nopol,
                    'nama_part_detjual' => $nama_part,
                    'hargajual_detjual' => $harga_jual,
                    'diskon_detjual'    => $diskon,
                    'potongan_detjual'  => $potongan,
                    'jml_detjual'       => $jml_item,
                    'subtotal_detjual'  => $subtotal
                ]);

                $json = [
                    'sukses' => 'Item berhasil ditambahkan'
                ];
            }

            echo json_encode($json);
        }
    }
}
