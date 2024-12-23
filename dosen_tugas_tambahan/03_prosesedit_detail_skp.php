<?php 
	error_reporting(0); 
	include "session.php"; 
?>

<?php
	require_once("../config/koneksi.php");
						$arr1 = explode(":", $_POST['alokasi_waktu']);
						$menit1 = $arr1[0]*60;
						$jam1 = $arr1[1];
						$tjam1 = $menit1 + $jam1;
						
						$arr2 = explode(":", $_POST['target_waktu']);
						$menit2 = $arr2[0]*60;
						$jam2 = $arr2[1];
						$tjam2 = $menit2 + $jam2;
	$query=mysql_query("update tb_detail_skp set uraian_skp = '$_POST[uraian_pekerjaan]',
													alokasi_waktu = '$_POST[alokasi_waktu]',
													alokasi_menit = '$tjam1',
													target_waktu = '$_POST[target_waktu]',
													target_menit = '$tjam2'
											  		where id_detail_skp = '$_POST[id_detail_skp]'");		

	if($query) { 

			echo "<script>window.location='03_skp_bulanan.php?bulan=$_POST[bulan]&tahun=$_POST[tahun]'</script>";

	} else {

		echo "<script>alert('Data Gagal di Update');window.location='03_edit_detail_skp.php?id_detail_skp=$_POST[id_detail_skp]&bulan=$_POST[bulan]&tahun=$_POST[tahun]'</script>";
	}
?>	

