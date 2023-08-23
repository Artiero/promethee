-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE `tbl_admin` (
  `username` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_admin` (`username`, `nama`, `password`) VALUES
('silvi',	'Silvi',	'$2y$10$eGCXGpeLhPipstcdZUeGa.IWMLA4brAnk3kDwRBBxfkkl98NoSKmS'),
('tasya',	'Tasya',	'$2y$10$a5v8UsetP3tjCPHpUaykie.Nm3OMnmWWGEUUzx.z.W1hddoaRJ5Wm');

DROP TABLE IF EXISTS `tbl_calon_karyawan`;
CREATE TABLE `tbl_calon_karyawan` (
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jkel` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `pendidikan` varchar(50) NOT NULL,
  `pengalaman_organ` varchar(50) NOT NULL,
  `pengalaman_kerja` varchar(50) NOT NULL,
  `kondisi_fisik` varchar(50) NOT NULL,
  `berkas` varchar(50) NOT NULL,
  `no_telpon` varchar(200) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_calon_karyawan` (`username`, `password`, `nama`, `jkel`, `alamat`, `pendidikan`, `pengalaman_organ`, `pengalaman_kerja`, `kondisi_fisik`, `berkas`, `no_telpon`) VALUES
('iva',	'$2y$10$9Qr9TG4Oqa.74KXJk6PvQ.NUFwI/dygoeWs.asHM6pOoOKTpofouq',	'Atanasius Alan',	'Laki-laki',	'Jln Biring Romang No 4',	'1',	'1',	'4',	'4',	'64c12aac513ec.pdf',	'0854475244'),
('lius',	'$2y$10$In4hntJdwpwj.hPs4Ij2Zu7uc9IAJuRJrWGvlwlQ4W0rDQtihoP3W',	'Lina Kurnia Sari',	'Perempuan',	'Jl. Urip Sumoharjo No 12',	'4',	'4',	'1',	'3',	'64c12b41593f2.pdf',	'0853974473432'),
('yohan',	'$2y$10$JHwfJ01sjGrRtVBELdtkLOfxnRfgDbghIWHRkQl.9udYDRtMuhbYy',	'Tomy Adam',	'Laki-laki',	'Jln Knacil No 12',	'2',	'4',	'3',	'2',	'64c12b8b588fb.pdf',	'08524585455'),
('zul',	'$2y$10$CKCu5/wjROgQx52ABgNuIOYXrVW8pETTxa8f0vnV1T0Jblfa9kq1S',	'Azizul Hasan',	'Laki-laki',	'Jl Bung No 5',	'3',	'4',	'2',	'4',	'64c12af81c770.pdf',	'0852347585443');

DROP TABLE IF EXISTS `tbl_hasil`;
CREATE TABLE `tbl_hasil` (
  `id_hasil` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `nama_pendaftar` varchar(100) NOT NULL,
  `leaving_flow` varchar(100) NOT NULL,
  `entering_flow` varchar(100) NOT NULL,
  `net_flow` varchar(100) NOT NULL,
  PRIMARY KEY (`id_hasil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_hasil` (`id_hasil`, `username`, `nama_pendaftar`, `leaving_flow`, `entering_flow`, `net_flow`) VALUES
(249,	'iva',	'Atanasius Alan',	'0.41666666666667',	'0.5',	'0.083333333333333'),
(250,	'lius',	'Lina Kurnia Sari',	'0.41666666666667',	'0.41666666666667',	'0'),
(251,	'yohan',	'Tomy Adam',	'0.33333333333333',	'0.5',	'0.16666666666667'),
(252,	'zul',	'Azizul Hasan',	'0.5',	'0.25',	'-0.25');

DROP TABLE IF EXISTS `tbl_kriteria`;
CREATE TABLE `tbl_kriteria` (
  `id` varchar(20) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_kriteria` (`id`, `nama_kriteria`) VALUES
('A10',	'Pendidikan'),
('A11',	'Pengalaman Kerja'),
('A12',	'Pengalaman Organisasi'),
('A13',	'Kondisi Fisik');

DROP TABLE IF EXISTS `tbl_sub_kriteria`;
CREATE TABLE `tbl_sub_kriteria` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nama_sub_kriteria` varchar(50) NOT NULL,
  `bobot` int(11) NOT NULL,
  `id_kriteria` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kriteria` (`id_kriteria`),
  CONSTRAINT `tbl_sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `tbl_kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_sub_kriteria` (`id`, `nama_sub_kriteria`, `bobot`, `id_kriteria`) VALUES
(15,	'D4',	4,	'A10'),
(16,	'S1',	3,	'A10'),
(17,	'D3',	2,	'A10'),
(18,	'D2',	1,	'A10'),
(21,	'Lebih dari 2 Tahun',	4,	'A11'),
(22,	'Lebih dari 1 Tahun',	3,	'A11'),
(23,	'Kurang dari 1 Tahun',	2,	'A11'),
(24,	'FresGraduated',	1,	'A11'),
(25,	'Pernah Menjabat Pengurus Inti',	4,	'A12'),
(26,	'Pernah Menjadbat Koordinator',	3,	'A12'),
(27,	'Pernah terlibat aktif kegiatan organisasi',	2,	'A12'),
(28,	'Simpatisan',	1,	'A12'),
(29,	'Sangat Baik',	4,	'A13'),
(30,	'Baik',	3,	'A13'),
(31,	'Cukup',	2,	'A13'),
(32,	'Kurang Baik',	1,	'A13');

-- 2023-08-23 12:56:14
