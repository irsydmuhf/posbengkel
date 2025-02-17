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
                    <label for="">Kode Supplier</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="id_supplier">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md">
                    <label for="">Nama Supplier</label>
                    <input type="text" class="form-control" id="nama_supplier" readonly>
                </div>

            </div>
            <div class="card">
                <div class="card-header bg-primary">
                    Cari Data Part dan Jasa
                </div>
                <div class="card-body form-row">
                    <div class="form-group col-md">
                        <label for="">Kode Part</label>
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
                        <input type="text" class="form-control" id="nama_part" readonly>
                    </div>
                    <div class="form-group col">
                        <label for="">Harga Jual</label>
                        <input type="number" class="form-control" id="harga_jual" readonly>
                    </div>
                    <div class="form-group col">
                        <label for="">Harga Beli</label>
                        <input type="number" class="form-control" id="harga_beli">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="">Jumlah</label>
                        <input type="number" class="form-control" id="jml_item">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="">Aksi</label>
                        <div class="input-group">
                            <button class="btn btn-sm btn-info">
                                <i class="fa fa-plus-square" id="tombolTambahItem"></i>
                            </button> &nbsp;
                            <button class="btn btn-sm btn-warning">
                                <i class="fa fa-sync-alt" id="tombolReload"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="tampilDataTemp"></div>
        </div>
    </div>
</div>
<script>
    function dataTemp() {
        let faktur = $('#faktur').val();

        $.ajax({
            type: "post",
            url: "/transaksimasuk/dataTemp",
            data: {
                faktur: faktur
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('#tampilDataTemp').html(response.data);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    }

    $(document).ready(function() {
        dataTemp();

        $('#id_part').keydown(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                let id_part = $('#id_part').val();

                $.ajax({
                    type: "post",
                    url: "/transaksimasuk/ambilDataBarang",
                    data: {
                        id_part: id_part
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            let data = response.sukses;
                            $('#nama_part').val(data.nama_part);
                            $('#harga_jual').val(data.harga_jual);

                            $('#harga_beli').focus();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + '\n' + thrownError);
                    }
                });
            };
        });

        $('#tombolTambahItem').click(function(e) {
            e.preventDefault();
            let faktur = $('#faktur').val();
            let id_part = $('#id_part').val();
            let harga_beli = $('#harga_beli').val();
            let jml_item = $('#jml_item').val();

            if (faktur.length == 0){
                alert('Faktur Wajib Diisi');
            }
        });
    });
</script>