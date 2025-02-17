<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="form-row">
                <div class="form-group col-md">
                    <label for="">No Faktur</label>
                    <input type="text" class="form-control" value="<?= date('Y-m-d') ?>" id="faktur">
                </div>
                <div class="form-group col-md ">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="tglfaktur" value="<?= date('Y-m-d') ?>" id="tglfaktur" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md">
                    <label for="">Kode Pelanggan</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="id_pelanggan">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md">
                    <label for="">Nama Pelanggan</label>
                    <input type="text" class="form-control" id="nama_pelanggan" readonly>
                </div>

            </div>
            <div class="card">
                <div class="card-header bg-primary">
                    Cari Data Part dan Jasa
                </div>
                <div class="card-body form-row">
                    <div class="form-group col-md">
                        <label for="">Kode Part / Jasa</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="id_part">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col">
                        <label for="">Nama Item</label>
                        <input type="text" class="form-control" id="id_part" readonly>
                    </div>
                    <div class="form-group col">
                        <label for="">Harga Jual</label>
                        <input type="number" class="form-control" id="id_part" readonly>
                    </div>
                    <div class="form-group col">
                        <label for="">Harga Beli</label>
                        <input type="number" class="form-control" id="id_part" readonly>
                    </div>
                    <div class="form-group col-md-1">000
                        <label for="">Jumlah</label>
                        <input type="number" class="form-control" id="id_part">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="">Aksi</label>
                        <div class="input-group">
                            <button class="btn btn-sm btn-info">
                                <i class="fa fa-plus-square"></i>
                            </button> &nbsp;
                            <button class="btn btn-sm btn-warning">
                                <i class="fa fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>