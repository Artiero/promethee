<?php
session_start();
require './function/functuion_login.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Admin</title>

    <?php
    require 'views/link.php';
    ?>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login Admin</h1>
                                    </div>
                                    <form class="user" action="" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" placeholder="Enter Username..." name="username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                                        </div>
                                        <button name="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="../login.php">Login Pendaftar</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login_pimpinan.php">Login Pimpinan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php
    require 'views/script.php';
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        if (login($_POST) === true) {
            $_SESSION['username'] = $username;
            echo '
                    <script type="text/javascript">
                        swal({
                            title: "Berhasil",
                            text: "Berhasil Login",
                            icon: "success",
                            showConfirmButton: true,
                        }).then(function(isConfirm){
                            if(isConfirm){
                                window.location.replace("index.php");
                            }
                        });
                    </script>
                ';
        } else {
            echo '
                    <script type="text/javascript">
                        swal({
                            title: "Gagal",
                            text: "Gagal Login",
                            icon: "error",
                            showConfirmButton: true,
                        }).then(function(isConfirm){
                            if(isConfirm){
                                window.location.replace("login.php");
                            }
                        });
                    </script>
                ';
        }
    }
    ?>

</body>

</html>