<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $subjudul ?></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-data">
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
                        <th>Part</th>
                        <th width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($part as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nama_part'] ?></td>
                            <td>
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit-data<?= $value['id_part'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-data<?= $value['id_part'] ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="add-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data<?= $subjudul ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php echo form_open('Part/InsertData') ?>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">Nama Part</label>
                            <input name="nama_part" class="form-control" placeholder="Part" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat">Save</button>
                    </div>
                    <?php echo form_close() ?>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- update part -->
        <?php foreach ($part as $key => $value) { ?>
            <div class="modal fade" id="edit-data<?= $value['id_part'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Data<?= $subjudul ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php echo form_open('Part/UpdateData/' . $value['id_part']) ?>
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="">Nama Part</label>
                                <input name="nama_part" value="<?= $value['nama_part'] ?>" class="form-control" placeholder="Part" required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning btn-flat">Save</button>
                        </div>
                        <?php echo form_close() ?>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php } ?>
        <!-- delete part -->
        <?php foreach ($part as $key => $value) { ?>
            <div class="modal fade" id="delete-data<?= $value['id_part'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
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