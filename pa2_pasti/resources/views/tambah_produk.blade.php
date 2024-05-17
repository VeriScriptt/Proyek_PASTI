<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tambah Produk</title>

    <!-- Include your CSS files here -->
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/sb-admin-2.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet" type="text/css">
</head>
<body id="page-top">
    <div id="wrapper">
        @include('../sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            @include('../navbar')
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Tambah Produk</h1>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form action="{{ route('store.produk') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="namaProduk">Nama Produk</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="namaProduk" name="nama" placeholder="Masukkan nama produk" value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="tel" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" placeholder="Masukkan harga produk" value="{{ old('harga') }}" pattern="[0-9]*">
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="tel" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" placeholder="Masukkan stok produk" value="{{ old('stok') }}" pattern="[0-9]*">
                                @error('stok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi produk">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select class="form-control @error('id_kategori') is-invalid @enderror" id="kategori" name="id_kategori">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($dataKategori as $kategori)
                                        <option value="{{ $kategori['id'] }}">{{ $kategori['nama_kategori'] }}</option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Include your JS files here -->
    <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/js/sb-admin-2.js') }}"></script>
</body>
</html>
