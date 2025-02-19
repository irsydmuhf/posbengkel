<table class="table table-sm table-striped table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga Jual</th>
            <th>Harga Beli</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($datatemp->getResultArray() as $row) {
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['id_part']; ?></td>
                <td><?= $row['nama_part']; ?></td>
                <td style="text-align: right;">
                    <?= number_format($row['hargajual_detbeli'], 0, ",", ".") ?>
                </td>
                <td style="text-align: right;">
                    <?= number_format($row['hargabeli_detbeli'], 0, ",", ".") ?>
                </td>
                <td style="text-align: right;">
                    <?= number_format($row['jml_detbeli'], 0, ",", ".") ?>
                </td>
                <td style="text-align: right;">
                    <?= number_format($row['subtotal_detbeli'], 0, ",", ".") ?>
                </td>
                <td>
                    <button type="button" class="btn btn-s btn-outline-danger" onclick="hapusItem('<?= $row['id_detbeli'] ?>')">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>