<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetTransaksiKeluar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_detjual' => [
                'type'        => 'bigint',
                'constraint' => '11',
                'auto_increment' => true,
            ],
            'faktur_detjual' => [
                'type'        => 'char',
                'constraint' => '20',
            ],
            'id_part_detjual' => [
                'type'        => 'char',
                'constraint' => '50',
                'null' => true
            ],
            'nama_part_detjual' => [
                'type' => 'varchar',
                'constraint' => '100'
            ],
            'id_jasa_detjual' => [
                'type'        => 'char',
                'constraint' => '50',
                'null' => true
            ],
            'nama_jasa_detjual' => [
                'type' => 'varchar',
                'constraint' => '100'
            ],
            'hargajual_detjual' => [
                'type' => 'double',
                'constraint' => '11,2',
                'default' => 0.00
            ],
            'jml_detjual' => [
                'type' => 'double',
                'constraint' => '11,2',
                'default' => 0.00
            ],
            'potongam_detjual' => [
                'type' => 'double',
                'constraint' => '11,2',
                'default' => 0.00
            ],
            'subtotal_detjual' => [
                'type' => 'double',
                'constraint' => '11,2',
                'default' => 0.00
            ]
        ]);

        $this->forge->addPrimaryKey('id_detjual');
        $this->forge->addForeignKey('faktur_detjual', 'transaksi_keluar', 'faktur_jual', 'cascade');
        $this->forge->addForeignKey('id_part_detjual', 'part', 'id_part',  'set_null', 'cascade');
        $this->forge->addForeignKey('id_jasa_detjual', 'jasa', 'id_jasa',  'set_null', 'cascade');

        $this->forge->createTable('det_transaksi_keluar');
    }


    public function down()
    {
        $this->forge->dropTable('det_transaksi_keluar');
    }
}
