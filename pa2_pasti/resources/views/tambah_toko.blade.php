<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="editProfileModalLabel">Tambah Toko</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <form id="formTambahToko" action="{{ route('toko.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="namaToko">Nama Toko</label>
                        <input type="text" class="form-control @error('nama_toko') is-invalid @enderror" id="namaToko" name="nama_toko" placeholder="Nama Toko" value="{{ old('nama_toko') }}">
                        @error('nama_toko')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="namaLengkap">Nama Lengkap (Sesuai KTP / KK)</label>
                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="namaLengkap" name="nama_lengkap" placeholder="Nama Lengkap Anda" value="{{ old('nama_lengkap') }}">
                        @error('nama_lengkap')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="nomorKios">Nomor Kios</label>
                            <input type="tel" class="form-control @error('nomor_kios') is-invalid @enderror" id="nomorKios" name="nomor_kios" placeholder="Nomor Kios" value="{{ old('nomor_kios') }}" pattern="[0-9]*">
                            @error('nomor_kios')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="lantai">Lantai</label>
                            <select class="form-control @error('lantai') is-invalid @enderror" id="lantai" name="lantai">
                                <option value="lantai1" {{ old('lantai') == 'lantai1' ? 'selected' : '' }}>Lantai 1</option>
                                <option value="lantai2" {{ old('lantai') == 'lantai2' ? 'selected' : '' }}>Lantai 2</option>
                                <option value="Balairung" {{ old('lantai') == 'Balairung' ? 'selected' : '' }}>Balairung</option>
                                <!-- tambahkan opsi lainnya sesuai kebutuhan -->
                            </select>
                            @error('lantai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="xyz123@xmail.com" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="nomorTelepon">Nomor Telepon</label>
                        <input type="tel" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomorTelepon" name="nomor_telepon" placeholder="08xxxxxxxx" value="{{ old('nomor_telepon') }}" pattern="[0-9]*">
                        @error('nomor_telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <button type="submit" class="btn btn-primary" name="submit" id="submit">Simpan</button>
                </form>
              </div>
          </div>
      </div>
  </div>
