<?php
require 'connection.php';

function query_data($data)
{
    global $conn;
    $result = mysqli_query($conn, $data);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function total_pendaftar(){
    global $conn;
    $cekData = mysqli_query($conn," SELECT * FROM tbl_calon_karyawan");
    $resultData = mysqli_num_rows($cekData);

    return $resultData;
}

function total_admin(){
    global $conn;
    $cekData = mysqli_query($conn," SELECT * FROM tbl_admin");
    $resultData = mysqli_num_rows($cekData);

    return $resultData;
}