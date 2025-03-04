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

            <!-- searhcing -->
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Berdasarkan Kode, Nama Part atau Kategori" id="caripart" autofocus="true">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit" id="tombolCariPart">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
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
            <table class="table table-sm table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="2%">No</th>
                        <th>Kode Barang</th>
                        <th>Nama</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 + (($nohalaman - 1) * 10);
                    foreach ($part as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['id_part'] ?></td>
                            <td><?= $value['nama_part'] ?></td>
                            <td>
                                <button onclick="viewPart('<?= $value['id_part'] ?>')" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="editPart('<?= $value['id_part'] ?>')" class="btn btn-sm btn-warning">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button onclick="deletePart('<?= $value['id_part'] ?>')" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
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
        <!-- view data -->

        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="d-none" id="card-refresh-content">
        The body of the card after card refresh
    </div>
</div>


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
                    <!-- Harga Jual -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="harga_jual">Harga Beli</label>
                            <input type="number" name="harga_jual" id="harga_jual" class="form-control" placeholder="Harga Jual" required>
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
<script>
    $(document).ready(function() {
        function loadData(keyword = '') {
            $.ajax({
                url: '/part/cariDataPart',
                method: 'post',
                data: {
                    keyword: keyword
                },
                success: function(response) {
                    let html = '';
                    let no = 1;
                    response.forEach(item => {
                        html += `
                    <tr>
                        <td>${no = 1 + (($nohalaman - 1) * 10)}</td>
                        <td>${item.id_part}</td>
                        <td>${item.nama_part}</td>
                        <td>
                            <button onclick="viewPart('${item.id_part}')" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button onclick="editPart('${item.id_part}')" class="btn btn-sm btn-warning">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button onclick="deletePart('${item.id_part}')" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                    });
                    $('tbody').html(html);
                }
            });
        }

        loadData();

        $('#tombolCariPart').click(function() {
            var keyword = $('#caripart').val();
            loadData(keyword);
        });
        $('#caripart').keypress(function(e) {
            if (e.which == 13) {
                var keyword = $(this).val();
                loadData(keyword);
                return false;
            }
        });
    });
</script>