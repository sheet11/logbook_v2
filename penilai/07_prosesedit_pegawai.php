<?php error_reporting(0); 
      include "session.php"; 
?>

<?php
		require_once("../config/koneksi.php");
		
			$query=mysql_query("update tb_pegawai set 
													level = '$_POST[level]',
													nip = '$_POST[nip]',
													nama_lengkap = '$_POST[nama_lengkap]',
													alamat = '$_POST[alamat]',
													no_hp = '$_POST[no_hp]',
													pangkat = '$_POST[pangkat]',
													jabatan = '$_POST[jabatan]',
													unit_kerja = '$_POST[unit_kerja]',
													nip_atasan = '$_POST[nip_atasan]'
											  		where id_pegawai = '$_POST[id_pegawai]'");
														
	if($query) { 
			echo "<script>alert('Data Berhasil di Update');window.location='07_daftar_pegawai.php'</script>";
	} else {
		echo "<script>alert('Data Gagal di Update');window.location='07_daftar_pegawai.php'</script>";
	}
?>	
