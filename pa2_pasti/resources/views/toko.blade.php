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
                <h1 class="h3 mb-2 text-gray-800">Toko</h1>
                <!-- DataTales Example -->
                <div class="row">
                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card mb-4">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <div>Toko Details</div>
                                    @include('tambah_toko')
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#editProfileModal">Buat Toko</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <!-- Form Group (username)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputUsername">Nama Toko</label>
                                        <input class="form-control" id="inputUsername" type="text" placeholder="Nama Toko" value="{{ isset($data[0]['nama_toko']) ? $data[0]['nama_toko'] : '' }}">
                                    </div>
                                    <!-- Form Row-->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (first name)-->
                                        <div class="col-md-12">
                                            <label class="small mb-1" for="inputFirstName">Nama Lengkap (Sesuai KTP / KK)</label>
                                            <input class="form-control" id="inputFirstName" type="text" placeholder="Nama Lengkap Anda" value="{{ isset($data[0]['nama_lengkap']) ? $data[0]['nama_lengkap'] : '' }}">
                                        </div>
                                    </div>
                                    <!-- Form Row        -->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (organization name)-->
                                        <div class="col-md-3">
                                            <label class="small mb-1" for="inputOrgName">Nomor Kios</label>
                                            <input class="form-control" id="inputOrgName" type="text" placeholder="Nomor Kios" value="{{ isset($data[0]['nomor_kios']) ? $data[0]['nomor_kios'] : '' }}">
                                        </div>
                                        <!-- Form Group (location)-->
                                        <div class="col-md-3">
                                            <label class="small mb-1" for="inputLocation">Lantai</label>
                                            <select class="form-control" id="inputLocation">
                                                <option value="lantai1" {{ isset($data[0]['lantai']) && $data[0]['lantai'] == 'lantai1' ? 'selected' : '' }}>Lantai 1</option>
                                                <option value="lantai2" {{ isset($data[0]['lantai']) && $data[0]['lantai'] == 'lantai2' ? 'selected' : '' }}>Lantai 2</option>
                                                <option value="Balairung" {{ isset($data[0]['lantai']) && $data[0]['lantai'] == 'Balairung' ? 'selected' : '' }}>Balairung</option>
                                                <!-- tambahkan opsi lainnya sesuai kebutuhan -->
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Form Group (email address)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputEmailAddress">Email</label>
                                        <input class="form-control" id="inputEmailAddress" type="email" placeholder="xyz123@xmail.com" value="{{ isset($data[0]['email']) ? $data[0]['email'] : '' }}">
                                    </div>
                                    <!-- Form Row-->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (phone number)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputPhone">Nomor Telepon</label>
                                            <input class="form-control" id="inputPhone" type="tel" placeholder="08xxxxxxxx" value="{{ isset($data[0]['nomor_telepon']) ? $data[0]['nomor_telepon'] : '' }}">
                                        </div>
                                    </div>
                                    <!-- Edit button-->
                                    {{-- <pre>{{ print_r($data, true) }}</pre> --}}
                                    @foreach ($data as $product)

                                    <button type="button" class="btn btn-primary" style="color: white;" data-toggle="modal" data-target="#editProdukModal">
                                        <a href="{{ route('toko.show',['id' => $product['ID']]) }}" style="color: white; text-decoration: none;">Edit</a>
                                    </button> 
                                    @endforeach 
                                    {{-- <a href="{{ route('toko.show',['id' => $data[0]['ID'] ?? 0]) }}" class="btn btn-primary">Edit</a>                                </form> --}}
                            </div>
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

    <!-- Bootstrap core JavaScript-->
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
