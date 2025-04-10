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
            'icon' => 'fas fa-cash-register',
            'judul' => 'Transaksi',
            'subjudul' => 'Masuk',
            'menu' => 'transaksi',
            'submenu' => 'Masuk',
            'page' => 'transaksi_masuk/v_masuk',
        ];
        return view('v_template', $data);
    }
    public function buatFaktur()
    {
        $tgl = date('Y-m-d');
        $modelTransaksiMasuk = new ModelTransaksiMasuk();

        $hasil = $modelTransaksiMasuk->noFaktur($tgl)->getRowArray();
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

    function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');

            $ModelTempMasuk = new ModelTempMasuk();
            $ModelTempMasuk->delete($id);

            $json = [
                'sukses' => 'Item berhasil dihapus'
            ];

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
            $data = $modelPart->tampildata_cari($caripart)->get();

            if ($data != null) {
                $json = [
                    'data' => view('transaksi_masuk/detaildatapart', [
                        'tampildata' => $data
                    ])
                ];

                echo json_encode($json);
            }
        } else {
            exit('Tidak bisa dipanggil');
        }
    }

    function tambahDataSupplier()
    {
        if ($this->request->isAJAX()) {
            $json = [
                'data' => view('transaksi_masuk/modaltambahsupplier')
            ];
            echo json_encode($json);
        } else {
            exit('Tidak bisa dipanggil');
        }
    }

    public function tambahSupplier()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'nama_supplier'   => $this->request->getPost('nama_supplier'),
                'alamat_supplier' => $this->request->getPost('alamat_supplier'),
                'telp_supplier'   => $this->request->getPost('telp_supplier')
            ];

            $modelSupplier = new ModelSupplier();

            try {
                $modelSupplier->insert($data);

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Supplier berhasil ditambahkan.'
                ]);
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Gagal menambahkan supplier: ' . $e->getMessage()
                ]);
            }
        } else {
            return redirect()->back(); // fallback kalau bukan AJAX
        }
    }


    function cariDataSupplier()
    {
        if ($this->request->isAJAX()) {
            $json = [
                'data' => view('transaksi_masuk/modalcarisupplier')
            ];
            echo json_encode($json);
        } else {
            exit('Tidak bisa dipanggil');
        }
    }
    function detailCariSupplier()
    {
        if ($this->request->isAJAX()) {
            $carisupplier = $this->request->getPost('carisupplier');
            $modelSupplier = new ModelSupplier();
            $data = $modelSupplier->tampildata_cari($carisupplier)->get();
            if ($data != null) {
                $json = [
                    'data' => view('transaksi_masuk/detaildatasupplier', [
                        'tampildata' => $data
                    ])
                ];

                echo json_encode($json);
            }
        } else {
            exit('Tidak bisa dipanggil');
        }
    }


    function simpanTemp()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');
            $id_part = $this->request->getPost('id_part');
            $id_supplier = $this->request->getPost('id_supplier');
            $nama_part = $this->request->getPost('nama_part');
            $harga_jual = $this->request->getPost('harga_jual');
            $harga_beli = $this->request->getPost('harga_beli');
            $jml_item = $this->request->getPost('jml_item');

            log_message('debug', 'Data diterima: ' . json_encode($_POST));

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
                    'id_supp_detbeli' => $id_supplier,
                    'nama_part_detbeli' => $nama_part,
                    'hargabeli_detbeli' => $harga_beli,
                    'hargajual_detbeli' => $harga_jual,
                    'jml_detbeli' => $jml_item,
                    'subtotal_detbeli' => intval($harga_beli) * intval($jml_item)
                ]);

                $json = [
                    'sukses' => 'Item berhasil ditambahkan'
                ];
                echo json_encode($json);
            }
        }
    }
    function simpanTransaksi()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');
            $tgl = $this->request->getPost('tglfaktur');
            $id_supplier = $this->request->getPost('id_supplier');

            $modelTemp = new ModelTempMasuk();
            $dataTemp = $modelTemp->getWhere(['faktur_detbeli' => $faktur]);

            if ($dataTemp->getNumRows() == 0) {
                $json = [
                    'error' => 'Maaf, data item untuk faktur ini belum ada'
                ];
            } else {
                // simpan ke transaksi masuk
                $modelTransaksiMasuk = new ModelTransaksiMasuk();
                $totalSubtotal = 0;
                foreach ($dataTemp->getResultArray() as $total) {
                    $totalSubtotal += intval($total['subtotal_detbeli']);
                }

                $modelTransaksiMasuk->insert([
                    'faktur_beli' => $faktur,
                    'tgl_beli' => $tgl,
                    'id_supp_beli' => $id_supplier,
                    'total_beli' => $totalSubtotal
                ]);
                // simpan ke detail barang masuk
                $modelDetailTransaksiMasuk = new ModelDetailTransaksiMasuk();
                $totalSubtotal = 0;
                foreach ($dataTemp->getResultArray() as $row) {
                    $modelDetailTransaksiMasuk->insert([
                        'faktur_detbeli' => $row['faktur_detbeli'],
                        'id_part_detbeli' => $row['id_part_detbeli'],
                        'nama_part_detbeli' => $row['nama_part_detbeli'],
                        'hargajual_detbeli' => $row['hargajual_detbeli'],
                        'hargabeli_detbeli' => $row['hargabeli_detbeli'],
                        'jml_detbeli' => $row['jml_detbeli'],
                        'subtotal_detbeli' => $row['subtotal_detbeli'],
                    ]);
                }

                // hapus data yg ada di tabel temp
                $modelTemp->emptyTable();


                $json = [
                    'sukses' => 'Transaksi Berhasil Disimpan'
                ];
            }

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    public function dataMasuk()
    {
        $modelTransaksiMasuk = new ModelTransaksiMasuk();
        $modelSupplier = new ModelSupplier();

        $tombolCariTransaksi  = $this->request->getPost('tombolCariTransaksi');

        if (isset($tombolCariTransaksi)) {
            $caritransaksi = $this->request->getPost('caritransaksi');
            session()->set('cari_transaksi', $caritransaksi);
            return redirect()->to('/transaksimasuk/dataMasuk');
        } else {
            $caritransaksi = session()->get('cari_transaksi');
        }

        $totaldata = $caritransaksi ? $modelTransaksiMasuk->tampildata_cari($caritransaksi)->countAllResults() : $modelTransaksiMasuk->countAllResults();

        $datatransaksi =  $caritransaksi ? $modelTransaksiMasuk->tampildata_cari($caritransaksi)->paginate(10) : $modelTransaksiMasuk->paginate(10);

        $data = [
            'icon' => 'fas fa-cash-register',
            'judul' => 'Transaksi',
            'subjudul' => 'Masuk',
            'menu' => 'transaksi',
            'submenu' => 'Masuk',
            'page' => 'transaksi_masuk/data_transaksi',
            'totaldata' => $totaldata,
            'transaksi' => $datatransaksi,
            'supplier' => $modelSupplier->AllData()
        ];
        return view('v_template', $data);
    }

    public function view($faktur_beli)
    {
        $model = new ModelTransaksiMasuk();

        $data['transaksi'] = $model->getTransactionByFaktur($faktur_beli);

        if (!$data['transaksi']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaction not found');
        }

        return view('transaksi_masuk/view', $data);
    }


    // public function cariDataMasuk()
    // {
    //     $keyword = $this->request->getPost('keyword');
    //     $modelTransaksiMasuk = new ModelTransaksiMasuk();
    //     $data = $modelTransaksiMasuk->AllData($keyword);
    //     return $this->response->setJSON($data);
    // }
    // $tombolCariTransaksi = $this->request->getPost('tombolCariTransaksi');

    // if(isset($tombolCariTransaksi)){
    //     $cariTransaksi = $this->request->getPost('cariTransaksi');
    //     session()->set('cari_transaksi, $cariTransaksi');
    //     redirect()->to('/transaksimasuk/dataMasuk');
    // } else {
    //     $cariTransaksi = session()->get('cari_transaksi');
    // }


    // function tampilTransaksi() {
    //     if ($this->request->isAJAX()) {
    //         $caritransaksi = $this->request->getPost('tombolCariTransaksi');
    //         $modelTransaksiMasuk = new ModelTransaksiMasuk();
    //         $data = $modelTransaksiMasuk->tampildata_cari($caritransaksi);

    //         return $this->response->setJSON([
    //             'data' => view('transaksi_masuk/detaildatatransaksi', [
    //                 'tampildata' => $data
    //             ])
    //         ]);
    //     }
    //     exit('Tidak bisa dipanggil');
    // }


}
