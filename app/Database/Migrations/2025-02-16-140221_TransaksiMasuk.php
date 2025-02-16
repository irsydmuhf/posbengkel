<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TransaksiMasuk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'faktur_beli' => [
                'type' => 'char',
                'constraint' => '20',
                'null' => false
            ],
            'tgl_beli' => [
                'type'        => 'date',
                'null'        => false
            ],
            'id_part_beli' => [
                'type' => 'char',
                'constraint' => '50',
            ],
            'id_supp_beli' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => TRUE
            ],
            'besar_diskon_beli' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'uang_diskon_beli' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'subtotal_beli' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'total_beli' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
            ]
        ]);

        $this->forge->addPrimaryKey('faktur_beli');
        $this->forge->addForeignKey('id_supp_beli', 'supplier', 'id_supplier', 'cascade');
        $this->forge->createTable('transaksi_masuk');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi_masuk');
    }
}
