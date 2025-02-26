<table class="table table-sm table-striped table-hover">
    <thead>
        <th colspan="6"></th>
        <th colspan="2">
            <?php
            $totalHarga = 0;
            foreach ($datatemp->getResultArray() as $row) {
                $totalHarga += $row['subtotal_detbeli'];
            } ?>
            <h1><?= number_format($totalHarga, 0, ",", "."); ?></h1>
        </th>
    </thead>
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
            <tr class="p-2 text-center">
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
                    <button type="button" class="btn btn-s btn-outline-danger" data-toggle="modal" data-target="#delete-data">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<div class="modal fade" id="delete-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Delete Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda Yakin Menghapus Part</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <a href="#" class="btn btn-danger btn-flat">Delete</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
</script>