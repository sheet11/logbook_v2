<?php 
	error_reporting(0); 
 	include "session.php"; 
 ?>
<?php
		require_once("../config/koneksi.php");		
		$query=mysql_query("update tb_logbook_dosen set status_atasan = 'Belum di Verifikasi',
													keterangan_atasan = ''
											  		where id_logbook = '$_POST[id_logbook]'");														
	if($query) 
		{ 
			echo "<script>alert('Data Berhasil di Update');window.location='04_logbook_bulanan.php'</script>";
		} 

	else 
		{
			echo "<script>alert('Data Gagal di Update');window.location='04_logbook_bulanan.php'</script>";
		}
?>	
