<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Partiga-Tiga</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('admin_assets/css/sb-admin-2.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('../sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            @include('../navbar')
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Kategori</h1>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        @include('../tambah_kategori')
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori</h6>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahProdukModal">+Tambah Kategori</button>
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
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nama Katgeori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $product)
                                    <tr>
                                        <td>{{ $product['id']}}</td>
                                        <td>{{ $product['nama_kategori']}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" style="color: white;" data-toggle="modal" data-target="#editProdukModal">
                                                <a href="{{ route('show.kategori',['id' => $product['id']]) }}" style="color: white; text-decoration: none;">Edit</a>
                                            </button>                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>  
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>


    {{-- <script>
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

        function unhideProduk(produkId) {
            $.ajax({
                url: '{{ route("produk.unhide", ":id") }}'.replace(':id', produkId),
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Tampilkan pesan sukses atau lakukan operasi lanjutan
                    alert("Produk berhasil ditampilkan kembali!");

                    // Refresh atau reload halaman setelah berhasil menampilkan produk
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Tampilkan pesan error jika terjadi kesalahan
                    alert("Terjadi kesalahan saat menampilkan produk: " + error);
                }
            });
        }
    </script> --}}
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin_assets/js/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/js/sb-admin-2.js') }}"></script>


    <!-- Page level plugins -->
    <script src="{{ asset('admin_assets/vendor/chart.js/Chart.min.js') }}"></script>