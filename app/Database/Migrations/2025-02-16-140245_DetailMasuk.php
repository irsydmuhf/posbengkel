<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailMasuk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_detbeli' => [
                'type'        => 'bigint',
                'constraint' => '11',
                'auto_increment' => true,
            ],
            'faktur_detbeli' => [
                'type'        => 'char',
                'constraint' => '20',
            ],
            'id_part_detbeli' => [
                'type'        => 'char',
                'constraint' => '50',
                'null' => true
<<<<<<< HEAD
=======
            ],
            'nama_part' => [
                'type' => 'varchar',
                'constraint' => '100'
>>>>>>> 5fba8374d417af574a3a4c127161e8378830b650
            ],
            'nama_part_detbeli' => [
                'type' => 'varchar',
                'constraint' => '100'

            ],

            'hargabeli_detbeli' => [
                'type' => 'double',
                'constraint' => '11,2',
                'default' => 0.00
            ],
            'hargajual_detbeli' => [
                'type' => 'double',
                'constraint' => '11,2',
                'default' => 0.00
            ],
            'jml_detbeli' => [
                'type' => 'double',
                'constraint' => '11,2',
                'default' => 0.00
            ],
            'subtotal_detbeli' => [
                'type' => 'double',
                'constraint' => '11,2',
                'default' => 0.00
            ]
        ]);

        $this->forge->addPrimaryKey('id_detbeli');
        $this->forge->addForeignKey('faktur_detbeli', 'transaksi_masuk', 'faktur_beli', 'cascade');
<<<<<<< HEAD
        $this->forge->addForeignKey('id_part_detbeli', 'part', 'id_part',  'set_null', 'cascade');
=======
        $this->forge->addForeignKey('id_part_detbeli', 'part', 'id_part', 'SET NULL', 'cascade');
>>>>>>> 5fba8374d417af574a3a4c127161e8378830b650
        $this->forge->createTable('det_transaksi_masuk');
    }

    public function down()
    {
        $this->forge->dropTable('det_transaksi_masuk');
    }
}
