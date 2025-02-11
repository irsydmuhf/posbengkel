<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Part extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_part' => [
                'type' => 'char',
                'constraint' => '11',
            ],
            'nama_part' => [
                'type' => 'varchar',
                'constraint' => '100'
            ],
            'id_kategori_part' => [
                'type' => 'int',
                'unsigned' => true
            ],
            'id_satuan_part' => [
                'type' => 'int',
                'unsigned' => true
            ],
            'harga_beli' => [
                'type' => 'double',
            ],
            'harga_jual' => [
                'type' => 'double',
            ],
            'stok' => [
                'type' => 'int',
            ]
        ]);
 
        $this->forge->addPrimaryKey('id_part');
        $this->forge->addForeignKey('id_kategori_part', 'kategori', 'id_kategori');
        $this->forge->addForeignKey('id_satuan_part', 'satuan', 'id_satuan');
 
        $this->forge->createTable('part');
    }
 
    public function down()
    {
        $this->forge->dropTable('part');
    }
}
