<?php
    
    $title = " Mahasiswa";
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'add') {
            $student = [];
            $title = "Tambah" . $title;
            $action = "create.php";
        }
        else if ($_GET['action'] == 'detail') {
            if (isset($_GET['nrp'])) {
                $title = "Detail" . $title;
                $action = "update.php";
            }
            else {
                header("location: index.php");
            }
        }
        else {
            header("location: detail.php?action=add");
        }
    }
    else {
        header("location: detail.php?action=add");
    }

    require 'database/retrive.php'; // return $student

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
    <link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
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
                        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Mahasiswa</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                        </ol>
                    </div>

                    <!-- Tombol Kembali -->
                    <a href="index.php" class="btn btn-danger mb-4"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
                                </div>
                                <div class="card-body">
                                    <!-- Form -->
                                    <form action="database/<?= $action ?>" method="post">
                                        <?php if ($_GET['action'] == 'detail') { ?>                                        
                                            <div class="form-group">
                                                <label for="nrp">NRP</label>
                                                <input class="form-control" type="text" placeholder="NRP akan terisi otomatis" id="nrp" readonly value="<?= $student['Nrp'] ?? '' ?>">
                                            </div>
                                        <?php } else { ?>
                                            <div class="alert alert-info">NRP akan dibuat secara otomatis setelah mahasiswa baru ditambah.</div>
                                        <?php } ?>
                                        
                                        <div class="form-group">
                                            <label for="Fakultas">Fakultas</label>
                                            <select class="form-control" name="Fakultas" id="Fakultas"
                                                <?php 
                                                    if ($_GET['action'] == 'detail') {
                                                        echo 'disabled';
                                                    }
                                                ?>
                                            >
                                                <?php foreach ($fakultas as $f) { ?>
                                                    <option value="<?= $f['IdFakultas'] ?>"
                                                        <?php 
                                                            if ($_GET['action'] == 'detail') {
                                                                if ($student['Fakultas'] == $f['IdFakultas']) {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                        ?>
                                                    >
                                                        <?= $f['Nama'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="Prodi">Prodi</label>
                                            <select class="form-control" name="Prodi" id="Prodi">
                                                <?php foreach ($prodi[1] as $p) { ?>
                                                    <option value="<?= $p['IdProdi'] ?>"
                                                        <?php 
                                                            if ($_GET['action'] == 'detail') {
                                                                if ($student['Prodi'] == $p['IdProdi']) {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                        ?>
                                                    >
                                                        <?= $p['Nama'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="Nama">Nama</label>
                                            <input class="form-control" type="text" id="Nama" name="Nama" value="<?= $student['Nama'] ?? '' ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="ThnTerima">Tahun Diterima</label>
                                            <input class="form-control" type="number" id="ThnTerima" name="ThnTerima" value="<?= $student['ThnTerima'] ?? '' ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="TglLahir">Tanggal Lahir</label>
                                            <input class="form-control" type="date" id="TglLahir" name="TglLahir" value="<?= $student['TglLahir'] ?? '' ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="Email">Email</label>
                                            <input class="form-control" type="email" id="Email" name="Email" value="<?= $student['Email'] ?? '' ?>">
                                        </div>

                                        <?php if ($_GET['action'] == 'detail') { ?>                                        
                                            <div class="form-group">
                                                <label for="Ipk">IPK</label>
                                                <input class="form-control" type="text" id="Ipk" value="<?= $student['Ipk'] ?? '0.000' ?>" readonly>
                                            </div>
                                        <?php } ?>

                                        <?php if ($_GET['action'] == 'detail') { ?>                                        
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <button class="btn btn-primary w-100" type="submit"><i class="fas fa-save mr-2"></i>Simpan Perubahan</button>
                                                </div>
                                                <div class="col-lg-6">
                                                    <button class="btn btn-danger w-100"><i class="fas fa-trash mr-2"></i>Hapus</button>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <button class="btn btn-primary w-100" type="submit"><i class="fas fa-save mr-2"></i>Simpan</button>
                                        <?php } ?>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>

    <script>
        const prodi = <?= json_encode($prodi) ?>;
        const seletedProdi = <?= $student['Prodi'] ?? 0 ?>

        $(document).ready(function() {
            <?php
                if ($_GET['action'] == 'add') {
                    ?> $("#ThnTerima").val(new Date().getFullYear()); <?php
                }
            ?>
            $("#Fakultas").change();
        })

        $("#Fakultas").change(function (){
            $("#Prodi").html("")
            prodi[$(this).val()].forEach(p => {
                $("#Prodi").append(`
                    <option value="` + p.IdProdi + `">` + p.Nama + `</option>
                `)
            });
            $("#Prodi").val(seletedProdi)
        })
    </script>
</body>