<?php
require 'connection.php';

function tambah_data_kriteria($data)
{
    global $conn;
    $id = $data['id'];
    $nama_kriteria = $data['nama_kriteria'];
    mysqli_query($conn, "INSERT INTO tbl_kriteria VALUES('$id','$nama_kriteria')");
    return mysqli_affected_rows($conn);
}

function hapus_data_kriteria($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tbl_kriteria WHERE id='$id'");
    return mysqli_affected_rows($conn);
}

function ubah_data_kriteria($data)
{
    global $conn;
    $id = $data['id'];
    $nama_kriteria = $data['nama_kriteria'];
    return mysqli_query($conn, "UPDATE tbl_kriteria SET nama_kriteria='$nama_kriteria' WHERE id='$id'");
    // var_dump($resulst);
}
