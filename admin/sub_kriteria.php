<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
require './function/global.php';
require './function/function_sub_kriteria.php';
$sub_kriterias = query_data('SELECT*FROM tbl_sub_kriteria');
// $username = $_SESSION['username'];
// $userAdmin = $_SESSION['username'];
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
        $page = 4;
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
                            <h6 class="m-0 font-weight-bold text-primary">Data Sub Kriteria</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#daftar-data">Tambah Sub Kriteria</button>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Sub Kriteria</th>
                                            <th>Bobot</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($sub_kriterias as $sub_kriteria) :
                                        ?>
                                            <tr>
                                                <td>
                                                    <?= $no ?>
                                                </td>
                                                <td>
                                                    <?= $sub_kriteria['nama_sub_kriteria'] ?>
                                                </td>
                                                <td>
                                                    <?= $sub_kriteria['bobot'] ?>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $sub_kriteria['id']; ?>"><i class="fas fa-user-edit"></i></button>
                                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $sub_kriteria['id']; ?>"> <i class="fas fa-trash-alt"></i> </button>
                                                </td>
                                            </tr>
                                            <?php
                                            $no++;
                                            ?>
                                    </tbody>

                                    <!-- Start delete modal -->
                                    <div class="modal fade-costum" id="modalHapus<?= $sub_kriteria['id']; ?>" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Hapus Data</h5>
                                                    <button type="button" data-bs-dismiss="modal" class="btn-close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form role="form" action="" method="POST" autocomplete="off">
                                                        <?php
                                                        $id = $sub_kriteria['id'];
                                                        $edits = query_data("SELECT * FROM tbl_sub_kriteria WHERE id='$id'");
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
                                    </div>
                                    <!-- End delete modal -->

                                    <!-- Start ubah modal -->
                                    <div class="modal fade-costum" id="modalUbah<?= $sub_kriteria['id']; ?>" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Ubah Data</h5>
                                                    <button type="button" data-bs-dismiss="modal" class="btn-close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form role="form" action="" method="POST" autocomplete="off">
                                                        <?php
                                                        $id = $sub_kriteria['id'];
                                                        $edits = query_data("SELECT * FROM tbl_sub_kriteria WHERE id='$id'");
                                                        foreach ($edits as $edit) :
                                                        ?>
                                                            <input type="hidden" name="id" value="<?= $edit['id'] ?>">
                                                            <div class="form-group row mt-3">
                                                                <label class="col-3 col-form-label">Nama Sub Kriteria</label>
                                                                <div class="col">
                                                                    <input type="text" class="form-control" name="nama_sub_kriteria" value="<?= $edit['nama_sub_kriteria'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mt-3">
                                                                <label class="col-3 col-form-label">Bobot</label>
                                                                <div class="col">
                                                                    <input type="number" class="form-control" name="bobot" value="<?= $edit['bobot'] ?>">
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
                                    </div>
                                    <!-- End ubah modal -->

                                <?php
                                        endforeach;
                                ?>

                                <!-- Start tambah modal -->
                                <div class="modal modal-custom fade" id="daftar-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambah Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="#" autocomplete="off" id="daftarForm">
                                                    <div class="form-group row mt-3">
                                                        <label class="col-4 col-form-label">Nama Sub Kriteria</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control" name="nama_sub_kriteria" required placeholder="Nama Sub Kriteria">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-3">
                                                        <label class="col-4 col-form-label">Bobot</label>
                                                        <div class="col">
                                                            <input type="number" class="form-control" name="bobot" required placeholder="Inuput 1 - 4">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-3">
                                                        <label class="col-4 col-form-label">ID Kriteria</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control" name="id_kriteria" required placeholder="Input id kriteria">
                                                        </div>
                                                    </div>
                                                    <div class="text-center mt-3 mb-2">
                                                        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    if (isset($_POST['tambah'])) {
        if (tambah_data_sub_kriteria($_POST) > 0) {
            echo '
                    <script type="text/javascript">
                        swal({
                            title: "Berhasil",
                            text: "Berhasil Ditambahkan",
                            icon: "success",
                            showConfirmButton: true,
                        }).then(function(isConfirm){
                            if(isConfirm){
                                window.location.replace("sub_kriteria.php");
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
                                window.location.replace("sub_kriteria.php");
                            }
                        });
                    </script>
                ';
        }
    }
    if (isset($_POST['hapus'])) {
        if (hapus_data_sub_kriteria($_POST['id']) > 0) {
            echo '
                <script type="text/javascript">
                    swal({
                        title: "Berhasil",
                        text: "Berhasil Dihapus",
                        icon: "success",
                        showConfirmButton: true,
                    }).then(function(isConfirm){
                        if(isConfirm){
                            window.location.replace("sub_kriteria.php");
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
                            window.location.replace("sub_kriteria.php");
                        }
                    });
                </script>
            ';
        }
    }
    if (isset($_POST['ubah'])) {
        if (ubah_data_sub_kriteria($_POST) > 0) {
            echo '
                <script type="text/javascript">
                    swal({
                        title: "Berhasil",
                        text: "Berhasil Diubah",
                        icon: "success",
                        showConfirmButton: true,
                    }).then(function(isConfirm){
                        if(isConfirm){
                            window.location.replace("kriteria_karyawan.php");
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
                            window.location.replace("sub_kriteria.php");
                        }
                    });
                </script>
            ';
        }
    }
    ?>

</body>

</html>