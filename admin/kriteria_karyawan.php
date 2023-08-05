<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
require './function/global.php';
// require './function/function_kriteria.php';
$karyawans = query_data('SELECT tbl_kriteria.nama_kriteria,
tbl_sub_kriteria.nama_sub_kriteria,
tbl_sub_kriteria.bobot
FROM tbl_kriteria INNER JOIN tbl_sub_kriteria
ON tbl_sub_kriteria.id_kriteria = tbl_kriteria.id');
// var_dump($karyawans);
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
                            <h6 class="m-0 font-weight-bold text-primary">Kriteria Karyawan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kriteria</th>
                                            <th>Sub Kriteria</th>
                                            <th>Bobot</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($karyawans as $karyawan) :
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $no ?>
                                            </td>
                                            <td>
                                            <?= $karyawan['nama_kriteria'] ?>
                                            </td>
                                            <td>
                                                <?= $karyawan['nama_sub_kriteria'] ?>
                                            </td>
                                            <td>
                                                <?= $karyawan['bobot'] ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $no++;
                                        ?>
                                    </tbody>

                                    

                                    <!-- Start delete modal -->
                                    <!-- <div class="modal fade-costum" id="modalHapus<?= $kriteria['id']; ?>" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Hapus Data</h5>
                                                    <button type="button" data-bs-dismiss="modal" class="btn-close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form role="form" action="" method="POST" autocomplete="off">
                                                        <?php
                                                        $id = $kriteria['id'];
                                                        $edits = query_data("SELECT * FROM tbl_kriteria WHERE id='$id'");
                                                        foreach ($edits as $edit) :
                                                        ?>
                                                            <input type="hidden" name="id" value="<?= $edit['id']; ?>">
                                                            <p>Yakin untuk menghapus data ?</p>
                                                            <div class="flex text-center mt-4 mb-3">
                                                                <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" name="hapus" class="btn btn-danger ml-2">Hapus</button>
                                                            </div>
                                                        <?php
                                                        endforeach
                                                        ?>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- End delete modal -->

                                    <!-- Start ubah modal -->
                                    <!-- <div class="modal fade-costum" id="modalUbah<?= $kriteria['id']; ?>" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Ubah Data</h5>
                                                    <button type="button" data-bs-dismiss="modal" class="btn-close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form role="form" action="" method="POST" autocomplete="off">
                                                        <?php
                                                        $id = $kriteria['id'];
                                                        $edits = query_data("SELECT * FROM tbl_kriteria WHERE id='$id'");
                                                        foreach ($edits as $edit) :
                                                        ?>
                                                        <input type="hidden" name="id" value="<?=$edit['id']?>">
                                                            <div class="form-group row mt-3">
                                                                <label class="col-3 col-form-label">Nama Kriteria</label>
                                                                <div class="col">
                                                                    <input type="text" class="form-control" name="nama_kriteria" value="<?= $edit['nama_kriteria'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="flex text-center mt-4 mb-3">
                                                                <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" name="ubah" class="btn btn-info ml-2">Ubah</button>
                                                            </div>
                                                        <?php
                                                        endforeach
                                                        ?>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- End ubah modal -->

                                    <?php
                                        endforeach;
                                    ?>

                                    <!-- Start tambah modal -->
                                    <!-- <div class="modal modal-custom fade" id="daftar-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tambah Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="#" autocomplete="off" id="daftarForm">
                                                        <div class="form-group row mt-3">
                                                            <label class="col-3 col-form-label">ID</label>
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="id" required placeholder="Masukan ID">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mt-3">
                                                            <label class="col-3 col-form-label">Nama Kriteria</label>
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="nama_kriteria" required placeholder="Nama Kriteria">
                                                            </div>
                                                        </div>
                                                        <div class="text-center mt-3 mb-2">
                                                            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- End tambah modal -->

                                </table>
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

    // if (isset($_POST['tambah'])) {
    //     if (tambah_data_kriteria($_POST) > 0) {
    //         echo '
    //                 <script type="text/javascript">
    //                     swal({
    //                         title: "Berhasil",
    //                         text: "Berhasil Ditambahkan",
    //                         icon: "success",
    //                         showConfirmButton: true,
    //                     }).then(function(isConfirm){
    //                         if(isConfirm){
    //                             window.location.replace("kriteria.php");
    //                         }
    //                     });
    //                 </script>
    //             ';
    //     } else {
    //         echo '
    //                 <script type="text/javascript">
    //                     swal({
    //                         title: "Gagal",
    //                         text: "Gagal Ditambahkan",
    //                         icon: "error",
    //                         showConfirmButton: true,
    //                     }).then(function(isConfirm){
    //                         if(isConfirm){
    //                             window.location.replace("kriteria.php");
    //                         }
    //                     });
    //                 </script>
    //             ';
    //     }
    // }
    // if (isset($_POST['hapus'])) {
    //     if (hapus_data_kriteria($_POST['id']) > 0) {
    //         echo '
    //             <script type="text/javascript">
    //                 swal({
    //                     title: "Berhasil",
    //                     text: "Berhasil Dihapus",
    //                     icon: "success",
    //                     showConfirmButton: true,
    //                 }).then(function(isConfirm){
    //                     if(isConfirm){
    //                         window.location.replace("kriteria.php");
    //                     }
    //                 });
    //             </script>
    //         ';
    //     } else {
    //         echo '
    //             <script type="text/javascript">
    //                 swal({
    //                     title: "Gagal",
    //                     text: "Gagal Dihapus",
    //                     icon: "error",
    //                     showConfirmButton: true,
    //                 }).then(function(isConfirm){
    //                     if(isConfirm){
    //                         window.location.replace("kriteria.php");
    //                     }
    //                 });
    //             </script>
    //         ';
    //     }
    // }
    // if (isset($_POST['ubah'])) {
    //     if (ubah_data_kriteria($_POST) > 0) {
    //         echo '
    //             <script type="text/javascript">
    //                 swal({
    //                     title: "Berhasil",
    //                     text: "Berhasil Diubah",
    //                     icon: "success",
    //                     showConfirmButton: true,
    //                 }).then(function(isConfirm){
    //                     if(isConfirm){
    //                         window.location.replace("kriteria.php");
    //                     }
    //                 });
    //             </script>
    //         ';
    //     } else {
    //         echo '
    //             <script type="text/javascript">
    //                 swal({
    //                     title: "Gagal",
    //                     text: "Gagal Diubah",
    //                     icon: "error",
    //                     showConfirmButton: true,
    //                 }).then(function(isConfirm){
    //                     if(isConfirm){
    //                         window.location.replace("kriteria.php");
    //                     }
    //                 });
    //             </script>
    //         ';
    //     }
    // }
    ?>

</body>

</html>