<div class="container-fluid">
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <label for="nofaktur">Faktur</label>
                        <input type="text" class="form-control form-control-sm text-danger font-weight-bold"
                            name="nofaktur" id="nofaktur" readonly>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control form-control-sm" name="tanggal" id="tanggal" readonly
                            value="<?= date('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <label for="nama_pelanggan">Pelanggan</label>
                        <div class="input-group">
                            <input type="text" value="-" class="form-control form-control-sm" name="nama_pelanggan" id="nama_pelanggan" readonly>
                            <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="0">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <label for="aksi">Aksi</label>
                        <div class="d-flex">
                            <button class="btn btn-danger btn-sm mr-2" type="button" id="btnHapusTransaksi">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                            <button class="btn btn-success btn-sm" type="button" id="btnSimpanTransaksi">
                                <i class="fa fa-save"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="id_item">Cari Part / Jasa</label>
                        <input type="text" class="form-control form-control-sm" name="id_item" id="id_item" placeholder="Masukkan kode/nama item">
                        <input type="hidden" name="jenis_item" id="jenis_item">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="nama_item">Nama Item</label>
                        <input type="text" class="form-control form-control-sm" name="nama_item" id="nama_item" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control form-control-sm" name="jumlah" id="jumlah" value="1">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="totalbayar">Total Bayar</label>
                        <input type="text" class="form-control form-control-lg text-right text-primary font-weight-bold"
                            name="totalbayar" id="totalbayar" value="0" readonly style="font-size: 30pt;">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="dataDetailPenjualan">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>