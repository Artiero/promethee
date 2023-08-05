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

