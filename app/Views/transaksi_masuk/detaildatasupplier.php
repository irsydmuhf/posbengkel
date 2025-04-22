<table class="table table-sm">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Supplier</th>
            <th>Nama Supplier</th>
            <th>Alamat</th>
            <th>Telp</th>
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
                    <td><?= $row['id_supplier'] ?></td>
                    <td><?= $row['nama_supplier'] ?></td>
                    <td><?= $row['alamat_supplier'] ?></td>
                    <td><?= $row['telp_supplier'] ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-info" onclick="pilih('<?= $row['id_supplier'] ?>')">
                            <i class="fa fa-check"></i> Pilih
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
        $('#id_supplier').val(kode);
        $('#modalcarisupplier').on('hidden.bs.modal', function(event) {
            ambilDataSupplier();
        });
        $('#modalcarisupplier').modal('hide');
        $('#id_part').focus();
    }
</script>

