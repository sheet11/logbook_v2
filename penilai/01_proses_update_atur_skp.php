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
		$query = mysql_query("INSERT INTO tb_pengaturan_skp(nip_pegawai, tanggal_pengaturan_skp,status_pengaturan_skp) VALUES('$pegawai', '$tanggal', '$status')");
		if($query) 
		{ 
			echo "<script>alert('Pengaturan SKP berhasil di atur');window.location='01_lihat_atur_skp.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
		}
		else 
		{
			echo "<script>alert('Pengaturan SKP gagal di atur');window.location='01_lihat_atur_skp.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
		}
	}
	elseif(!empty($id))
	{
		$query = mysql_query("UPDATE tb_pengaturan_skp SET status_pengaturan_skp ='$status' WHERE id_pengaturan_skp='$id'");
		if($query) 
		{ 
			echo "<script>alert('Pengaturan SKP berhasil di atur');window.location='01_lihat_atur_skp.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
		}
		else 
		{
			echo "<script>alert('Pengaturan SKP gagal di atur');window.location='01_lihat_atur_skp.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
		}
	}
	else
	{
		echo "<script>alert('Error!!!');window.location='01_lihat_atur_skp.php?pegawai=$pegawai&bulan=$bulan&tahun=$tahun'</script>";
	}
?>