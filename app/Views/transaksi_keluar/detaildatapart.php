<table class="table table-striped table-sm">
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
        <?php
        $no = 1;
        if ($tampildata->getResultArray()) {
            foreach ($tampildata->getResultArray() as $row) {
        ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['id_part'] ?></td>
                    <td><?= $row['nama_part'] ?></td>
                    <td><?= number_format($row['harga_jual'], 0, ",", ".") ?></td>
                    <td><?= number_format($row['stok'], 0, ",", ".") ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-info" onclick="pilih('<?= $row['id_part'] ?>')">
                        Pilih
                        </button>
                    </td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="6" class=" text-center">
                    <div class="alert alert-warning" role="alert">
                        Data tidak ditemukan
                    </div>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<script>
    function pilih(kode) {
        $('#id_part').val(kode);
        $('#modalcariitem').on('hidden.bs.modal', function(event) {
            ambilDataPart();
        });
        $('#modalcariitem').modal('hide');
    }
</script>