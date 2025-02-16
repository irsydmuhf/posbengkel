<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TransaksiMasuk extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Transaksi',
            'subjudul' => 'Transaksi Masuk',
            'menu' => 'transaksi',
            'submenu' => 'Masuk',
            'page' => 'transaksi/v_masuk',
        ];
        return view('v_template', $data);
    }
}
