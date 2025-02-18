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
                        <th width="120px">Kode Supp</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No Telp.</th>
                        <th width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($supplier as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['id_supplier'] ?></td>
                            <td><?= $value['nama_supplier'] ?></td>
                            <td><?= $value['alamat_supplier'] ?></td>
                            <td><?= $value['telp_supplier'] ?></td>
                            <td>
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit-data<?= $value['id_supplier'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-data<?= $value['id_supplier'] ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
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
                    <?php echo form_open('Supplier/InsertData') ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Supplier</label>
                            <input name="nama_supplier" class="form-control" placeholder="Masukkan Nama Supplier" required>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat Supplier</label>
                            <input name="alamat_supplier" class="form-control" placeholder="Masukkan Alamat Supplier" required>
                        </div>
                        <div class="form-group">
                            <label for="">Telp. Supplier</label>
                            <input type="number" name="telp_supplier" class="form-control" placeholder="Gunakan Awalan 62" required>
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
        <!-- update supplier -->
        <?php foreach ($supplier as $key => $value) { ?>
            <div class="modal fade" id="edit-data<?= $value['id_supplier'] ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h4 class="modal-title">Edit Data <?= $subjudul ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php echo form_open('Supplier/UpdateData/' . $value['id_supplier']) ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Nama Supplier</label>
                                <input name="nama_supplier" value="<?= $value['nama_supplier'] ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Supplier</label>
                                <input name="alamat_supplier" value="<?= $value['alamat_supplier'] ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">No Telp Supplier</label>
                                <input type="number" name="telp_supplier" value="<?= $value['telp_supplier'] ?>" class="form-control" required>
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
        <!-- delete supplier -->
        <?php foreach ($supplier as $key => $value) { ?>
            <div class="modal fade" id="delete-data<?= $value['id_supplier'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Data<?= $subjudul ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda Yakin Menghapus Supplier</p>
                            <p> <?= $value['nama_supplier'] ?></p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                            <a href="<?= base_url('Supplier/DeleteData/' . $value['id_supplier']) ?>" class="btn btn-danger btn-flat">Delete</a>
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