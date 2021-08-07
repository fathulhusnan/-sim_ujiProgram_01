<?php
    require 'database/list.php'; // return $students
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Mahasiswa</title>
    <script src="https://kit.fontawesome.com/88c7b91a4c.js" crossorigin="anonymous"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Menu -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">SIM UBAYA</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                <i class="fas fa-users"></i>
                <span>Mahasiswa</span></a>
            </li>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small">Admin SIM Ubaya</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid" id="container-wrapper">
                    <!-- Breadcrumb -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h1 class="h3 mb-0 text-gray-800">Mahasiswa</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Mahasiswa</li>
                        </ol>
                    </div>

                    <!-- Tombol Tambah -->
                    <a href="detail.php?action=add" class="btn btn-primary btn-lg mb-4"><i class="fas fa-plus mr-2"></i>Tambah Mahasiswa</a>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Mahasiswa</h6>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover table-border" id="students">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>NRP</th>
                                                <th>Fakultas</th>
                                                <th>Prodi</th>
                                                <th>Nama Lengkap</th>
                                                <th>IPK</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <!-- Daftar Mahasiswa -->
                                        <tbody>
                                            <?php foreach ($students as $student) { ?>
                                                <tr>
                                                    <th><?= $student['Nrp'] ?></th>
                                                    <th><?= $student['Fakultas'] ?></th>
                                                    <th><?= $student['Prodi'] ?></th>
                                                    <th><?= $student['Nama'] ?></th>
                                                    <th><?= $student['Ipk'] ?></th>
                                                    <th>
                                                        <a href="detail.php?action=detail&nrp=<?= $student['Nrp'] ?>" class="btn btn-warning"><i class="fas fa-search mr-2"></i>Detail</a>
                                                    </th>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <!-- Daftar Modal -->
                </div>

            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - designed by
                        <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b>
                        </span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#students').DataTable({
                columns: [
                    { orderable: true },
                    { orderable: true },
                    { orderable: true },
                    { orderable: true },
                    { orderable: true },
                    { orderable: false }
                ],
                language: {
                    "lengthMenu"	: "Menampilkan _MENU_ mahasiswa per halaman",
                    "emptyTable"	: "Masih belum ada mahasiswa yang dibuat.",
                    "zeroRecords"	: "Mahasiswa yang dicari tidak ditemukan.",
                    "info"			: "Halaman _PAGE_ dari _PAGES_",
                    "infoEmpty"		: "Tidak ada mahasiswa.",
                    "infoFiltered"	: "(disaring dari total _MAX_ mahasiswa)",
                    "search"		: "Cari:",
                    "thousands"		: ".",
                    "paginate": {
                        "first"		: "Pertama",
                        "last"		: "Terakhir",
                        "next"		: "Lanjut",
                        "previous"	: "Kembali"
                    },
                }
            })
        })
    </script>
</body>