<?php 
	error_reporting(0);
 	include "session.php"; 
 ?>

<?php
	require_once("../config/koneksi.php");
	$bulan = $_POST['bulan'];
	$tahun = $_POST['tahun'];
	$tanggal = $_POST['tahun'].'-'.$_POST['bulan'].'-01';
	$pegawai = $_POST['pegawai'];
	$id = $_POST['id'];
	$status = $_POST['status'];
	if(empty($id))
	{
		$query = mysql_query("INSERT INTO tb_pengaturan_logbook(nip_pegawai, tanggal_pengaturan_logbook,status_pengaturan_logbook) VALUES('$pegawai', '$tanggal', '$status')");
		if($query) 
		{ 
			echo "<script>alert('Pengaturan Logbook berhasil di atur');window.location='10_verifikasi_logbook_pegawai.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
		}
		else 
		{
			echo "<script>alert('Pengaturan Logbook gagal di atur');window.location='10_verifikasi_logbook_pegawai.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
		}
	}
	elseif(!empty($id))
	{
		$query = mysql_query("UPDATE tb_pengaturan_logbook SET status_pengaturan_logbook ='$status' WHERE id_pengaturan_logbook='$id'");
		if($query) 
		{ 
			echo "<script>alert('Pengaturan Logbook berhasil di atur');window.location='10_verifikasi_logbook_pegawai.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
		}
		else 
		{
			echo "<script>alert('Pengaturan Logbook gagal di atur');window.location='10_verifikasi_logbook_pegawai.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
		}
	}
	else
	{
		echo "<script>alert('Error!!!');window.location='10_verifikasi_logbook_pegawai.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
	}
?>