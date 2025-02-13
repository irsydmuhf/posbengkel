<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jasa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jasa' => [
                'type' => 'CHAR',
                'constraint' => '11',
                'null' => false,
            ],
            'nama_jasa' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'harga_jasa' => [
                'type' => 'DOUBLE',
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id_jasa');

        $this->forge->createTable('jasa');
    }

    public function down()
    {
        $this->forge->dropTable('jasa');
    }
}
