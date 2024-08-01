<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
require './function/global.php';
$username = $_SESSION['username'];
$hasils = query_data("SELECT*FROM tbl_hasil WHERE username = '$username' ");
$smarts = query_data(" SELECT*FROM tbl_hasil_smart WHERE username = '$username'");
$hasil = hasil_test_karyawan();
$nilai = $hasil[0];
$netflow = (float)$hasils[0]["net_flow"];
// var_dump($username);
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hasil Karyawan</title>

    <?php
    require 'views/link.php';
    ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        $page = 5;
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
                    <h1 class="h3 mb-2 text-gray-800">Admin</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Hasil</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <h3>PROMETHEE</h3>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Leving Flow</th>
                                            <th>Entering Flow</th>
                                            <th>Net Flow</th>

                                            <!-- <th>Berkas</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                                $no = 1;
                                                foreach ($hasils as $hasil) :
                                                ?>
                                            <tr>
                                                <td>
                                                    <?= $no ?>
                                                </td>
                                                <td>
                                                    <?= $hasil['nama_pendaftar'] ?>
                                                </td>
                                                <td>
                                                    <?= $hasil['leaving_flow'] ?>
                                                </td>
                                                <td>
                                                    <?= $hasil['entering_flow'] ?>
                                                </td>
                                                <td>
                                                    <?= $hasil['net_flow'] ?>
                                                </td>
                                            </tr>
                                            <?php
                                                    $no++;
                                            ?>
                                    </tbody>
                                    
                                <?php
                                                endforeach;
                                ?>
                                </table>
                            </div>
                            <div class="table-responsive pt-5">
                                <h3>SMART</h3>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Hasil</th>

                                            <!-- <th>Berkas</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                                $no = 1;
                                                foreach ($smarts as $smart) :
                                                ?>
                                            <tr>
                                                <td>
                                                    <?= $no ?>
                                                </td>
                                                <td>
                                                    <?= $smart['nama_pendaftar'] ?>
                                                </td>
                                                <td>
                                                    <?= $smart['hasil'] ?>
                                                </td>
                                            </tr>
                                            <?php
                                                    $no++;
                                            ?>
                                    </tbody>
                                    
                                <?php
                                                endforeach;
                                ?>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
                <div class="h3 container-fluid text-gray-900">
                <?php
                if ( $netflow >= $nilai){
                    echo "Kepada peserta yang lolos, selamat atas pencapaian Anda!<br>
                    Kami akan menghubungi Anda untuk langkah-langkah selanjutnya dalam proses ini.";
                }else {
                    echo "Kepada peserta yang tidak lolos, kami mengucapkan terima kasih atas partisipasi Anda.<br>
                    Jangan ragu untuk mencoba lagi di kesempatan berikutnya.";
                }
                ?>
                </div>

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
    require 'views/script.php';
    require 'views/modalLogout.php';
    ?>

</body>

</html>