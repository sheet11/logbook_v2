<?php 
	error_reporting(0); 
 	include "session.php"; 
 ?>
<?php
		require_once("../config/koneksi.php");
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
		$query=mysql_query("update tb_logbook set status = 'Belum di Nilai',
													keterangan_status = ''
											  		where id_logbook = '$_POST[id_logbook]'");
														
	if($query) { 
			echo "<script>alert('Data Berhasil di Update');window.location='04_logbook_bulanan.php?&bulan=$_POST[bulan]&tahun=$_POST[tahun]'</script>";
	} 
	else {
		echo "<script>alert('Data Gagal di Update');window.location='04_logbook_bulanan.php?&bulan=$_POST[bulan]&tahun=$_POST[tahun]'</script>";
	}
?>	
