<?php
	include "../config/koneksi.php";	
	mysql_query("delete from tb_hitungan where id_hitungan ='$_GET[id_perhitungan]'");
	echo"<script>alert('Data berhasil di hapus');window.location='09_daftar_perhitungan.php'</script>";
?>
