<?php
	include "../config/koneksi.php";	
	mysql_query("delete from tb_daftar_skp_dosen where id_daftar_skp ='$_GET[id_daftar_skp]'");
	mysql_query("delete from tb_detail_skp_dosen where id_daftar_skp ='$_GET[id_daftar_skp]'");
	echo"<script>alert('Data berhasil di hapus');window.location='13_skp_bulanan.php?bulan=$_GET[bulan]&tahun=$_GET[tahun]'</script>";
?>