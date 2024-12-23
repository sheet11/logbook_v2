<?php error_reporting(0); ?>
<?php include "session.php"; ?>
<?php
		require_once("../config/koneksi.php");
		$tanggal = $_POST['tanggal'];
		
		$query=mysql_query("update tb_logbook set tanggal_logbook = '$_POST[tanggal_logbook]',
													uraian_pekerjaan = '$_POST[uraian_pekerjaan]',
													jumlah_menit = '$_POST[jumlah_menit]',
													keterangan = '$_POST[keterangan]',
													jumlah_kegiatan = '$_POST[jumlah_kegiatan]'
											  		where id_logbook = '$_POST[id_logbook]'");
														
	if($query) { 
			echo "<script>alert('Data Berhasil di Update');window.location='02_logbook_harian.php?tanggal_awal=$tanggal'</script>";
	} else {
		echo "<script>alert('Data Gagal di Update');window.location='02_logbook_harian.php'</script>";
	}
?>	
