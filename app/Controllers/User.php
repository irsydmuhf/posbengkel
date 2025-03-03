<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function index()
    {
        $data = [
            'icon' => 'fas fa-user',
            'judul' => 'Master Data',
            'subjudul' => ' User',
            'menu' => 'masterdata',
            'submenu' => 'user',
            'page' => 'v_user',
        ];
        return view('v_template', $data);
    }
}
