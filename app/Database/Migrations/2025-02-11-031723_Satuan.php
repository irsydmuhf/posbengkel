<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Satuan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_satuan' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'nama_satuan' => [
                'type' => 'varchar',
                'constraint' => '50'
            ]
        ]);
        $this->forge->addKey('id_satuan');
        $this->forge->createTable('satuan');
    }
 
    public function down()
    {
        $this->forge->dropTable('satuan');
    }
}
