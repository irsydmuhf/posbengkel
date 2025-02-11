<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pelanggan extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'MasterData',
            'subjudul' => 'Pelanggan',
            'menu' => 'masterdata',
            'submenu' => 'pelanggan',
            'page' => 'v_pelanggan',
        ];
        return view('v_template', $data);
    }
}
