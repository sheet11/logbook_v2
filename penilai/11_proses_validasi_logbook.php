<?php 
	error_reporting(0); 
	include "session.php"; 
?>
<?php
	require_once("../config/koneksi.php");		
	$query=mysql_query("update tb_logbook_dosen set status = 'Sudah di Verifikasi' where id_logbook = '$_GET[logbook]'");					
	if($query) { 
			echo "<script>window.location='11_lihat_validasi_logbook.php?pegawai=$_GET[pegawai]&bulan=$_GET[bulan]&tahun=$_GET[tahun]'</script>";
		} 
	
	else {
		echo "<script>alert('Data Gagal di Verifikasi');window.location='11_lihat_validasi_logbook.php?pegawai=$_GET[pegawai]&bulan=$_GET[bulan]&tahun=$_GET[tahun]'</script>";
		}
?>