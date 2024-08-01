<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
require './function/global.php';
require './function/function_smart.php';
$hasils = query_data('SELECT * FROM tbl_hasil_smart');
// var_dump($hasils);
$username = $_SESSION['username'];
$userAdmin = $_SESSION['username'];
$hasil = hasil_test_smart();
$nilai = $hasil[0];
$nama = $hasil[1];
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
        $page = 8;
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
                                <button class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#modalHapus">Delete</button>
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
                                                    <?= $hasil['hasil'] ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $no++;
                                            ?>
                                    </tbody>
                                    <!-- Start delete modal -->
                                    <div class="modal fade-costum" id="modalHapus" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Hapus Data</h5>
                                                    <button type="button" data-bs-dismiss="modal" class="btn-close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form role="form" action="" method="POST" autocomplete="off">
                                                            <p>Yakin untuk menghapus hasil perhitungan ?</p>
                                                            <div class="flex text-center mt-4 mb-3">
                                                                <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" name="hapus" class="btn btn-danger ml-2">Hapus</button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End delete modal -->
                                <?php
                                        endforeach;
                                ?>
                                </table>
                                <?php
                                $calon_karyawans = query_data(" SELECT*FROM tbl_calon_karyawan");
                                smart($calon_karyawans);
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
                <div class="h3 container-fluid text-gray-900">
                    <?php
                    if ( $nilai && $nama){
                        echo "Berdasarkan hasil perhitungan tersebut
                        nilai Net Flow terbesar yaitu " .$nilai. " <br>
                        maka calon pendaftar dengan nilai tertinggi adalah " . $nama;
                    }else {
                        echo "Data belum di proses";
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

    if (isset($_POST['hapus'])) {
        // var_dump($_POST);
        if (hapus_data_hasil_smart($_POST) > 0) {
            echo '
                <script type="text/javascript">
                    swal({
                        title: "Berhasil",
                        text: "Berhasil Dihapus",
                        icon: "success",
                        showConfirmButton: true,
                    }).then(function(isConfirm){
                        if(isConfirm){
                            window.location.replace("smart.php");
                        }
                    });
                </script>
            ';
        } else {
            echo '
                <script type="text/javascript">
                    swal({
                        title: "Gagal",
                        text: "Gagal Dihapus",
                        icon: "error",
                        showConfirmButton: true,
                    }).then(function(isConfirm){
                        if(isConfirm){
                            window.location.replace("smart.php");
                        }
                    });
                </script>
            ';
        }
    }
    ?>

</body>

</html>