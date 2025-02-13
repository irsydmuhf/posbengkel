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
                        <th width="2%">No</th>
                        <th>Kode Jasa</th>
                        <th>Nama Jasa</th>
                        <th>Harga Jasa</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($jasa as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['id_jasa'] ?></td>
                            <td><?= $value['nama_jasa'] ?></td>
                            <td><?= $value['harga_jasa'] ?></td>
                            <td>
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit-data<?= $value['id_jasa'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-data<?= $value['id_jasa'] ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- tambah data jasa -->
        <div class="modal fade" id="add-data">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Tambah Data<?= $subjudul ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php echo form_open('Jasa/InsertData') ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Kode Jasa</label>
                            <input name="id_jasa" class="form-control" placeholder="Masukkan Kode Jasa" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Jasa</label>
                            <input name="nama_jasa" class="form-control" placeholder="Masukkan Nama Jasa" required>
                        </div>
                        <div class="form-group">
                            <label for="">Harga Jasa</label>
                            <input type="number" name="harga_jasa" class="form-control" placeholder="Harga Jasa" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <div></div>
                        <button type="submit" class="btn btn-primary btn-flat">Save</button>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <?php foreach ($jasa as $key => $value) { ?>
            <div class="modal fade" id="edit-data<?= $value['id_jasa'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Data<?= $subjudul ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php echo form_open('Jasa/UpdateData/' . $value['id_jasa']) ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Kode Jasa</label>
                                <input name="id_jasa" value="<?= $value['id_jasa'] ?>" class="form-control" placeholder="Jasa" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Jasa</label>
                                <input name="nama_jasa" value="<?= $value['nama_jasa'] ?>" class="form-control" placeholder="Jasa" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Jasa</label>
                                <input name="harga_jasa" value="<?= $value['harga_jasa'] ?>" class="form-control" placeholder="Jasa" required>
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
        <!-- delete jasa -->
        <?php foreach ($jasa as $key => $value) { ?>
            <div class="modal fade" id="delete-data<?= $value['id_jasa'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h4 class="modal-title">Delete Data<?= $subjudul ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda Yakin Menghapus Jasa</p>
                            <p> <?= $value['nama_jasa'] ?></p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                            <a href="<?= base_url('Jasa/DeleteData/' . $value['id_jasa']) ?>" class="btn btn-danger btn-flat">Delete</a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php } ?>
    </div>
    <!-- /.card -->
    <div class="d-none" id="card-refresh-content">
        The body of the card after card refresh
    </div>
</div>