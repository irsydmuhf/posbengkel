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

    public function noFaktur($tgl)
    {
        return $this->table('transaksi_masuk ')->SELECT('MAX(faktur_beli) AS nofaktur')->WHERE('tgl_beli', $tgl)->get();
    }

    public function tampildata_cari($caritransaksi)
    {
        return $this->db->table('transaksi_masuk')
            ->join('det_transaksi_masuk', 'faktur_detbeli = faktur')
            ->groupStart()
            ->like('faktur', $caritransaksi)
            ->orlike('kode_supplier', $caritransaksi)
            ->orLike('nama_part', $caritransaksi)
            ->orLike('tgl_beli', $caritransaksi)
            ->groupEnd()
            ->get()
            ->getResultArray();
    }

    public function getTransaksiMasuk($keyword = null)
    {
        $builder = $this->db->table('transaksi_masuk tm');
        $builder->select('tm.faktur_beli, tm.tgl_beli, tm.id_supp_beli, tm.total_beli, COUNT(dtm.id_detbeli) as jumlah_item');
        $builder->join('det_transaksi_masuk dtm', 'tm.faktur_beli = dtm.faktur_detbeli', 'left');

        if (!empty($keyword)) {
            $builder->groupStart();
            $builder->like('tm.faktur_beli', $keyword);
            $builder->orLike('tm.id_supp_beli', $keyword);
            $builder->groupEnd();
        }

        $builder->groupBy('tm.faktur_beli');
        return $builder->get()->getResultArray();
    }
}
