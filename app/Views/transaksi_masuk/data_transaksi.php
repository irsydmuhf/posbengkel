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
            <?= form_open('transaksimasuk/dataMasuk') ?>
            <span class="badge badge-success">Total Data : <?= $totaldata ?></span>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Berdasarkan Faktur" id="caritransaksi" name="caritransaksi" autofocus="true">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit" id="tombolCariTransaksi">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <?= form_close(); ?>
            <table class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="40px">No</th>
                        <th>Faktur</th>
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
                            <td><?= $t['tgl_beli'] ?></td>
                            <td style="text-align: center;">
                                <?php
                                $db = \Config\Database::connect();

                                $jmlItem = $db->table('det_transaksi_masuk')->where('faktur_detbeli', $t['faktur_beli'])->countAllResults();

                                ?>
                                <span><?= $jmlItem; ?></span>
                            </td>
                            <td><?= number_format($t['total_beli'], 0, ',', '.') ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="window.location.href='<?= base_url('transaksimasuk/view/' . $t['faktur_beli']) ?>'"> <i class="fas fa-eye"></i>
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