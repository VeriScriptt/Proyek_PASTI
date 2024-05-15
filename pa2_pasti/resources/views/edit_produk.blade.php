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
                <!-- DataTales Example -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editProdukModalLabel">Edit Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk edit produk -->
                    <form id="formEditProduk" action="{{ route('update.produk', $data['ID']) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="form-group col-md-6">
                                <label for="editNamaProduk">Nama Produk</label>
                                <input type="text" class="form-control" id="editNamaProduk" name="editNamaProduk"
                                    value="{{ $data['nama'] }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editHarga">Harga</label>
                                <input type="number" class="form-control" id="editHarga" name="editHarga"
                                    value="{{ $data['harga'] }}" min="0" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="editStok">Stok</label>
                                <input type="number" class="form-control" id="editStok" name="editStok"
                                    value="{{ $data['Stok'] }}" min="0" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editDeskripsi">Deskripsi</label>
                            <textarea class="form-control" id="editDeskripsi" name="editDeskripsi" rows="3"
                                required>{{ $data['deskripsi'] }}</textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" name="submit" id="submit"  class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
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