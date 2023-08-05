<?php
require 'connection.php';

function tambah_data_sub_kriteria($data)
{
    // var_dump($data);
    global $conn;
    $nama_sub_kriteria = $data['nama_sub_kriteria'];
    $bobot = $data['bobot'];
    $id_kriteria = $data['id_kriteria'];
    mysqli_query($conn, "INSERT INTO tbl_sub_kriteria VALUES
    (NULL,
    '$nama_sub_kriteria',
    $bobot,
    '$id_kriteria'
    )");
    // var_dump($resulst);
    return mysqli_affected_rows($conn);
}

function hapus_data_sub_kriteria($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tbl_sub_kriteria WHERE id='$id'");
    return mysqli_affected_rows($conn);
}

function ubah_data_sub_kriteria($data)
{
    // var_dump($data);
    global $conn;
    $id = $data['id'];
    $nama_sub_kriteria = $data['nama_sub_kriteria'];
    $bobot = $data['bobot'];
    return  mysqli_query($conn, "UPDATE tbl_sub_kriteria SET 
    nama_sub_kriteria='$nama_sub_kriteria',
    bobot = $bobot
    WHERE id='$id'");
    // var_dump($result);
}
