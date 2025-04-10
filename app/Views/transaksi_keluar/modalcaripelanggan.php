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
                        <button class="btn btn-outline-primary" type="button" id="btnCariPelanggan">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="row viewdetaildata"></div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    function cariDataPelanggan() {
        let caripelanggan = $('#caripelanggan').val()
        $.ajax({
            type: "post",
            url: "<?= site_url('transaksikeluar/detailCariPelanggan') ?>",
            data: {
                caripelanggan: caripelanggan
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
    $(document).ready(function() {
        $('#btnCariPelanggan').click(function(e) {
            e.preventDefault();
            cariDataPelanggan();
        });

        $('#caripelanggan').keydown(function(e) {
            if (e.keyCode == '13') {
                e.preventDefault();
                cariDataPelanggan();
            }
        });

        $('#modalcaripelanggan').on('shown.bs.modal', function() {
            $('#caripelanggan').focus();
        });
    });
</script>