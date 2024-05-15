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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('admin_assets/css/sb-admin-2.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            @include('navbar')
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Ulasan</h1>
                <!-- Card Example -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Ulasan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($visibleUlasan as $ulasan)
                                            <div class="col-md-3 mb-4">
                                                <div class="card border-left-primary h-100">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-primary">{{ $ulasan['nama_produk'] }}</h5>
                                                        <p class="card-text">Nama Pengirim Ulasan: {{ $ulasan['nama_pengirim'] }}</p>
                                                        <p class="card-text">Ulasan: {{ $ulasan['ulasan'] }}</p>
                                                        <form action="{{ route('ulasan.hide', $ulasan['ID']) }}" method="POST" class="hide-form">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-danger hide-btn" data-id="{{ $ulasan['ID'] }}">Sembunyikan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Ulasan yang Disembunyikan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($hiddenUlasan as $ulasan)
                                            <div class="col-md-3 mb-4">
                                                <div class="card border-left-primary h-100">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-primary">{{ $ulasan['nama_produk'] }}</h5>
                                                        <p class="card-text">Nama Pengirim Ulasan: {{ $ulasan['nama_pengirim'] }}</p>
                                                        <p class="card-text">Ulasan: {{ $ulasan['ulasan'] }}</p>
                                                        <form action="{{ route('ulasan.unhide', $ulasan['ID']) }}" method="POST" class="hide-form">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-success hide-btn" data-id="{{ $ulasan['ID'] }}">Tampilkan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin_assets/js/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/js/sb-admin-2.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('admin_assets/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('admin_assets/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('admin_assets/js/demo/chart-pie-demo.js') }}"></script>
</body>

</html>
