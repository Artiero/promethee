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

function hasil_test(){
    global $conn;
    $tbl_hasils = query_data("SELECT nama_pendaftar, net_flow FROM tbl_hasil");
    $array_float = [];
    
    foreach ($tbl_hasils as $tbl_hasil) :
        $nilai_float = $tbl_hasil["net_flow"];
        $float = (float)$nilai_float;
        $nama_calon = $tbl_hasil["nama_pendaftar"];
        $array_float[] = ["net_flow" => $float, "nama_pendaftar" => $nama_calon];
    endforeach;
    
    $nilai_terbesar = null; 
    
    foreach ($array_float as $item) :
        $nama_karyawan = $item["nama_pendaftar"];
        $nilai = $item["net_flow"];

        if ($nilai_terbesar === null || $nilai > $nilai_terbesar) {
            $nama_pendaftar = $nama_karyawan;
            $nilai_terbesar = $nilai;
            // var_dump($nama_pendaftar);
        }
    endforeach;

    return [$nilai_terbesar , $nama_pendaftar];
}