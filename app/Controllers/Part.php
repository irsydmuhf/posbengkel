<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Part extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'MasterData',
            'subjudul' => 'Part',
            'menu' => 'masterdata',
            'submenu' => 'part',
            'page' => 'v_part',
        ];
        return view('v_template', $data);
        //
    }
}
