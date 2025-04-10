<div class="modal fade" id="modaltambahsupplier">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="modalSupplierLabel">Tambah Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formTambahSupplier">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Supplier</label>
                        <input id="nama_supplier" name="nama_supplier" class="form-control" placeholder="Masukkan Nama Supplier" required>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat Supplier</label>
                        <input id="alamat_supplier" name="alamat_supplier" class="form-control" placeholder="Masukkan Alamat Supplier" required>
                    </div>
                    <div class="form-group">
                        <label for="">Telp. Supplier</label>
                        <input type="number" id="telp_supplier" name="telp_supplier" class="form-control" placeholder="Gunakan Awalan 62" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div></div>
                    <button type="submit" class="btn btn-primary btn-flat" id="btnSaveTambahSupp">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#formTambahSupplier').on('submit', function(e) {
            e.preventDefault();

            let form = $(this)[0];
            let formData = new FormData(form);

            $.ajax({
                type: "POST",
                url: "<?= base_url('TransaksiMasuk/tambahSupplier') ?>",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        });
                        $('#modaltambahsupplier').modal('hide');
                        $('#formTambahSupplier')[0].reset();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.message
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat menghubungi server.'
                    });
                }
            });
        });
    });
</script>