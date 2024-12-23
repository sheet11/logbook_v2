<?php 
	error_reporting(0); 
	include "session.php"; 
?>
<?php
		require_once("../config/koneksi.php");
		
		$query=mysql_query("update tb_daftar_skp set bulan='$_POST[bulan]', 
													nama_skp = '$_POST[nama_skp]',
													target_kegiatan = '$_POST[jumlah_kegiatan]',
													output_kegiatan = '$_POST[output_kegiatan]',
													mutu = '$_POST[mutu]'
											  		where id_daftar_skp = '$_POST[id_daftar_skp]'");
														
	if($query) { 
			echo "<script>window.location='03_skp_bulanan.php?bulan=$_POST[bulan1]&tahun=$_POST[tahun]'</script>";
	} 
	else {
		echo "<script>alert('Data Gagal di Update');window.location='03_edit_skp.php?bulan=$_POST[bulan1]&tahun=$_POST[tahun]'</script>";
	}
?>	
