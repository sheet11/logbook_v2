<?php error_reporting(0); ?>
<?php include "session.php"; ?>
<?php
		require_once("../config/koneksi.php");
		$pegawai = $_GET['pegawai'];
		$bulan = $_GET['bulan'];
		$tahun = $_GET['tahun'];
		$penilai = $_GET['nip'];
		
		$query=mysql_query("update tb_absensi set status = 'Sudah Di Verifikasi', nip_penilai ='$penilai' 
											  		where id_absensi = '$_GET[id_absensi]'");
														
	if($query) { 
			echo "<script>alert('Data Berhasil di verifikasi');window.location='06_absensi_bulanan.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
	} else {
		echo "<script>alert('Data Gagal di verifikasi');window.location='06_absensi_bulanan.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
	}
?>	
