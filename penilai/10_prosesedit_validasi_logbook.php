<?php 
	error_reporting(0);
 	include "session.php"; 
 ?>

<?php
		require_once("../config/koneksi.php");
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
		$pegawai = $_POST['pegawai'];	
		$query=mysql_query("update tb_logbook set keterangan_status = '$_POST[keterangan_status]',
													status= 'Dikembalikan'
											  		where id_logbook = '$_POST[id_logbook]'");
														
	if($query) { 
			echo "<script>window.location='10_lihat_validasi_logbook.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
	} else {
		echo "<script>alert('Data Gagal di Update');window.location='10_lihat_validasi_logbook.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
	}
?>	
