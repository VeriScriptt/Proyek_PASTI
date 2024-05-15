
<div class="modal fade" id="hideProdukModal" tabindex="-1" role="dialog" aria-labelledby="hideProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hideProdukModalLabel">Konfirmasi Sembunyikan Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menyembunyikan produk ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="btnHideProduk">Sembunyikan</button>
            </div>
        </div>
    </div>
</div>


<script>
    function hideProduk(produkId) {
        $('#hideProdukModal').modal('show');

        // Tambahkan event listener untuk tombol "Sembunyikan" di modal
        $('#btnHideProduk').click(function() {
            $.ajax({
                url: '{{ route("produk.hide", ":id") }}'.replace(':id', produkId),
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Tutup modal
                    $('#hideProdukModal').modal('hide');

                    // Tampilkan pesan sukses atau lakukan operasi lanjutan
                    alert("Produk berhasil disembunyikan!");

                    // Refresh atau reload halaman setelah berhasil menyembunyikan produk
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Tampilkan pesan error jika terjadi kesalahan
                    alert("Terjadi kesalahan saat menyembunyikan produk: " + error);
                }
            });
        });
    }
</script>