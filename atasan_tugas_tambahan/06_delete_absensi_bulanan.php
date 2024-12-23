<?php
	include "../config/koneksi.php";
	$bulan = $_GET['bulan'];
	$tahun = $_GET['tahun'];
	$pegawai = $_GET['pegawai'];
	mysql_query("delete from tb_absensi where id_absensi ='$_GET[id_absensi]'");
	echo"<script>alert('Data berhasil di hapus');window.location='06_absensi_bulanan.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
?>
