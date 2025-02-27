<div class="col-md-12">
    <div class="card">
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
                    <label for="">Kode Supplier</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="id_supplier">
                        <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" id="tombolCariSupplier">
                                <i class="fa fa-search"></i>
                            </button>
                            <button class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#tambahsupplier">
                                <i class="fa fa-plus"></i>
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
                    Cari Data Part
                </div>
                <div class="card-body form-row">
                    <div class="form-group col-md">
                        <label for="">Kode Part</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="id_part">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="button" id="tombolCariPart">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col">
                        <label for="">Nama Item</label>
                        <input type="text" class="form-control" id="nama_part" name="nama_part" readonly>
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
                <button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#modalselesai">
                    <i class="fas fa-save"></i>
                    Selesai Transaksi
                </button>
            </div>
        </div>
    </div>
</div>


<!-- MODAL -->
<!-- modal tambah supplier -->
<div class="modal fade" id="tambahsupplier" tabindex="-1" aria-labelledby="modalSupplierLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="modalSupplierLabel">Tambah Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
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
        </div>
    </div>
</div>
<!-- modal cari barang -->
<div class="modalcaripart" style="display: none"></div>
<!-- modal cari Supplier -->
<div class="modalcarisupplier" style="display: none"></div>
<!-- modal selesai -->
<div class="modal fade" id="modalselesai">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda Yakin Menyimpan Transaksi</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <a class="btn btn-danger btn-flat" id="tombolSimpanTransaksi">Simpan</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    function buatFaktur() {
        let tgl = $('#tglfaktur').val();
        $.ajax({
            type: "post",
            url: "<?= site_url('transaksimasuk/buatFaktur') ?>",
            data: {
                tglfaktur: $('#tglfaktur').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.fakturbeli) {
                    $('#faktur').val(response.fakturbeli)
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

    function kosong() {
        $('#id_part').val('');
        $('#nama_part').val('');
        $('#harga_jual').val('');
        $('#harga_beli').val('');
        $('#jml_item').val(1);
        $('#id_part').focus();

    }

    function simpanTemp() {

        let faktur = $("#faktur").val();
        let id_part = $("#id_part").val();
        let harga_beli = $("#harga_beli").val();
        let harga_jual = $("#harga_jual").val();
        let jml_item = $("#jml_item").val();
        let id_supplier = $("#id_supplier").val();
        let nama_part = $("#nama_part").val();


        if (id_supplier.length == 0) {
            alert('Supplier belum diisi');
            return;
        } else if (id_part.length == 0) {
            alert('Belum memilih barang');
            return;
        } else if (harga_beli == '') {
            alert('Harga beli belum diisi');
            return;
        } else if (jml_item == '') {
            alert('Jumlah belum diisi');
            return;
        } else {
            $.ajax({
                type: "post",
                url: "/transaksimasuk/simpanTemp",
                data: {
                    faktur: faktur,
                    id_part: id_part,
                    nama_part: nama_part,
                    harga_jual: harga_jual,
                    harga_beli: harga_beli,
                    jml_item: jml_item
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

    function ambilDataSupplier() {
        let id_supplier = $('#id_supplier').val();

        $.ajax({
            type: "post",
            url: "/transaksimasuk/ambilDataSupplier",
            data: {
                id_supplier: id_supplier
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('#nama_supplier').val(response.sukses.nama_supplier);
                } else {
                    alert(response.error);
                    $('#nama_supplier').val('');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
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
                    $('#jml_item').val(data.jml_item);

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
    }
    $(document).ready(function() {
        $("body").addClass("sidebar-collapse");
        dataTemp();
        buatFaktur();

        $('#formSupplier').submit(function(e) {
            e.preventDefault()

            $.ajax({
                type: 'POST',
                url: '<?= base_url("Supplier/InsertData") ?>',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        $('#modalSupplier').modal('hide');
                        location.reload();
                    }
                }
            });
        });
        $('#id_part').keydown(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                ambilDataPart();
            };
        });

        $('#id_supplier').keydown(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                ambilDataSupplier();
            }
        });

        $("#tombolTambahItem").off().on("click", function(e) {
            e.preventDefault();
            simpanTemp()
        });

        $('#tombolCariPart').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "/transaksimasuk/cariDataPart",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.modalcaripart').html(response.data).show();
                        $('#modalcaripart').modal('show');

                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }

            });
        });
        $('#tombolCariSupplier').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "/transaksimasuk/cariDataSupplier",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.modalcarisupplier').html(response.data).show();
                        $('#modalcarisupplier').modal('show');

                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }

            });
        });
    });



    $('#tombolSimpanTransaksi').click(function(e) {
        e.preventDefault();
        let faktur = $('#faktur').val();
        let id_supplier = $('#id_supplier').val();
        let tglfaktur = $('#tglfaktur').val();

        if (id_supplier === '') {
            alert('Supplier belum dipilih');
            return;
        }

        $.ajax({
            type: "post",
            url: "/transaksimasuk/simpanTransaksi",
            data: {
                faktur: faktur,
                tglfaktur: tglfaktur,
                id_supplier: id_supplier
            },
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    alert(response.error);
                } else {
                    alert(response.sukses);
                    window.location.reload();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    });
</script>