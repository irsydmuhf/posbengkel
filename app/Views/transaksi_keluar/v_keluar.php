<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <a href="<?= base_url('TransaksiKeluar/dataKeluar')  ?>" class="btn btn-sm btn-warning">
                    <i class="fa fa-backward"></i>
                    Kembali
                </a>
            </div>
        </div>
        <div class="card-header">
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
                    <label for="">Nopol</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="nopol" value="-">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="button" id="tombolCariPelanggan">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md">
                    <label for="">Nama Pelanggan</label>
                    <input type="text" class="form-control" id="nama_pelanggan" readonly value="-">
                </div>

            </div>
            <div class="card">
                <div class="card-header bg-primary">
                    Cari Data Part
                </div>
                <div class="card-body form-row">
                    <div class="form-group col-md">
                        <label for="">Kode Part / Jasa</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="id_item">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="button" id="tombolCariItem">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col">
                        <label for="">Nama Item</label>
                        <input type="text" class="form-control" id="nama_item" readonly>
                    </div>
                    <div class="form-group col">
                        <label for="">Harga Jual</label>
                        <input type="number" class="form-control" id="harga_item" readonly>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="">Jumlah</label>
                        <input type="number" class="form-control" id="jml_item" value="1">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="">Diskon (%)</label>
                        <input type="number" class="form-control" id="diskon" name="diskon" value="0">
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
<div class="modalcaripelanggan" style="display: none"></div>
<div class="modalcariitem" style="display: none"></div>
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

    function kosong() {
        $('#id_part').val('');
        $('#nama_part').val('');
        $('#harga_jual').val('');
        $('#jml_item').val(1);
        $('#id_part').focus();

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

    $('#tombolCariPelanggan').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "/transaksikeluar/cariDataPelanggan",
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.modalcaripelanggan').html(response.data).show();
                    $('#modalcaripelanggan').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }

        });
    });

    function ambilDataPelanggan() {
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
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Pelanggan Tidak Ditemukan",
                    });
                    $('#nama_pelanggan').val('');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    }

    $('#tombolCariItem').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "/transaksikeluar/cariDataItem",
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.modalcariitem').html(response.data).show();
                    $('#modalcariitem').modal('show');

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }

        });
    });

    function ambilDataItem() {
        let id_item = $('#id_item').val();

        $.ajax({
            type: "pos",
            url: "/transaksikeluar/ambilDataItem",
            data: "data",
            dataType: "dataType",
            success: function(response) {

            }
        });
    }

    function ambilDataPart() {
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
                    $('#jml_item').val(1);
                }

                if (response.error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Part Tidak Ditemukan!",
                    });
                    kosong();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    }



    function ambilDataJasa() {
        let id_jasa = $('#id_jasa').val();

        $.ajax({
            type: "post",
            url: "/transaksikeluar/ambilDataJasa",
            data: {
                id_jasa: id_jasa
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('#nama_jasa').val(response.sukses.nama_jasa);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Jasa Tidak Ditemukan",
                    });
                    $('#nama_jasa').val('');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    }

    function simpanTemp() {

        let faktur = $("#faktur").val();
        let id_part = $("#id_part").val();
        let harga_jual = $("#harga_jual").val();
        let jml_item = $("#jml_item").val();
        let nopol = $("#nopol").val();
        let nama_part = $("#nama_part").val();
        let diskon = $("#diskon").val();

        if (id_part.length == 0) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Barang Belum Dipilih!",
            });
        } else if (jml_item == '' && jml_item <= 0) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Jumlah Item Belum Diisi!",
            });
        } else {
            $.ajax({
                type: "post",
                url: "/transaksikeluar/simpanTemp",
                data: {
                    faktur: faktur,
                    id_part: id_part,
                    nopol: nopol,
                    nama_part: nama_part,
                    harga_jual: harga_jual,
                    jml_item: jml_item,
                    diskon: diskon
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        dataTemp();
                        kosong();
                    } else if (response.error) {
                        alert(response.error);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });
        }
    }


    $(document).ready(function() {
        $("body").addClass("sidebar-collapse");
        buatFaktur();
        dataTemp();

        $('#nopol').keydown(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                ambilDataPelanggan();
            }
        });

        $('#id_item').keydown(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                ambilDataPart();
            };
        });

        $('#id_part').keydown(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                ambilDataPart();
            };
        });

        $('#id_jasa').keydown(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                ambilDataJasa();
            };
        });

        $("#tombolTambahItem").off().on("click", function(e) {
            e.preventDefault();
            simpanTemp();
        });
    });
</script>