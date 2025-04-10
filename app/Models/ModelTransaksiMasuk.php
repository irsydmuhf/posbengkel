<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksiMasuk extends Model
{
    protected $table            = 'transaksi_masuk';
    protected $primaryKey       = 'faktur_beli';
    protected $allowedFields    = [
        'faktur_beli',
        'tgl_beli',
        'id_supp_beli',
        'total_beli'
    ];

    public function AllData()
    {
        $this->db
            ->table('transaksi_masuk')
            ->join('det_transaksi_masuk', 'transaksi_masuk.faktur_beli = det_transaksi_masuk.faktur_detbeli')
            ->join('supplier', 'transaksi_masuk.id_supp_beli = supplier.id_supplier');

    }

    public function noFaktur($tgl)
    {
        return $this->table('transaksi_masuk ')->SELECT('MAX(faktur_beli) AS nofaktur')->WHERE('tgl_beli', $tgl)->get();
    }

    public function tampildata_cari($caritransaksi)
    {
        return $this->table('transaksi_masuk')
        ->join('det_transaksi_masuk', 'transaksi_masuk.faktur_beli = det_transaksi_masuk.faktur_detbeli')
        ->join('supplier', 'transaksi_masuk.id_supp_beli = supplier.id_supplier')
        ->like('faktur', $caritransaksi)
        ->orLike('tgl_beli', $caritransaksi);
    }

    public function getTransactionByFaktur($faktur_beli)
{
    return $this->where('faktur_beli', $faktur_beli)->first();
}

    // public function getTransaksiMasuk($keyword = null)
    // {
    //     $builder = $this->db->table('transaksi_masuk tm');
    //     $builder->select('tm.faktur_beli, tm.tgl_beli, tm.id_supp_beli, tm.total_beli, COUNT(dtm.id_detbeli) as jumlah_item');
    //     $builder->join('det_transaksi_masuk dtm', 'tm.faktur_beli = dtm.faktur_detbeli', 'left');

    //     if (!empty($keyword)) {
    //         $builder->groupStart();
    //         $builder->like('tm.faktur_beli', $keyword);
    //         $builder->orLike('tm.id_supp_beli', $keyword);
    //         $builder->groupEnd();
    //     }

    //     $builder->groupBy('tm.faktur_beli');
    //     return $builder->get()->getResultArray();
    // }
}
