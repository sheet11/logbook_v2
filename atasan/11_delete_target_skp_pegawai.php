<?php
	include "../config/koneksi.php";	
	mysql_query("delete from tb_daftar_skp where id_daftar_skp ='$_GET[id_daftar_skp]'");
	mysql_query("delete from tb_detail_skp where id_daftar_skp ='$_GET[id_daftar_skp]'");
	echo"<script>alert('Data berhasil di hapus');window.location='11_lihat_target_skp_pegawai.php?pegawai=$_GET[pegawai]&bulan=$_GET[bulan]&tahun=$_GET[tahun]'</script>";
?>
