<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Supplier extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_supplier' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'nama_supplier' => [
                'type' => 'varchar',
                'constraint' => '50'
            ],
            'telp_supplier' => [
                'type' => 'int',
                'constraint' => '15'
            ],
            'alamat_supplier' => [
                'type' => 'varchar',
                'constraint' => '100'
            ]
        ]);
        $this->forge->addKey('id_supplier');
        $this->forge->createTable('supplier');
    }
 
    public function down()
    {
        $this->forge->dropTable('supplier');
    }
}
