<!-- create_produk.blade.php -->
<div class="modal fade" id="tambahProdukModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form untuk menambah produk -->
                <form id="formTambahProduk" action="{{ route('store.kategori') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_kategori">Nama Produk</label>
                        <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                            id="namaProduk" name="nama_kategori" placeholder="Masukkan nama Kategori"
                            value="{{ old('nama_kategori') }}">
                        @error('nama_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" name="submit" id="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>