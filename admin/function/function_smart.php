<?php

require 'connection.php';

function smart($data)
{
    global $conn;
    $c_max = 1;
    $c_min = 0.4;
    $b = $c_max - $c_min;

    // Array untuk menyimpan hasil normalisasi
    $normalized_data = [];

    foreach ($data as $nilai) :
        $username = $nilai['username'];
        $nama_pendaftar = $nilai['nama'];
        $normalisasi_pendidkan = $nilai['pendidikan'];
        $normalisasi_organ = $nilai['pengalaman_organ'];
        $normalisasi_kerja = $nilai['pengalaman_kerja'];
        $normalisasi_fisik = $nilai['kondisi_fisik'];

        // Ambil data normalisasi dari database
        $nomalisasis = query_data("SELECT * FROM tbl_calon_karyawan WHERE username='$username'");
        foreach ($nomalisasis as $nomalisasi) :
            $pendidikan = $nomalisasi['pendidikan'] / 100;
            $organisaisi = $nomalisasi['pengalaman_organ'] / 100;
            $kerja = $nomalisasi['pengalaman_kerja'] / 100;
            $fisik = $nomalisasi['kondisi_fisik'] / 100;

            // Simpan hasil normalisasi dalam array
            $normalized_data[] = [
                'username' => $username,
                'nama_pendaftar' => $nama_pendaftar,
                'pendidikan' => $pendidikan,
                'pengalaman_organ' => $organisaisi,
                'pengalaman_kerja' => $kerja,
                'kondisi_fisik' => $fisik
            ];
        endforeach;
    endforeach;

    //Normaalisasi nilai kriteria
    $nilai_kriteria = [];
    $data_kriteria = query_data("SELECT bobot FROM tbl_kriteria");
    foreach ($data_kriteria as $normalisasi) :
        $nilai_normalisasi = $normalisasi['bobot'] / 100;
        $nilai_kriteria[] = [
            'bobot' => $nilai_normalisasi
        ];
    endforeach;

    $a = [];
    foreach ($normalized_data as $nilai) :
        $nilai_pendidikan = 1 - $nilai['pendidikan'];
        $nilai_organ = 1 - $nilai['pengalaman_organ'];
        $nilai_kerja = 1 - $nilai['pengalaman_kerja'];
        $nilai_fisik = 1 - $nilai['kondisi_fisik'];

        $a[] = [
            'pendidikan' => $nilai_pendidikan,
            'pengalaman_organ' => $nilai_organ,
            'pengalaman_kerja' => $nilai_kerja,
            'kondisi_fisik' => $nilai_fisik
        ];
    endforeach;

    $nilai_utility = [];
    foreach ($a as $utility) :
        $utility_pendidikan = $utility['pendidikan'] / $b;
        $utility_organ = $utility['pengalaman_organ'] / $b;
        $utility_kerja = $utility['pengalaman_kerja'] / $b;
        $utility_fisik = $utility['kondisi_fisik'] / $b;

        $nilai_utility[] = [
            'pendidikan' => $utility_pendidikan,
            'pengalaman_organ' => $utility_organ,
            'pengalaman_kerja' => $utility_kerja,
            'kondisi_fisik' => $utility_fisik
        ];
    endforeach;

    $hasil_akhir = [];
    foreach ($normalized_data as $index => $nilai) {
        $username = $nilai['username'];
        $nama_pendaftar = $nilai['nama_pendaftar'];
        $skor_akhir = (
            ($nilai_utility[$index]['pendidikan'] * $nilai_kriteria[0]['bobot']) +
            ($nilai_utility[$index]['pengalaman_organ'] * $nilai_kriteria[2]['bobot']) +
            ($nilai_utility[$index]['pengalaman_kerja'] * $nilai_kriteria[1]['bobot']) +
            ($nilai_utility[$index]['kondisi_fisik'] * $nilai_kriteria[3]['bobot'])
        );

        $hasil_akhir[] = [
            'username' => $username,
            'nama_pendaftar' => $nama_pendaftar,
            'hasil' => $skor_akhir
        ];
    }

    foreach ($hasil_akhir as $hasil) :
        $hasils = query_data("SELECT*FROM tbl_hasil_smart");
        $rows = count($hasils);
        if ($rows >= 5) {
            break;
        } else {
            $username = $hasil['username'];
            $nama_pendaftar = $hasil['nama_pendaftar'];
            $skor_akhir = $hasil['hasil'];

            $query = "INSERT INTO tbl_hasil_smart VALUES (NULL,'$username', '$nama_pendaftar', '$skor_akhir')";
            mysqli_query($conn, $query);
            if (mysqli_error($conn)) {
                echo "Error: " . mysqli_error($conn);
            }
        }
        
    endforeach;
    // var_dump($hasil);
    function hapus_data_hasil_smart()
    {
        global $conn;
        mysqli_query($conn, "DELETE FROM tbl_hasil_smart");
        return mysqli_affected_rows($conn);
        if (mysqli_error($conn)) {
            echo "Error: " . mysqli_error($conn);
        }
    }
    
}
