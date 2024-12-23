<?php 
	error_reporting(0); 
 	include "session.php";
 	$bulan = $_POST['bulan'];
	$tahun = $_POST['tahun']; 
 ?>
<?php
		require_once("../config/koneksi.php");
		$query=mysql_query("update tb_logbook_dosen set status = 'Belum di Nilai',
													keterangan_status = ''
											  		where id_logbook = '$_POST[id_logbook]'");													
	if($query) 
		{ 
			echo "<script>alert('Data Berhasil di Update');window.location='12_logbook_bulanan.php?&bulan=$_POST[bulan]&tahun=$_POST[tahun]'</script>";
		} 

	else 
		{
			echo "<script>alert('Data Gagal di Update');window.location='12_logbook_bulanan.php?&bulan=$_POST[bulan]&tahun=$_POST[tahun]'</script>";
		}
?>	
