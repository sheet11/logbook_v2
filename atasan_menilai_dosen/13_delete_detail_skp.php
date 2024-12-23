<?php
	include "../config/koneksi.php";	
	mysql_query("delete from tb_detail_skp_dosen where id_detail_skp ='$_GET[id_detail_skp]'");
	echo"<script>alert('Data berhasil di hapus');window.location='13_skp_bulanan.php?bulan=$_GET[bulan]&tahun=$_GET[tahun]'</script>";
?>
