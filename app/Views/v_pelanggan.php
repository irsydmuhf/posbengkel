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
                        <th width="50px">No</th>
                        <th>Nopol</th>
                        <th>Nama Pelanggan</th>
                        <th width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pelanggan as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nopol'] ?></td>
                            <td><?= $value['nama_pelanggan'] ?></td>
                            <td>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#view-data<?= $value['nopol'] ?>"><i class="fas fa-eye"></i></a>
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit-data<?= $value['nopol'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-data<?= $value['nopol'] ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- view data -->
        <?php foreach ($pelanggan as $key => $value) { ?>
            <div class="modal fade" id="view-data<?= $value['nopol'] ?>">
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
                                    <th style="width: 30%;">Nopol Pelanggan</th>
                                    <td><?= $value['nopol'] ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Pelanggan</th>
                                    <td><?= $value['nama_pelanggan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat Pelanggan</th>
                                    <td><?= $value['alamat_pelanggan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat Pelanggan</th>
                                    <td><?= $value['alamat_pelanggan'] ?></td>
                                </tr>
                                <tr>
                                    <th>No Telp</th>
                                    <td><?= $value['telp_pelanggan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Mobil Pelanggan</th>
                                    <td><?= $value['mobil_pelanggan']?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php } ?>
        <!-- tambah data -->
        <div class="modal fade" id="add-data">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Tambah Data<?= $subjudul ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php echo form_open('Pelanggan/InsertData') ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nopol Pelanggan</label>
                            <input name="nopol" class="form-control" placeholder="Masukkan Nopol Pelanggan" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pelanggan</label>
                            <input name="nama_pelanggan" class="form-control" placeholder="Masukkan Nama Pelanggan" required>
                        </div>
                        <div class="form-group">
                            <label for="">Mobil Pelanggan</label>
                            <input name="mobil_pelanggan" class="form-control" placeholder="Masukkan Nama Pelanggan" required>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat Pelanggan</label>
                            <input name="alamat_pelanggan" class="form-control" placeholder="Masukkan Alamat Pelanggan" required>
                        </div>
                        <div class="form-group">
                            <label for="">Telp. Pelanggan</label>
                            <input type="number" name="telp_pelanggan" class="form-control" placeholder="Gunakan Awalan 62" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <div></div> <button type="submit" class="btn btn-primary btn-flat">Save</button>
                    </div>
                    <?php echo form_close() ?>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- update pelanggan -->
        <?php foreach ($pelanggan as $key => $value) { ?>
            <div class="modal fade" id="edit-data<?= $value['nopol'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h4 class="modal-title">Edit Data<?= $subjudul ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php echo form_open('Pelanggan/UpdateData/' . $value['nopol']) ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Nama Pelanggan</label>
                                <input name="nama_pelanggan" value="<?= $value['nama_pelanggan'] ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Pelanggan</label>
                                <input name="alamat_pelanggan" value="<?= $value['alamat_pelanggan'] ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Mobil Pelanggan</label>
                                <input name="mobil_pelanggan" value="<?= $value['mobil_pelanggan'] ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">No Telp Pelanggan</label>
                                <input type="number" name="telp_pelanggan" value="<?= $value['telp_pelanggan'] ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <div></div> <button type="submit" class="btn btn-warning btn-flat">Save</button>
                        </div>
                        <?php echo form_close() ?>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php } ?>
        <!-- delete pelanggan -->
        <?php foreach ($pelanggan as $key => $value) { ?>
            <div class="modal fade" id="delete-data<?= $value['nopol'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Data<?= $subjudul ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda Yakin Menghapus Pelanggan</p>
                            <p> <?= $value['nama_pelanggan'] ?></p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                            <a href="<?= base_url('Pelanggan/DeleteData/' . $value['nopol']) ?>" class="btn btn-danger btn-flat">Delete</a>
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