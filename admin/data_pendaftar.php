<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
require './function/global.php';
require './function/function_admin.php';
$karyawans = query_data('SELECT*FROM tbl_calon_karyawan');
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
        $page = 2;
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
                            <h6 class="m-0 font-weight-bold text-primary">Data Pendaftar</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Gender</th>
                                            <th>Alamat</th>
                                            <th>Pendidikan</th>
                                            <th>Pengalaman Organisasi</th>
                                            <th>Pengalaman Kerja</th>
                                            <th>Kondisi Fisik</th>
                                            <th>No Telpon</th>
                                            <!-- <th>Berkas</th> -->
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
                                                    <?= $karyawan['nama'] ?>
                                                </td>
                                                <td>
                                                    <?= $karyawan['jkel'] ?>
                                                </td>
                                                <td>
                                                    <?= $karyawan['alamat'] ?>
                                                </td>
                                                <td>
                                                    <?= $karyawan['pendidikan'] ?>
                                                </td>
                                                <td>
                                                    <?= $karyawan['pengalaman_organ'] ?>
                                                </td>
                                                <td>
                                                    <?= $karyawan['pengalaman_kerja'] ?>
                                                </td>
                                                <td>
                                                    <?= $karyawan['kondisi_fisik'] ?>
                                                </td>
                                                <td>
                                                    <?= $karyawan['no_telpon'] ?>
                                                </td>
                                                <!-- <td>
                                                    <?= $karyawan['berkas']?>
                                                </td> -->

                                                <!-- Start download modal -->
                                                <!-- <div class="modal fade" id="modalDownload<?= $karyawan['berkas']; ?>" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Download Data</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form role="form" action="" method="POST" autocomplete="off">
                                                                    <?php
                                                                    $id = $karyawan['berkas'];
                                                                    $edits = query_data("SELECT * FROM tbl_calon_karyawan WHERE berkas='$id'");
                                                                    foreach ($edits as $edit) :
                                                                    ?>
                                                                        <input type="hidden" name="username" value="<?= $edit['username']; ?>">
                                                                        <input type="hidden" name="berkas" value="<?= $edit['berkas']; ?>">
                                                                        <p>Download Data ?</p>
                                                                        <div class="flex text-center mt-4 mb-3">
                                                                            <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">No</button>
                                                                            <button type="submit" name="download" class="btn btn-info ml-2">Yes</button>
                                                                        </div>
                                                                    <?php
                                                                    endforeach
                                                                    ?>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <!-- End download modal -->

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

    if (isset($_POST['tambah'])) {
        if (tambah_data_admin($_POST) > 0) {
            echo '
                    <script type="text/javascript">
                        swal({
                            title: "Berhasil",
                            text: "Berhasil Ditambahkan",
                            icon: "success",
                            showConfirmButton: true,
                        }).then(function(isConfirm){
                            if(isConfirm){
                                window.location.replace("admin.php");
                            }
                        });
                    </script>
                ';
        } else {
            echo '
                    <script type="text/javascript">
                        swal({
                            title: "Gagal",
                            text: "Gagal Ditambahkan",
                            icon: "error",
                            showConfirmButton: true,
                        }).then(function(isConfirm){
                            if(isConfirm){
                                window.location.replace("admin.php");
                            }
                        });
                    </script>
                ';
        }
    }
    if (isset($_POST['hapus'])) {
        if (hapus_data_admin($_POST['username']) > 0) {
            echo '
                <script type="text/javascript">
                    swal({
                        title: "Berhasil",
                        text: "Berhasil Dihapus",
                        icon: "success",
                        showConfirmButton: true,
                    }).then(function(isConfirm){
                        if(isConfirm){
                            window.location.replace("admin.php");
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
                            window.location.replace("admin.php");
                        }
                    });
                </script>
            ';
        }
    }
    if (isset($_POST['ubah'])) {
        if (ubah_data_admin($_POST) > 0) {
            echo '
                <script type="text/javascript">
                    swal({
                        title: "Berhasil",
                        text: "Berhasil Diubah",
                        icon: "success",
                        showConfirmButton: true,
                    }).then(function(isConfirm){
                        if(isConfirm){
                            window.location.replace("admin.php");
                        }
                    });
                </script>
            ';
        } else {
            echo '
                <script type="text/javascript">
                    swal({
                        title: "Gagal",
                        text: "Gagal Diubah",
                        icon: "error",
                        showConfirmButton: true,
                    }).then(function(isConfirm){
                        if(isConfirm){
                            window.location.replace("admin.php");
                        }
                    });
                </script>
            ';
        }
    }
    ?>

</body>

</html>