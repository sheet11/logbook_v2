<?php error_reporting(0); ?>
<?php include "session.php"; ?>
<?php
		require_once("../config/koneksi.php");
		
		$query=mysql_query("update tb_absensi set `tanggal`='$_POST[tanggal_absensi]',
		`keterlambatan` = '$_POST[keterlambatan]',
		`pulang_sebelum`='$_POST[pulangsebelum]',
		`apel_pagi`='$_POST[apelpagi]',
		`apel_bersama`='$_POST[apelbersama]',
		`tidak_ditempat_tugas`='$_POST[tidakditempat]',
		`tidak_hadir`='$_POST[tidakhadir]',
		`izin_sakit`='$_POST[izin]',
		`cuti`='$_POST[cuti]',
		`cuti_dari`='$_POST[dari]',
		`cuti_sampai`='$_POST[sampai]',
		`jenis_cuti`='$_POST[jeniscuti]',
		`dl_non_tusi`='$_POST[dl]' where id_absensi = '$_POST[id_absensi]'");
														
	if($query) { 
			echo "<script>alert('Data Berhasil di Update');window.location='06_absensi_bulanan.php?pegawai=$_POST[pegawai]&bulan=$_POST[bulan]&tahun=$_POST[tahun]'</script>";
	} else {
		echo "<script>alert('Data Gagal di Update');window.location='06_edit_absensi.php?id_absensi=$_POST[id_absensi]&pegawai=$_POST[pegawai]&bulan=$_POST[bulan]&tahun-$_POST[tahun]'</script>";
	}
?>	