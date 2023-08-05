<?php
require 'global.php';

function update_profile($data)
{
    // var_dump($data);
    global $conn;
    $username = $data['username'];
    $nama = $data['nama'];
    $jkel = $data['jkel'];
    $alamat = $data['alamat'];
    $pendidikan = $data['Pendidikan'];
    $pengalaman_Kerja = $data['Pengalaman_Kerja'];
    $pengalaman_Organisasi = $data['Pengalaman_Organisasi'];
    $kondisi_fisik = $data['Kondisi_Fisik'];
    $no_telpon = $data['no_telpon'];
    $berkas_lama = $data['berkas_lama'];
    if ($_FILES['berkas']['error'] === 4) {
        $file = $berkas_lama;
    } else {
        $file = upload();
        unlink("assets/$berkas_lama");
    }



    mysqli_query($conn, "UPDATE tbl_calon_karyawan SET
    nama='$nama',
    jkel='$jkel',
    alamat='$alamat',
    pendidikan=$pendidikan,
    pengalaman_kerja=$pengalaman_Kerja,
    pengalaman_organ=$pengalaman_Organisasi,
    kondisi_Fisik=$kondisi_fisik,
    no_telpon = '$no_telpon',
    berkas='$file'
    WHERE username='$username'");
    return mysqli_affected_rows($conn);
    // var_dump($result);
    // if (mysqli_error($conn)) {
    //     echo "Error: " . mysqli_error($conn);
    // }
    
}
