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

function upload()
{
    $namaFile = $_FILES['berkas']['name'];
    $ukuranFile = $_FILES['berkas']['size'];
    $error = $_FILES['berkas']['error'];
    $tmpName = $_FILES['berkas']['tmp_name'];
    // cek jika tidak ada gambar diupload

    if ($error === 4) {
        echo "
            <script>
                alert('Masukkan file');
            </script>
            ";
        return false;
    }
    if ($ukuranFile > 5000000) {
        echo "
            <script>
                alert('Tidak lebih dari 3mb');
            </script>
            ";
        return false;
    }
    // cek yang boleh diupload
    $ekstensiFileValid = ['docx', 'xlsx', 'pdf', 'pptx'];
    $ekstensiFile = explode('.', $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));
    if (!in_array($ekstensiFile, $ekstensiFileValid)) {
        echo "
            <script>
                alert('Upload file berekstensi docx, xlsx, pdf atau pptx');
            </script>
            ";
        return false;
    }
    // lolos pengecekan
    //generate
    $namaFileBaru = uniqid();
    // 8sdfi989898
    $namaFileBaru .= '.';
    // 8sdfi989898.
    $namaFileBaru .= $ekstensiFile;
    // 8sdfi989898.docx
    move_uploaded_file($tmpName, './assets/' . $namaFileBaru);
    return $namaFileBaru;
}

function hasil_test_karyawan(){
    global $conn;
    $tbl_hasils = query_data("SELECT nama_pendaftar, net_flow FROM tbl_hasil");
    $array_float = [];
    
    foreach ($tbl_hasils as $tbl_hasil) :
        $nilai_float = $tbl_hasil["net_flow"];
        $float = (float)$nilai_float;
        $nama_calon = $tbl_hasil["nama_pendaftar"];
        $nama = $nama_calon;
        $array_float[] = ["net_flow" => $float, "nama_pendaftar" => $nama];
    endforeach;
    
    $nilai_terbesar = null;
    
    foreach ($array_float as $item) :
        $nilai = $item["net_flow"];
        $nama_karyawan = $item["nama_pendaftar"];

        if ($nilai_terbesar === null || $nilai > $nilai_terbesar) {
            $nilai_terbesar = $nilai;
            $nama_pendaftar = $nama_karyawan;
            // var_dump($nama_pendaftar);
        }
    endforeach;
    
    // Cetak nilai terbesar setelah perulangan selesai
    return [$nilai_terbesar,$nama_pendaftar];
}

