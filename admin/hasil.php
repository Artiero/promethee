<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
require './function/global.php';
require './function/function_hasil.php';
$hasils = query_data('SELECT * FROM tbl_hasil');
// var_dump($hasils);
$username = $_SESSION['username'];
$userAdmin = $_SESSION['username'];
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <?php
    require 'views/link.php';
    ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        $page = 6;
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
                                <?php
                                $calon_karyawans = query_data(" SELECT*FROM tbl_calon_karyawan");
                                hasil($calon_karyawans);
                                ?>
                            </div>
                        </div>
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
    require 'views/script.php';
    require 'views/modalLogout.php';
    ?>

</body>

</html>