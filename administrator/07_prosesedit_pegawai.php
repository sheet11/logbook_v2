<?php error_reporting(0); 
      include "session.php"; 
?>

<?php
		require_once("../config/koneksi.php");
		
			$query=mysql_query("update tb_pegawai set level = '$_POST[level]',
													  nip_atasan = '$_POST[nip_atasan]'
											  		where id_pegawai = '$_POST[id_pegawai]'");
														
	if($query) { 
			echo "<script>alert('Data Berhasil di Update');window.location='07_daftar_pegawai.php'</script>";
	} else {
		echo "<script>alert('Data Gagal di Update');window.location='07_daftar_pegawai.php'</script>";
	}
?>	
