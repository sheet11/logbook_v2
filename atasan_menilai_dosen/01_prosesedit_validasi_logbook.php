<?php error_reporting(0); ?>
<?php include "session.php"; ?>
<?php
		require_once("../config/koneksi.php");
		
		$query=mysql_query("update tb_logbook set status_atasan = '$_POST[status_atasan]', keterangan_atasan='$_POST[keterangan_atasan]'
											  		where id_logbook = '$_POST[idlogbook]'");
														
	if($query) { 
			echo "<script>alert('Data Berhasil di Verifikasi');window.location='01_validasi_logbook.php'</script>";
	} else {
		echo "<script>alert('Data Gagal di Verifikasi');window.location='01_validasi_logbook.php'</script>";
	}
?>