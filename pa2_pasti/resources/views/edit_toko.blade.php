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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
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
    <div id="wrapper">
        @include('sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            @include('navbar')
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Edit Toko</h1>
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Informasi Toko</h6>
                            </div>
                            <div class="card-body">
                            <!-- Edit Toko Modal Form -->
                            <form id="formEditToko" action="{{ route('toko.update', $data['ID'] ?? 0) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputUsernameModal">Nama Toko</label>
                                        <input class="form-control" id="inputUsernameModal" type="text" name="nama_toko" placeholder="Nama Toko" value="{{ $data['nama_toko'] ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-12">
                                            <label class="small mb-1" for="inputFirstNameModal">Nama Lengkap (Sesuai KTP / KK)</label>
                                            <input class="form-control" id="inputFirstNameModal" type="text" name="nama_lengkap" placeholder="Nama Lengkap Anda" value="{{ $data['nama_lengkap'] ?? '' }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-3">
                                            <label class="small mb-1" for="inputOrgNameModal">Nomor Kios</label>
                                            <input class="form-control" id="inputOrgNameModal" type="text" name="nomor_kios" placeholder="Nomor Kios" value="{{ $data['nomor_kios'] ?? '' }}" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="small mb-1" for="inputLocationModal">Lantai</label>
                                            <select class="form-control" id="inputLocationModal" name="lantai" required>
                                                <option value="lantai1" {{ (isset($data['lantai']) && $data['lantai'] == 'lantai1') ? 'selected' : '' }}>Lantai 1</option>
                                                <option value="lantai2" {{ (isset($data['lantai']) && $data['lantai'] == 'lantai2') ? 'selected' : '' }}>Lantai 2</option>
                                                <option value="Balairung" {{ (isset($data['lantai']) && $data['lantai'] == 'Balairung') ? 'selected' : '' }}>Balairung</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="inputEmailAddressModal">Email</label>
                                    <input class="form-control" id="inputEmailAddressModal" type="email" name="email" placeholder="xyz123@xmail.com" value="{{ $data['email'] ?? '' }}" required>
                                </div>
                                <div class="form-row">
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputPhoneModal">Nomor Telepon</label>
                                            <input class="form-control" id="inputPhoneModal" type="tel" name="nomor_telepon" placeholder="08xxxxxxxx" value="{{ $data['nomor_telepon'] ?? '' }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/js/sb-admin-2.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('admin_assets/js/demo/chart-pie-demo.js') }}"></script>
</body>
</html>