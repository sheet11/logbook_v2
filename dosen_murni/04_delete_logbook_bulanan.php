<?php
	include "../config/koneksi.php";
	$bulan = $_GET['bulan'];
	$tahun = $_GET['tahun'];
	mysql_query("delete from tb_logbook_dosen where id_logbook ='$_GET[id_logbook]'");
	echo"<script>alert('Data berhasil di hapus');window.location='04_logbook_bulanan.php?bulan=$bulan&tahun=$tahun'</script>";
?>
