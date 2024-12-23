<?php error_reporting(0); ?>
<?php include "session.php"; ?>
<?php
		require_once("../config/koneksi.php");
		
		$query=mysql_query("update tb_absensi set sakit= '$_POST[sakit]',
													izin= '$_POST[izin]',
													alpa= '$_POST[alpa]',
													bulan= '$_POST[bulan]'
											  		where id_absensi = '$_POST[id_absensi]'");
														
	if($query) { 
			echo "<script>alert('Data Berhasil di Update');window.location='06_daftar_absensi.php'</script>";
	} else {
		echo "<script>alert('Data Gagal di Update');window.location='06_daftar_absensi.php'</script>";
	}
?>	
