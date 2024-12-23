<?php 
	error_reporting(0); 
	include "session.php"; 
?>

<?php
	require_once("../config/koneksi.php");
	$query=mysql_query("update tb_detail_skp set uraian_skp = '$_POST[uraian_pekerjaan]',
													alokasi_waktu = '$_POST[alokasi_waktu]',
													target_waktu = '$_POST[target_waktu]'
											  		where id_detail_skp = '$_POST[id_detail_skp]'");		

	if($query) { 

			echo "<script>alert('Data Berhasil di Update');window.location='11_lihat_target_skp_pegawai.php?pegawai=$_POST[pegawai]&bulan=$_POST[bulan]&tahun=$_POST[tahun]'</script>";

	} else {

		echo "<script>alert('Data Gagal di Update');window.location='11_edit_detail_target_skp_pegawai.php?pegawai=$_POST[pegawai]&id_detail_skp=$_POST[id_detail_skp]&bulan=$_POST[bulan]&tahun=$_POST[tahun]'</script>";
	}
?>	

