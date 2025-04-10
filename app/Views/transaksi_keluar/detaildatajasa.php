<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Jasa</th>
            <th>Nama Jasa</th>
            <th>Harga Jual</th>
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
                    <td><?= $row['id_jasa'] ?></td>
                    <td><?= $row['nama_jasa'] ?></td>
                    <td><?= number_format($row['harga_jasa'], 0, ",", ".") ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-info" onclick="pilih('<?= $row['id_jasa'] ?>')">
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
        $('#id_jasa').val(kode);
        $('#modalcarijasa').on('hidden.bs.modal', function(event) {
            ambilDataJasa();
        });
        $('#modalcarijasa').modal('hide');
    }
</script>