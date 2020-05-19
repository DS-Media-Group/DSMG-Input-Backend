<?php
include 'koneksi.php';

$kode = $_POST['kode'];

$query = "DELETE FROM tbl_mahasiswa WHERE kode=?";
$dewan1 = $db1->prepare($query);
$dewan1->bind_param("i", $kode);
$dewan1->execute();

$db1->close();
?>