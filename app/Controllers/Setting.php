<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Setting extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Setting',
            'subjudul' => '',
            'menu' => 'setting',
            'submenu' => '',
            'page' => 'v_setting',
        ];
        return view('v_template', $data);
    }
}
