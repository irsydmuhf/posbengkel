<div class="container mt-5">
    <h2>Transaction Details</h2>
    <table class="table table-striped table-sm table-bordered">
        <tr>
            <th>Faktur</th>
            <td><?= $transaksi['faktur_beli'] ?></td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td><?= $transaksi['tgl_beli'] ?></td>
        </tr>
        <tr>
            <th>Jumlah Item</th>
            <td>
                <?php
                $db = \Config\Database::connect();
                $jmlItem = $db->table('det_transaksi_masuk')->where('faktur_detbeli', $transaksi['faktur_beli'])->countAllResults();
                echo $jmlItem;
                ?>
            </td>
        </tr>
        <tr>
            <th>Total Belanja</th>
            <td><?= number_format($transaksi['total_beli'], 0, ',', '.') ?></td>
        </tr>
    </table>
    <a href="<?= base_url('TransaksiMasuk/dataMasuk') ?>" class="btn btn-secondary">Back to Transactions</a>
</div>