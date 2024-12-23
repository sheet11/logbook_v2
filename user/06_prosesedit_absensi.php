<?php error_reporting(0); ?>
<?php include "session.php"; ?>
<?php
		require_once("../config/koneksi.php");
		
		$query=mysql_query("update tb_absensi set `tanggal`='$_POST[tanggal_absensi]',
		`terlambatsatu` = '$_POST[terlambat1]',
		`terlambatdua`='$_POST[terlambat2]',
		`terlambattiga`='$_POST[terlambat3]',
		`terlambatempat`='$_POST[terlambat4]',
		`pulangsatu`='$_POST[pulang1]',
		`pulangdua`='$_POST[pulang2]',
		`pulangtiga`='$_POST[pulang3]',
		`pulangempat`='$_POST[pulang4]',
		`tidakditempat`='$_POST[tidakditempat]',
		`tidakhadir`='$_POST[tidakhadir]',
		`izin`='$_POST[izin]',
		`cuti`='$_POST[cuti]',
		`hudis`='$_POST[hudis]',
		`ppk`='$_POST[ppk]' where id_absensi = '$_POST[id_absensi]'");
														
	if($query) { 
			echo "<script>alert('Data Berhasil di Update');window.location='06_daftar_absensi.php'</script>";
	} else {
		echo "<script>alert('Data Gagal di Update');window.location='06_daftar_absensi.php'</script>";
	}
?>	
