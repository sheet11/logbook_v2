<?php 
	error_reporting(0); 
 	include "session.php"; 
 	$bulan = $_GET['bulan'];
	$tahun = $_GET['tahun'];
 ?>
<?php
		require_once("../config/koneksi.php");		
		$query=mysql_query("update tb_logbook set status = 'Belum di Nilai',
													keterangan_status = ''
											  		where id_logbook = '$_POST[id_logbook]'");
														
	if($query) { 
			echo "<script>alert('Data Berhasil di Update');window.location='04_logbook_bulanan.php?bulan=$bulan&tahun=$tahun'</script>";
	} 
	else {
		echo "<script>alert('Data Gagal di Update');window.location='04_logbook_bulanan.php?bulan=$bulan&tahun=$tahun'</script>";
	}
?>	
