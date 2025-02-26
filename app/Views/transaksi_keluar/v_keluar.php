<div class="col-md-12">
    <div class="card">
        <div class="card-header">Transaksi Keluar
            <div class="form-row">
                <div class="form-group col-md">
                    <label for="">No Faktur</label>
                    <input type="text" class="form-control" style="font-weight: bold; color:blue" id="faktur" readonly>
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
                        <input type="text" class="form-control" id="nopol">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#modalcaripelanggan">
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
                    Cari Data Part
                </div>
                <div class="card-body form-row">
                    <div class="form-group col-md">
                        <label for="">Kode Part</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="id_part">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#modalcaribarang">
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
            <div class="card-tools">
                <button type="button" class="btn btn-md btn-success" id="tobolSelesaiTransaks">
                    <i class="fas fa-save"></i>
                    Selesai Transaksi
                </button>
            </div>
        </div>
    </div>
</div>
<!-- modal cari barang -->
<div class="modal fade" id="modalcaribarang">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Cari Part Berdasarkan Nama</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Berdasarkan Kode atau Nama Part" id="caripart">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" id="btnCari">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- modal cari Pelanggan -->
<div class="modal fade" id="modalcaripelanggan">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Cari Pelanggan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Berdasarkan Nama Pelanggan" id="caripelanggan">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" id="btnCariSupp">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    function buatFaktur() {
        $.ajax({
            type: "post",
            url: "<?= site_url('transaksikeluar/buatFaktur') ?>",
            data: {
                tglfaktur: $('#tglfaktur').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.fakturjual) {
                    $('#faktur').val(response.fakturjual)
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    }

    function dataTemp() {
        let faktur = $('#faktur').val();

        $.ajax({
            type: "post",
            url: "/transaksikeluar/dataTemp",
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
    $('#nopol').keydown(function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            let nopol = $('#nopol').val();

            $.ajax({
                type: "post",
                url: "/transaksikeluar/ambilDataPelanggan",
                data: {
                    nopol: nopol
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('#nama_pelanggan').val(response.sukses.nama_pelanggan);
                    } else {
                        alert(response.error);
                        $('#nama_pelanggan').val('');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });
        }
    });

    function kosong() {
        $('#id_part').val('');
        $('#nama_part').val('');
        $('#harga_jual').val('');
        $('#id_part').focus();
    }

    $(document).ready(function() {
        dataTemp();
        buatFaktur();

        $('#id_part').keydown(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                let id_part = $('#id_part').val();

                $.ajax({
                    type: "post",
                    url: "/transaksikeluar/ambilDataBarang",
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

                        if (response.error) {
                            alert(response.error);
                            kosong();
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
            let id_part = $('#id_part').val();
            let harga_beli = $('#harga_beli').val();
            let jml_item = $('#jml_item').val();
            let nopol = $('#nopol').val();

            if (nopol.length == 0) {
                alert('Pelanggan belum diisi');
            } else if (id_part.length == 0) {
                alert('Belum memilih barang');
            } else if (harga_beli == '') {
                alert('Harga beli belum diisi');
            } else if (jml_item == '') {
                alert('Jumlah belum diisi');
            };
        });
        e.preventDefault();
    });

    function cariDataBarang() {
        let caripart = $('#cariPart').val()
        $.ajax({
            type: "post",
            url: "/transaksikeluar/detailCariBarang",
            data: {
                caripart: caripart
            },
            dataType: "json",
            success: function(response) {

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });

        $('#tombolSelesaiTransaksi').click(function(e) {
            e.preventDefault();
            let faktur = $('#faktur').val();

            if (faktur.length !== 0) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }
                });
            }
        });
    }
</script>