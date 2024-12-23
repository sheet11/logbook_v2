<?php error_reporting(0); ?>
<?php include "session.php"; ?>
<?php
		require_once("../config/koneksi.php");
		$pegawai = $_GET['pegawai'];
		$bulan = $_GET['bulan'];
		$tahun = $_GET['tahun'];
		
		$query=mysql_query("update tb_daftar_skp set status = 'Sudah Di Nilai', nip_penilai='$_GET[nip]'
											  		where id_daftar_skp = '$_GET[id_daftar_skp]'");
														
	if($query) { 
			echo "<script>alert('Data Berhasil di nilai');window.location='05_skp_bulanan.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
	} else {
		echo "<script>alert('Data Gagal di Update');window.location='05_skp_bulanan.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
	}
?>	
