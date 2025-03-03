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
                'null' => true,

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
        $this->forge->addForeignKey('id_part_detbeli', 'part', 'id_part',  'set_null', 'cascade');

        $this->forge->createTable('det_transaksi_masuk');
    }

    public function down()
    {
        $this->forge->dropTable('det_transaksi_masuk');
    }
}
