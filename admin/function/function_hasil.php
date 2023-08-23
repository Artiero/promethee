<?php
require 'connection.php';

function hasil($data)
{

    global $conn;
    $jumlah_baris = count($data);
    $nama_pendaftar = [];
    $username_pendaftar = [];
    $nilai_leavingFlow = [];
    $nilai_enteringFlow = [];
    $nilai_netFlow = [];
    foreach ($data as $index) :
        $username = $index['username'];
        $username_pendaftar[] = $username;

        $nama = $index['nama'];
        $nama_pendaftar[] = $nama;

        $pendidikan = $index['pendidikan'];
        $pengalaman_organ = $index['pengalaman_organ'];
        $pengalaman_kerja = $index['pengalaman_kerja'];
        $kondisi_fisik = $index['kondisi_fisik'];
        $Indeks_Leaving_FLow = 0;
        $Indeks_Entering_FLow = 0;

        $index_multikriterias = query_data(" SELECT*FROM tbl_calon_karyawan WHERE username != '$username' ");
        foreach ($index_multikriterias as $index_multikriteria) :

            if (intval($pendidikan) > intval($index_multikriteria['pendidikan'])) {
                $Indeks_Leaving_FLow++;
            } elseif (intval($index_multikriteria['pendidikan']) > intval($pendidikan)) {
            } else {
            }

            if (intval($pengalaman_organ) > intval($index_multikriteria['pengalaman_organ'])) {
                $Indeks_Leaving_FLow++;
            } elseif (intval($index_multikriteria['pengalaman_organ']) > intval($pengalaman_organ)) {
            } else {
            }

            if (intval($pengalaman_kerja) > intval($index_multikriteria['pengalaman_kerja'])) {
                $Indeks_Leaving_FLow++;
            } elseif (intval($index_multikriteria['pengalaman_kerja']) > intval($pengalaman_kerja)) {
            } else {
            }

            if (intval($kondisi_fisik) > intval($index_multikriteria['kondisi_fisik'])) {
                $Indeks_Leaving_FLow++;
            } elseif (intval($index_multikriteria['kondisi_fisik']) > intval($kondisi_fisik)) {
            } else {
            }

        endforeach;

        $index_multikriterias = query_data(" SELECT*FROM tbl_calon_karyawan WHERE username != '$username' ");
        foreach ($index_multikriterias as $index_multikriteria) :

            if (intval($pendidikan) < intval($index_multikriteria['pendidikan'])) {
                $Indeks_Entering_FLow++;
            } elseif (intval($index_multikriteria['pendidikan']) < intval($pendidikan)) {
            } else {
            }

            if (intval($pengalaman_organ) < intval($index_multikriteria['pengalaman_organ'])) {
                $Indeks_Entering_FLow++;
            } elseif (intval($index_multikriteria['pengalaman_organ']) < intval($pengalaman_organ)) {
            } else {
            }

            if (intval($pengalaman_kerja) < intval($index_multikriteria['pengalaman_kerja'])) {
                $Indeks_Entering_FLow++;
            } elseif (intval($index_multikriteria['pengalaman_kerja']) < intval($pengalaman_kerja)) {
            } else {
            }

            if (intval($kondisi_fisik) < intval($index_multikriteria['kondisi_fisik'])) {
                $Indeks_Entering_FLow++;
            } elseif (intval($index_multikriteria['kondisi_fisik']) < intval($kondisi_fisik)) {
            } else {
            }


        endforeach;

        $Leaving_Flow = ($Indeks_Leaving_FLow / 4) * 1 / 3;
        $nilai_leavingFlow[] = $Leaving_Flow;

        $Entering_Flow = ($Indeks_Entering_FLow / 4) * 1 / 3;
        $nilai_enteringFlow[] = $Entering_Flow;

        $Net_Flow = $Entering_Flow - $Leaving_Flow;
        $nilai_netFlow[] = $Net_Flow;

        $hasil = query_data("SELECT*FROM tbl_hasil");
        // var_dump($hasil);
        $rows = count($hasil);

        if ($rows >= $jumlah_baris) {
            break;
        } else {

            mysqli_query($conn, "INSERT INTO tbl_hasil VALUES 
            (NULL,
            '$username',
            '$nama',
            '$Leaving_Flow',
            '$Entering_Flow',
            '$Net_Flow'
            )");
            $result = mysqli_affected_rows($conn);
            if (mysqli_error($conn)) {
                echo "Error: " . mysqli_error($conn);
            }
        }



    endforeach;
}

function hapus_data_hasil()
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tbl_hasil");
    return mysqli_affected_rows($conn);
    if (mysqli_error($conn)) {
        echo "Error: " . mysqli_error($conn);
    }
}
