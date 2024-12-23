<?php 
	error_reporting(0); 
    include "session.php"; 
?>

<?php
		require_once("../config/koneksi.php");
		$bulan = $_GET['bulan'];
		$tahun = $_GET['tahun'];
		$pegawai = $_GET['pegawai'];
		
		$query=mysql_query("update tb_logbook set status = 'Dinilai' where id_logbook = '$_GET[logbook]'");
														
	if($query) { 
			echo "<script>window.location='10_lihat_validasi_logbook.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
	} else {
		echo "<script>alert('Data Gagal Dinilai');window.location='10_lihat_validasi_logbook.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
	}
?>