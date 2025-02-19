<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TransaksiKeluar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'faktur' => [
                'type'        => 'char',
                'constraint' => '20',
                'null'        => false
            ],
            'tgl_jual' => [
                'type'        => 'date',
                'null'        => false
            ],
            'nopol_jual' => [
                'type' => 'varchar',
                'constraint' => '8',
            ],
            // 'besar_dikson' => [
            //     'type' => 'double',
            //     'constraint' => '11,2',
            //     'default' => 0.00
            // ],
            'uang_diskon' => [
                'type' => 'double',
                'constraint' => '11,2',
                'default' => 0.00
            ],
            'subtotal' => [
                'type' => 'double',
                'constraint' => '11,2',
                'default' => 0.00
            ],
            'total' => [
                'type' => 'double',
                'constraint' => '11,2',
                'default' => 0.00
            ]
        ]);

        $this->forge->addPrimaryKey('faktur');
        $this->forge->addForeignKey('nopol_jual', 'pelanggan', 'nopol', 'cascade');
        $this->forge->createTable('transaksi_keluar');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi_keluar');
    }
}
