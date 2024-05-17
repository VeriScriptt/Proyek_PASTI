<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Partiga-Tiga</title>
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/sb-admin-2.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        @include('../sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            @include('../navbar')
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Produk</h1>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('tambah.produk') }}" class="btn btn-success">+Tambah Produk</a>
                            <div class="input-group ml-auto" style="width: 300px;">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                    aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Deskripsi</th>
                                        <th>Stok</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produk as $product)
                                    <tr>
                                        <td>{{ $product['ID'] }}</td>
                                        <td>{{ $product['nama'] }}</td>
                                        <td>{{ number_format($product['harga'], 0, ',', '.') }}</td>
                                        <td>{{ $product['deskripsi'] }}</td>
                                        <td>{{ $product['Stok'] }}</td>
                                        <td>{{ $kategoriData[$product['id_kategori']]['nama_kategori'] ?? 'Kategori tidak ditemukan' }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" style="color: white;" data-toggle="modal" data-target="#editProdukModal{{ $product['ID'] }}">
                                                <a href="{{ route('show.produk', ['id' => $product['ID']]) }}" style="color: white; text-decoration: none;">Edit</a>
                                            </button>                                            
                                            <form action="{{ route('delete.produk', $product['ID']) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus produk ini?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/js/sb-admin-2.js') }}"></script>
</body>
</html>
