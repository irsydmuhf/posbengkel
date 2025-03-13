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
            <?= form_open('kategori/index') ?>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Berdasarkan Nama Kategori" name="carikategori" autofocus="true">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit" id="tombolCariKategori" name="tombolCariKategori">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <?= form_close(); ?>
            <table class="table table-striped table-sm table-bordered">
                <thead>
                    <tr>
                        <th width="50px">No</th>
                        <th>Kategori</th>
                        <th width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 + (($nohalaman - 1) * 5);
                    foreach ($kategori as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nama_kategori'] ?></td>
                            <td>
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit-data<?= $value['id_kategori'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-data<?= $value['id_kategori'] ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br>
            <div class="float-center">
                <?= $pager->links('kategori', 'paging'); ?>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="d-none" id="card-refresh-content">
        The body of the card after card refresh
    </div>
</div>
<!-- MODAL -->
<!-- tambah data -->
<div class="modal fade" id="add-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data<?= $subjudul ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('Kategori/InsertData') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Nama Katgeori</label>
                    <input name="nama_kategori" class="form-control" placeholder="Kategori" autofocus="true" required>
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
<!-- update kategori -->
<?php foreach ($kategori as $key => $value) { ?>
    <div class="modal fade" id="edit-data<?= $value['id_kategori'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data<?= $subjudul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open('Kategori/UpdateData/' . $value['id_kategori']) ?>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="">Nama Kategori</label>
                        <input name="nama_kategori" value="<?= $value['nama_kategori'] ?>" class="form-control" placeholder="Kategori" required>
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
<!-- delete kategori -->
<?php foreach ($kategori as $key => $value) { ?>
    <div class="modal fade" id="delete-data<?= $value['id_kategori'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Data<?= $subjudul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda Yakin Menghapus Kategori</p>
                    <p> <?= $value['nama_kategori'] ?></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('Kategori/DeleteData/' . $value['id_kategori']) ?>" class="btn btn-danger btn-flat">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>