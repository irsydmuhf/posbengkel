<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksiKeluar;
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
            'judul' => 'Master Data',
            'subjudul' => 'Transaksi',
            'menu' => 'masterdata',
            'submenu' => 'Transaksi Keluar',
            'page' => 'transaksi/v_keluar',
            'datapart' => $modelpart->AllData(),
            'datajasa' => $modeljasa->AllData(),
        ];
        return view('v_template', $data);
    }

}
