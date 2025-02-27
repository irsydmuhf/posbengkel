<table class="table table-sm">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Part</th>
            <th>Nama Part</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($tampildata)) {
            $no = 1;
            foreach ($tampildata as $row) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['id_part'] ?></td>
                    <td><?= $row['nama_part'] ?></td>
                    <td><?= number_format($row['harga_jual'], 0, ',', '.') ?></td>
                    <td><?= number_format($row['stok'], 0, ',', '.') ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary" onclick="pilih('<?= $row['id_part'] ?>')">
                            <i class="fa fa-check"></i> Pilih
                        </button>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td colspan="6" class="text-center">
                    <div class="alert alert-warning">Data tidak ditemukan</div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    function pilih(kode) {
        $('#id_part').val(kode);
        $('#modalcaripart').on('hidden.bs.modal', function(event){
            ambilDataPart();
        });
        $('#modalcaripart').modal('hide');
    }
</script>