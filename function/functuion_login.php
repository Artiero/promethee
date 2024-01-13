<?php
require 'connection.php';
function login($data)
{
    global $conn;
    $username = $data['username'];
    $password = $data['password'];
    // var_dump($tanggalTertentu);
    // Perintah query sql
    $query = "SELECT * FROM tbl_calon_karyawan WHERE username='$username'";
    $get = mysqli_query($conn, $query);
    // Mengambil jumlah baris
    $result = mysqli_num_rows($get);
    // Mengambil data
    $row_admin = mysqli_fetch_assoc($get);
        if ($result === 1) {
            if (password_verify($password, $row_admin['password'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
