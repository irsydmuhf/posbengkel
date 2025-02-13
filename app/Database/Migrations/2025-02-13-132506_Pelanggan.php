<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nopol' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'nama_pelanggan' => [
                'type' => 'varchar',
                'constraint' => '50'
            ],
            'mobil_pelanggan' => [
                'type' => 'varchar',
                'constraint' => '50'
            ],
            'telp_pelanggan' => [
                'type' => 'int',
                'constraint' => '15'
            ],
            'alamat_pelanggan' => [
                'type' => 'varchar',
                'constraint' => '100'
            ]
        ]);
        $this->forge->addKey('nopol');
        $this->forge->createTable('pelanggan');
    }
 
    public function down()
    {
        $this->forge->dropTable('pelanggan');
    }
}
