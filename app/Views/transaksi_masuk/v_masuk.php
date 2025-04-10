<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <a href="<?= base_url('TransaksiMasuk/dataMasuk')  ?>" class="btn btn-sm btn-warning">
                    <i class="fa fa-backward"></i>
                    Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
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
                            <button class="btn btn-outline-success" type="button" id="tombolTambahSupplier">
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
            <div class="card-tools" style="text-align: end;">
                <button type="button" class="btn btn-sm btn-success" id="tombolSimpanTransaksi">
                    <i class="fas fa-save"></i>
                    Selesai Transaksi
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL -->
<!-- modal cari barang -->
<div class="modalcaripart" style="display: none"></div>
<!-- modal cari Supplier -->
<div class="modalcarisupplier" style="display: none"></div>
<!-- modal tambah supplier -->
<div class="modaltambahsupplier" style="display: none"></div>
<!-- modal selesai -->
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

    function kosong() {
        $('#id_part').val('');
        $('#nama_part').val('');
        $('#harga_jual').val('');
        $('#harga_beli').val('');
        $('#jml_item').val(1);
        $('#id_part').focus();

    }

    function dataTemp() {
        let faktur = $('#faktur').val();
        kosong();

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

    function simpanTemp() {

        let faktur = $("#faktur").val();
        let id_part = $("#id_part").val();
        let harga_beli = $("#harga_beli").val();
        let harga_jual = $("#harga_jual").val();
        let jml_item = $("#jml_item").val();
        let id_supplier = $("#id_supplier").val();
        let nama_part = $("#nama_part").val();

        if (id_part.length == 0) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Barang Belum Dipilih!",
            });
        } else if (harga_beli == '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Harga Beli Belum Diisi!",
            });
        } else if (harga_beli >= harga_jual) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Harga Beli Harus Lebih Rendah Dari Harga Jual",
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
                url: "/transaksimasuk/simpanTemp",
                data: {
                    faktur: faktur,
                    id_part: id_part,
                    id_supplier: id_supplier,
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

    function tambahSupplier() {
        $.ajax({
            type: "POST",
            url: "/Supplier/InserData",
            data: {
                nama_supplier: $('#nama_supplier').val(),
                alamat_supplier: $('#alamat_supplier').val(),
                telp_supplier: $('#telp_supplier').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.status === 'success') {
                    alert('Supplier berhasil ditambahkan!');
                } else {
                    alert('Gagal menambahkan supplier: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                alert('Terjadi kesalahan: ' + error);
            }
        });
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
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Supplier Tidak Ditemukan",
                    });
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
                    $('#jml_item').val(1);

                    $('#harga_beli').focus();
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
    $(document).ready(function() {
        $("body").addClass("sidebar-collapse");
        dataTemp();
        buatFaktur();

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
            simpanTemp();
        });

        $('btnSaveTambahSupp').click(function (e) { 
            e.preventDefault();
            tambahSupplier();            
        });

        $('#tombolReload').off().on("click", function(e) {
            e.preventDefault();
            dataTemp();
        });

        $('#tombolTambahSupplier').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "/transaksimasuk/tambahDataSupplier",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.modaltambahsupplier').html(response.data).show();
                        $('#modaltambahsupplier').modal('show');

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

        $('#tombolSimpanTransaksi').click(function(e) {
            e.preventDefault();
            let faktur = $('#faktur').val();
            let id_supplier = $('#id_supplier').val();
            let tglfaktur = $('#tglfaktur').val();

            if (id_supplier === '') {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Supplier Belum Diisi!",
                });
                return;
            }
            Swal.fire({
                title: "Yakin Selesai Transaksi?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Simpan Transaksi!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "/transaksimasuk/simpanTransaksi",
                        data: {
                            faktur: faktur,
                            tglfaktur: tglfaktur,
                            id_supplier: id_supplier
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                Swal.fire({
                                    title: "Berhasil!",
                                    text: response.sukses,
                                    icon: "success"
                                }).then(() => {
                                    window.location.href = "<?= base_url('transaksimasuk/dataMasuk') ?>";
                                });
                            } else {
                                Swal.fire({
                                    title: "Gagal!",
                                    text: response.error,
                                    icon: "error"
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: "Error!",
                                text: `Terjadi kesalahan: ${xhr.status} - ${xhr.responseText}`,
                                icon: "error"
                            });
                            console.error("Error:", xhr.responseText);
                        }
                    });
                }
            });
        });

    });
</script>