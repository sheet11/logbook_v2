<?php error_reporting(0); 
include "session.php"; ?>
<?php
		require_once("../config/koneksi.php");
		
			$query=mysql_query("update tb_pegawai set 	grade = '$_POST[grade]',
														p2 = '$_POST[p2]',
														nama_bank = '$_POST[nama_bank]',
														atas_nama = '$_POST[atas_nama]',
														no_rekening = '$_POST[no_rekening]'
											  		where id_pegawai = '$_POST[id_pegawai]'");
														
	if($query) { 
			echo "<script>alert('Data Berhasil di Update');window.location='07_daftar_pegawai.php'</script>";
	} else {
		echo "<script>alert('Data Gagal di Update');window.location='07_daftar_pegawai.php'</script>";
	}
?>	
