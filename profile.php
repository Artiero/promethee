<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
require './function/function_profile.php';
$username = $_SESSION['username'];
$profiles = query_data("SELECT*FROM tbl_calon_karyawan WHERE username='$username'");
$kriterias = query_data(" SELECT * FROM tbl_kriteria ");
// var_dump($bobot_kriteria);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php
    require 'views/link.php';
    ?>

</head>

<title>Profile Calon Karyawan</title>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        $page = 2;
        require 'views/sidebar.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                require 'views/navbar.php';
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 text-center">Profile</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 py-4 px-5">
                        <?php
                        foreach ($profiles as $profile) :
                        ?>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row mt-3">
                                            <label class="col-2 col-form-label">Name</label>
                                            <div class="col">
                                                <input type="hidden" name="username" value="<?= $profile['username'] ?>">
                                                <input type="hidden" name="berkas_lama" value="<?= $profile['berkas'] ?>">
                                                
                                                <input type="text" name="nama" value="<?= $profile['nama'] ?>" class="form-control" placeholder="Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row mt-3">
                                            <label class="col-2 col-form-label">Gender</label>
                                            <div class="col">
                                                <select name="jkel" class="form-control">
                                                    <option selected><?= $profile['jkel'] ?></option>
                                                    <?php
                                                    if ($profile['jkel'] == 'Laki-laki') {
                                                    ?>
                                                        <option value=Perempuan>Perempuan</option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="Laki-Laki">Laki-laki</option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row mt-3">
                                            <label class="col-2 col-form-label">Alamat</label>
                                            <div class="col">
                                                <textarea name="alamat" class="form-control" cols="30" rows="3" placeholder="About yourself"><?= $profile['alamat'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                foreach ($kriterias as $kriteria) :
                                ?>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row mt-3">
                                                <label class="col-2 col-form-label"><?= $kriteria['nama_kriteria'] ?></label>
                                                <div class="col">
                                                    <select name="<?= $kriteria['nama_kriteria'] ?>" class="form-control">
                                                        <option selected>--Pilih--</option>
                                                        <?php
                                                        $id_kriteria = $kriteria['id'];
                                                        $sub_kriterias = query_data(" SELECT tbl_kriteria.nama_kriteria,
                                                        tbl_sub_kriteria.nama_sub_kriteria,
                                                        tbl_sub_kriteria.bobot
                                                        FROM tbl_kriteria INNER JOIN tbl_sub_kriteria
                                                        ON tbl_sub_kriteria.id_kriteria = tbl_kriteria.id WHERE tbl_kriteria.id= '$id_kriteria' ");

                                                        foreach ($sub_kriterias as $sub_kriteria) :
                                                        ?>
                                                            <option value="<?= $sub_kriteria['bobot'] ?>"><?= $sub_kriteria['nama_sub_kriteria'] ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row mt-3">
                                            <label class="col-2 col-form-label">No Telpon</label>
                                            <div class="col">
                                                <input type="number" name="no_telpon" value="<?= $profile['no_telpon'] ?>" class="form-control" placeholder="+62817271xxxx">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row mt-3">
                                            <label class="col-2 col-form-label">Masukan Berkas</label>
                                            <div class="col-4 col-form-label">
                                                <input type="file" name="berkas" class="form-control" id="inputGroupFile02">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center my-3">
                                    <button class="btn btn-info" type="submit" name="ubah">Update Profile</button>
                                </div>
                            </form>
                        <?php
                        endforeach;
                        ?>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            require 'views/footer.php';
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php
    require 'views/modalLogout.php';
    require 'views/script.php';
    if (isset($_POST['ubah'])) {
        // var_dump($_POST);
        if (update_profile($_POST) > 0) {
            echo '
                <script type="text/javascript">
                    swal({
                        title: "Berhasil",
                        text: "Berhasil Diubah",
                        icon: "success",
                        showConfirmButton: true,
                    }).then(function(isConfirm){
                        if(isConfirm){
                            window.location.replace("profile.php");
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
                            window.location.replace("profile.php");
                        }
                    });
                </script>
            ';
        }
    }
    ?>



</body>

</html>