<?php
	include "../config/koneksi.php";	
	$tanggal = $_GET['tanggal_awal'];
	mysql_query("delete from tb_logbook where id_logbook ='$_GET[id_logbook]'");
	echo"<script>alert('Data berhasil di hapus');window.location='02_logbook_harian.php?tanggal_awal=$tanggal'</script>";
?>
