<div class="modal fade" id="modalcarisupplier">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Cari Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Berdasarkan Nama Supplier" id="carisupplier">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" id="btnCariSupplier">
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
    function cariDataSupplier() {
        let carisupplier = $('#carisupplier').val()
        $.ajax({
            type: "post",
            url: "<?= site_url('transaksimasuk/detailCariSupplier') ?>",
            data: {
                carisupplier: carisupplier
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
        $('#btnCariSupplier').click(function(e) {
            e.preventDefault();
            cariDataSupplier();
        });

        $('#carisupplier').keydown(function(e) {
            if (e.keyCode == '13') {
                e.preventDefault();
                cariDataSupplier();
            }
        });

        $('#modalcarisupplier').on('shown.bs.modal', function() {
            $('#carisupplier').focus();
        });
    });
</script>