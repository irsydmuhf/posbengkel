<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-data">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Data
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            if (session()->getFlashData('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashData('pesan');
                echo '</h5>
              </div>';
            }
            ?>
            <?= form_open('part/index') ?>
            <span class="badge badge-success">Total Data : <?= $totaldata ?></span>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Berdasarkan Kode, Nama, atau Kategori" name="caripart" autofocus="true">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit" id="tombolCariPart" name="tombolCariPart">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <?= form_close(); ?>
            <table class="table table-striped table-sm table-bordered">
                <thead>
                    <tr>
                        <th width="50px">No</th>
                        <th>Kode Part</th>
                        <th>Nama Part</th>
                        <th width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 + (($nohalaman - 1) * 10);
                    foreach ($part as $row) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['id_part'] ?></td>
                            <td><?= $row['nama_part'] ?></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#view-data<?= $row['id_part'] ?>"><i class="fas fa-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit-data<?= $row['id_part'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" class="btn btn-sm btn-danger" onclick="deletePart('<?= $row['id_part'] ?>')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br>
            <div class="float-center">
                <?= $pager->links('part', 'paging'); ?>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="d-none" id="card-refresh-content">
        The body of the card after card refresh
    </div>
</div>
<div class="modal fade" id="add-data">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Tambah Data Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('Part/InsertData') ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_part">Kode Part</label>
                            <input type="text" name="id_part" class="form-control" placeholder="Masukkan Kode" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_part">Nama Part</label>
                            <input type="text" name="nama_part" class="form-control" placeholder="Masukkan Nama" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control">
                                <option selected value="">Pilih Kategori</option>
                                <?php foreach ($datakategori as $kat) { ?>
                                    <option value="<?= $kat['id_kategori'] ?>"><?= $kat['nama_kategori'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6" id="satuan-container">
                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <select name="satuan" id="satuan" class="form-control">
                                <option selected value="">Pilih Satuan</option>
                                <?php foreach ($datasatuan as $sat) { ?>
                                    <option value="<?= $sat['id_satuan'] ?>"><?= $sat['nama_satuan'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual</label>
                            <input type="number" name="harga_jual" id="harga_jual" class="form-control" placeholder="Harga Jual" required>
                        </div>
                    </div>
                </div>
                <div class="row" id="stok-container">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stok">Jumlah Stok</label>
                            <input type="number" name="stok" class="form-control" placeholder="Jumlah Stok" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <div></div>
                <button type="submit" class="btn btn-primary btn-flat">Save</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<script>
    function deletePart(id) {
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
                    url: "/Part/DeleteData",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.redirect) {
                            window.location.href = response.redirect;
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