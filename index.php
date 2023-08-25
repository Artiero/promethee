<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
require './function/global.php';
$username = $_SESSION['username'];
$nama = query_data(" SELECT nama FROM tbl_calon_karyawan WHERE username = '$username'");
$nama_pendaftar = $nama[0];
$calon = implode($nama_pendaftar);
// var_dump($calon)

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Calon Karyawan</title>

    <?php
    require 'views/link.php';
    ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        $page = 1;
        require 'views/sidebar.php';
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php
                require 'views/navbar.php';
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Selamat Datang <b><?= $calon ?></b> <br>SILAHKAN LENGKAPI PROFILE UNTUK MELANJUTKAN PROSES
                            PENDAFTARAN.</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <p class="h3 mb-4 text-gray-900"> HASIL AKAN DI TAMPILKAN DI WEB </p>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php
            require 'views/footer.php';
            ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php
    require 'views/modalLogout.php';
    require 'views/script.php';
    ?>

</body>

</html>