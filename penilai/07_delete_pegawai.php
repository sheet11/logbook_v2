<?php
	include "../config/koneksi.php";	
	mysql_query("delete from tb_pegawai where id_pegawai ='$_GET[id_pegawai]'");
	echo"<script>alert('Data berhasil di hapus');window.location='07_daftar_pegawai.php'</script>";
?>
