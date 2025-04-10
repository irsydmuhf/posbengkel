<div class="modal fade" id="modalcariitem">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Cari Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <!-- Tipe Pencarian -->
                <div class="form-group">
                    <label><strong>Pilih Tipe Item:</strong></label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipe_item" id="tipePart" value="part" checked>
                        <label class="form-check-label" for="tipePart">Part</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipe_item" id="tipeJasa" value="jasa">
                        <label class="form-check-label" for="tipeJasa">Jasa</label>
                    </div>
                </div>

                <!-- Kolom Pencarian -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Berdasarkan Nama Barang atau Jasa" id="cariitem">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" id="btnCariItem" onclick="cariDataItem()">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Tampilkan Data -->
                <div class="row viewdetaildata"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function cariDataItem() {
        let cariitem = $('#cariitem').val();
        let tipe = $('input[name="tipe_item"]:checked').val();

        $.ajax({
            type: "post",
            url: "<?= site_url('transaksikeluar/detailCariItem') ?>",
            data: {
                cariitem: cariitem,
                tipe: tipe
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewdetaildata').html(response.data);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.error(xhr.status + '\n' + thrownError);
            }
        });
    }
</script>