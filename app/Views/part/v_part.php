<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title mt-2"><?= $subjudul ?></h3>
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
            <!-- searhcing -->
            <!-- <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Berdasarkan Kode, Nama Part atau Kategori" name="search" autofocus>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button"><i class="fa fa-search" name="tombolsearch"></i></button>
                </div>
            </div> -->
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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="2%">No</th>
                        <th>Kode Barang</th>
                        <th>Nama</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($part as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['id_part'] ?></td>
                            <td><?= $value['nama_part'] ?></td>
                            <td>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#view-data<?= $value['id_part'] ?>"><i class="fas fa-eye"></i></a>
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit-data<?= $value['id_part'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-data<?= $value['id_part'] ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- view data -->
        <?php foreach ($part as $key => $value) { ?>
            <div class="modal fade" id="view-data<?= $value['id_part'] ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title">Detail Data <?= $subjudul ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th style="width: 30%;">Kode Part</th>
                                    <td><?= $value['id_part'] ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Part</th>
                                    <td><?= $value['nama_part'] ?></td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td><?= $value['nama_kategori'] ?></td>
                                </tr>
                                <tr>
                                    <th>Harga Beli</th>
                                    <td>Rp <?= number_format($value['harga_beli'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <th>Harga Jual</th>
                                    <td>Rp <?= number_format($value['harga_jual'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Stok</th>
                                    <td><?= $value['stok'] ?></td>
                                </tr>
                                <tr>
                                    <th>Satuan</th>
                                    <td><?= $value['nama_satuan'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php } ?>
        <!-- tambah data part -->
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
                            <!-- Kode Part -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_part">Kode Part</label>
                                    <input type="text" name="id_part" class="form-control" placeholder="Masukkan Kode" required>
                                </div>
                            </div>
                            <!-- Nama Part -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_part">Nama Part</label>
                                    <input type="text" name="nama_part" class="form-control" placeholder="Masukkan Nama" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Kategori -->
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
                            <!-- Satuan -->
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
                            <!-- Harga Beli -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="harga_beli">Harga Beli</label>
                                    <input type="number" name="harga_beli" id="harga_beli" class="form-control" placeholder="Harga Beli" required>
                                </div>
                            </div>
                            <!-- Harga Jual -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="harga_jual">Harga Jual</label>
                                    <input type="number" name="harga_jual" class="form-control" placeholder="Harga Jual" required>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="stok-container">
                            <!-- Jumlah Stok -->
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

        <!-- update part -->
        <?php foreach ($part as $key => $value) { ?>
            <div class="modal fade" id="edit-data<?= $value['id_part'] ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h4 class="modal-title">Edit Data <?= $subjudul ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php echo form_open('Part/UpdateData/' . $value['id_part']) ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_part">Kode Part</label>
                                        <input type="text" name="id_part" value="<?= $value['id_part'] ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_part">Nama Part</label>
                                        <input type="text" name="nama_part" value="<?= $value['nama_part'] ?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <select name="kategori" class="form-control">
                                            <option selected value="<?= $value['id_kategori'] ?>"><?= $value['nama_kategori'] ?></option>
                                            <?php foreach ($datakategori as $kat) {
                                                if ($kat['id_kategori'] != $value['id_kategori']) { ?>
                                                    <option value="<?= $kat['id_kategori'] ?>"><?= $kat['nama_kategori'] ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="satuan">Satuan</label>
                                        <select name="satuan" class="form-control">
                                            <option selected value="<?= $value['id_satuan'] ?>"><?= $value['nama_satuan'] ?></option>
                                            <?php foreach ($datasatuan as $sat) {
                                                if ($sat['id_satuan'] != $value['id_satuan']) { ?>
                                                    <option value="<?= $sat['id_satuan'] ?>"><?= $sat['nama_satuan'] ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="harga_beli">Harga Beli</label>
                                        <input type="number" name="harga_beli" value="<?= $value['harga_beli'] ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="harga_jual">Harga Jual</label>
                                        <input type="number" name="harga_jual" value="<?= $value['harga_jual'] ?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stok">Jumlah Stok</label>
                                        <input type="number" name="stok" value="<?= $value['stok'] ?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <div></div>
                            <button type="submit" class="btn btn-warning btn-flat">Save</button>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- delete part -->
        <?php foreach ($part as $key => $value) { ?>
            <div class="modal fade" id="delete-data<?= $value['id_part'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h4 class="modal-title">Delete Data<?= $subjudul ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda Yakin Menghapus Part</p>
                            <p> <?= $value['nama_part'] ?></p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                            <a href="<?= base_url('Part/DeleteData/' . $value['id_part']) ?>" class="btn btn-danger btn-flat">Delete</a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php } ?>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="d-none" id="card-refresh-content">
        The body of the card after card refresh
    </div>
</div>