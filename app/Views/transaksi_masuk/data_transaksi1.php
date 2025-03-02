<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <a href="<?= base_url('TransaksiMasuk')  ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus-circle"></i>
                    Input Transaksi
                </a>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Berdasarkan Faktur" id="caritransaksi" autofocus="true">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit" id="tombolCariTransaksi">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <table class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="40px">No</th>
                        <th>Faktur</th>
                        <th>Supplier</th>
                        <th>Tanggal</th>
                        <th>Jumlah Item</th>
                        <th>Total Belanja</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($transaksi as $t) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $t['faktur_beli'] ?></td>
                            <td><?= $t['nama_supplier'] ?></td>
                            <td><?= $t['tgl_beli'] ?></td>
                            <td><?= $t['jumlah_item'] ?></td>
                            <td><?= number_format($t['total_beli'], 0, ',', '.') ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-warning">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function loadData(keyword = '') {
            $.ajax({
                url: ('/transaksimasuk/cariDataMasuk'),
                method: 'post',
                data: {
                    keyword: keyword
                },
                dataType: 'json',
                success: function(response) {
                    let html = '';
                    let no = 1;
                    for (const item of response) {
                        html += `
                            <tr>
                            <td>${no++}</td>
                            <td>${item.faktur_beli}</td>
                            <td>${item.nama_supplier}</td>
                            <td>${item.tgl_beli}</td>
                            <td>${item.jumlah_item}</td>
                            <td>${item.total_beli.toLocaleString()}</td>
                            <td>
                                <button class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-warning" onclick="detailTransaksi">
                                <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                                </button>
                            </td>
                            </tr>
                        `;
                    }
                    $('tbody').html(html);
                }
            });
        }

        loadData();

        $('#tombolCariTransaksi').click(function() {
            var keyword = $('#caritransaksi').val();
            loadData(keyword);
        });

        $('#caritransaksi').keypress(function(e) {
            if (e.which == 13) {
                var keyword = $(this).val();
                loadData(keyword);
                return false;
            }
        });
    });
</script>