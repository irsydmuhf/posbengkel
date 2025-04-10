<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TransaksiKeluar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'faktur_jual' => [
                'type' => 'char',
                'constraint' => '20',
                'null' => false
            ],
            'tgl_jual' => [
                'type'        => 'date',
                'null'        => false
            ],
            'id_pel_jual' => [
                'type' => 'VARCHAR',
                'constraint' => 8, 
                'null' => false,
            ],
			'total_jual' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
            ]
        ]);

        $this->forge->addPrimaryKey('faktur_jual');
        $this->forge->addForeignKey('id_pel_jual', 'pelanggan', 'nopol', 'cascade');
        $this->forge->createTable('transaksi_keluar');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi_keluar');

    }
}
