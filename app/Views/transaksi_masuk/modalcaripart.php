<div class="modal fade" id="modalcaripart">
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
                        <button class="btn btn-outline-primary" type="button" id="btnCariPart">
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
    function cariDataPart() {
        let caripart = $('#caripart').val()
        $.ajax({
            type: "post",
            url: "/transaksimasuk/detailCariPart",
            data: {
                caripart: caripart
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
        $('#btnCariPart').click(function(e) {
            e.preventDefault();
            cariDataPart();
        });

        $('#caripart').keydown(function(e) {
            if (e.keyCode == '13') {
                e.preventDefault();
                cariDataPart();
            }
        });

        $('#modalcaripart').on('shown.bs.modal', function() {
            $('#caripart').focus();
        });
    });
</script>