<?php 
	error_reporting(0); 
	include "session.php"; 
?>

<?php
	require_once("../config/koneksi.php");
	$query=mysql_query("update tb_detail_skp_dosen set uraian_skp = '$_POST[uraian_pekerjaan]',
													alokasi_waktu = '$_POST[alokasi_waktu]',
													target_waktu = '$_POST[target_waktu]'
											  		where id_detail_skp = '$_POST[id_detail_skp]'");		
	if($query) 
		{ 
			echo "<script>alert('Data Berhasil di Update');window.location='13_skp_bulanan.php?bulan=$_POST[bulan]&tahun=$_POST[tahun]'</script>";
		} 

	else 
		{
			echo "<script>alert('Data Gagal di Update');window.location='13_edit_detail_skp.php?id_detail_skp=$_POST[id_detail_skp]&bulan=$_POST[bulan]&tahun=$_POST[tahun]'</script>";
		}
?>	

