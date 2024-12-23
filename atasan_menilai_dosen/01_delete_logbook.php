<?php
	include "../config/koneksi.php";	
	mysql_query("delete from tb_logbook where id_logbook ='$_GET[id_logbook]'");
	echo"<script>alert('Data berhasil di hapus');window.location='01_logbook.php'</script>";
?>
