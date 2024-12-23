<?php
	include "../config/koneksi.php";	
	mysql_query("delete from tb_absensi where id_absensi ='$_GET[id_absensi]'");
	echo"<script>alert('Data berhasil di hapus');window.location='06_daftar_absensi.php'</script>";
?>
