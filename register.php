<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <?php
    require './views/link.php';
    require './function/function_register.php'
    ?>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form action="" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm mb-3 mb-sm-0">
                                        <input type="text" class="form-control" name="username" placeholder="Input Username">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm mb-3 mb-sm-0">
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="" name="nama" placeholder="Nama Lengkap">
                                </div>
                                <div class="form-group">
                                    <select name="jkel" class="form-control ">
                                        <option selected>Gender</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <textarea name="alamat" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="no_telpon" placeholder="No Telpon">
                                </div>
                                <button type="submit" name="tambah" class="btn btn-primary btn-user btn-block">Create Account</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <?php
    require 'views/script.php';

    if (isset($_POST['tambah'])) {
        // var_dump($_POST);
        if (register($_POST) > 0) {
            echo '
            <script type="text/javascript">
            swal({
                title: "Berhasil",
                text: "Berhasil Register",
                icon: "success",
                showConfirmButton: true,
            }).then(function(isConfirm){
                if(isConfirm){
                    window.location.replace("login.php");
                }
            });
        </script>
        ';
        } else {
            echo '
            <script type="text/javascript">
            swal({
                title: "Gagal",
                text: "Gagal Register",
                icon: "error",
                showConfirmButton: true,
            }).then(function(isConfirm){
                if(isConfirm){
                    window.location.replace("register.php");
                }
            });
        </script>
        ';
        }
    }
    ?>


</body>

</html>