<?php error_reporting(0); ?>
<?php include "session.php"; ?>
<?php
		require_once("../config/koneksi.php");
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
		$tanggal = $tahun.'-'.$bulan.'-01';
		
		if($_POST['tanggal'] == $tanggal)
		{
			$query=mysql_query("update tb_hitungan set tanggal_hitungan = '$tanggal',
													p2 = '$_POST[p2]',
													standar_waktu = '$_POST[waktu]',
													nip = '$_POST[nip]'
											  		where id_hitungan = '$_POST[id_hitungan]'");
													
			if($query) {
				echo "<script>alert('Data Berhasil di Update');window.location='09_daftar_perhitungan.php'</script>";
			}
			else {
				echo "<script>alert('Data Gagal di Update');window.location='09_edit_perhitungan.php'</script>";
			}
		}
		else
		{
			$qr = mysql_query("SELECT * FROM tb_hitungan WHERE tanggal_hitungan='$tanggal' AND nip='$_POST[nip]'");
			$rq = mysql_num_rows($qr);
			
			if($rq>0)
			{
				echo"<script>alert('Data sudah ada, silahkan input kembali');window.location='09_edit_perhitungan.php?id_perhitungan=$_POST[id_hitungan]'</script>";
			}
			else
			{
				$query=mysql_query("update tb_hitungan set tanggal_hitungan = '$tanggal',
													p2 = '$_POST[p2]',
													standar_waktu = '$_POST[waktu]',
													nip = '$_POST[nip]'
											  		where id_hitungan = '$_POST[id_hitungan]'");
			if($query) {
				echo "<script>alert('Data Berhasil di Update');window.location='09_daftar_perhitungan.php'</script>";
			}
			else {
				echo "<script>alert('Data Gagal di Update');window.location='09_edit_perhitungan.php'</script>";
			}

			}
		}
?>	
