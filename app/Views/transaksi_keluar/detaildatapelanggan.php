<table class="table table-sm">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>Mobil Pelanggan</th>
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
                    <td><?= $row['nopol'] ?></td>
                    <td><?= $row['nama_pelanggan'] ?></td>
                    <td><?= $row['mobil_pelanggan'] ?></td>
                    <td><?= $row['alamat_pelanggan'] ?></td>
                    <td><?= $row['telp_pelanggan'] ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-info" onclick="pilih('<?= $row['nopol'] ?>')">
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
        $('#nopol').val(kode);
        $('#modalcaripelanggan').on('hidden.bs.modal', function(event) {
            ambilDataPelanggan();
        });
        $('#modalcaripelanggan').modal('hide');
    }
</script>