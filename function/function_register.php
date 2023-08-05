<?php
require 'connection.php';

function register($data)
{
    

    global $conn;
    $username = $data['username'];
    $password = $data['password'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $nama = $data['nama'];
    $jkel = $data['jkel'];
    $alamat = $data['alamat'];
    $nomor_telpon = $data['no_telpon'];
    // var_dump($nomor_telpon);

    mysqli_query($conn, "INSERT INTO tbl_calon_karyawan VALUES
    ('$username',
    '$hash_password',
    '$nama',
    '$jkel',
    '$alamat',
    '',
    '',
    '',
    '',
    '',
    '$nomor_telpon'
    )");
    return mysqli_affected_rows($conn);
    // var_dump($result);
    // if (mysqli_error($conn)) {
    //     echo "Error: " . mysqli_error($conn);
    // }
}
