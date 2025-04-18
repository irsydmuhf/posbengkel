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
            <tr class="p-2" style="text-align: left;">
                <td><?= $no++; ?></td>
                <td><?= $row['id_part']; ?></td>
                <td><?= $row['nama_part']; ?></td>
                <td style="text-align: left;">
                    <?= number_format($row['hargajual_detbeli'], 0, ",", ".") ?>
                </td>
                <td style="text-align: left;">
                    <?= number_format($row['hargabeli_detbeli'], 0, ",", ".") ?>
                </td>
                <td style="text-align: left;">
                    <?= number_format($row['jml_detbeli'], 0, ",", ".") ?>
                </td>
                <td style="text-align: left;">
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
<script>
    function hapusItem(id) {
        Swal.fire({
            title: "Yakin Hapus Item?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "/transaksimasuk/hapus",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            dataTemp();
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Item Telah Dihapus",
                                icon: "success"
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + '\n' + thrownError);
                    }
                });
            }
        });

    }
</script>