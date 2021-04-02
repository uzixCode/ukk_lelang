<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-03-21 19:48:36 --> Severity: Error --> Call to undefined function website_config() C:\xampp\htdocs\ukk_lelang\application\views\petugas\main.php 7
ERROR - 2021-03-21 19:49:25 --> Severity: Error --> Call to undefined function website_config() C:\xampp\htdocs\ukk_lelang\application\views\petugas\main.php 7
ERROR - 2021-03-21 19:51:08 --> 404 Page Not Found: Assets/publicassets
ERROR - 2021-03-21 19:53:23 --> 404 Page Not Found: Assets/public
ERROR - 2021-03-21 20:03:02 --> Severity: Parsing Error --> syntax error, unexpected '$this' (T_VARIABLE) C:\xampp\htdocs\ukk_lelang\application\controllers\Lelang.php 35
ERROR - 2021-03-21 20:24:46 --> Severity: Parsing Error --> syntax error, unexpected '=>' (T_DOUBLE_ARROW) C:\xampp\htdocs\ukk_lelang\application\controllers\Lelang.php 33
ERROR - 2021-03-21 20:25:10 --> Severity: Notice --> Undefined variable: barang C:\xampp\htdocs\ukk_lelang\application\controllers\Lelang.php 61
ERROR - 2021-03-21 20:25:10 --> Query error: Column 'id_lelang' in where clause is ambiguous - Invalid query: SELECT `tb_masyarakat`.`nama_lengkap`, `history_lelang`.`penawaran_harga`
FROM `history_lelang`
LEFT JOIN `tb_masyarakat` ON `tb_masyarakat`.`id_user` = `history_lelang`.`id_user`
LEFT JOIN `tb_barang` ON `tb_barang`.`id_barang` = `history_lelang`.`id_barang`
LEFT JOIN `tb_lelang` ON `tb_lelang`.`id_lelang` = `history_lelang`.`id_lelang`
WHERE `tb_masyarakat`.`status` = '1'
AND `id_lelang` = '1'
AND `id_barang` IS NULL
ORDER BY `history_lelang`.`penawaran_harga` ASC
 LIMIT 10
ERROR - 2021-03-21 20:25:20 --> Query error: Column 'id_lelang' in where clause is ambiguous - Invalid query: SELECT `tb_masyarakat`.`nama_lengkap`, `history_lelang`.`penawaran_harga`
FROM `history_lelang`
LEFT JOIN `tb_masyarakat` ON `tb_masyarakat`.`id_user` = `history_lelang`.`id_user`
LEFT JOIN `tb_barang` ON `tb_barang`.`id_barang` = `history_lelang`.`id_barang`
LEFT JOIN `tb_lelang` ON `tb_lelang`.`id_lelang` = `history_lelang`.`id_lelang`
WHERE `tb_masyarakat`.`status` = '1'
AND `id_lelang` = '1'
AND `id_barang` = '3'
ORDER BY `history_lelang`.`penawaran_harga` ASC
 LIMIT 10
ERROR - 2021-03-21 20:26:05 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\ukk_lelang\application\views\public\lelang\barang.php 47
