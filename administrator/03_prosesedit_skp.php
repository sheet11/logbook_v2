<?php error_reporting(0); ?>
<?php include "session.php"; ?>
<?php
		require_once("../config/koneksi.php");
		
		$query=mysql_query("update tb_daftar_skp set nama_skp = '$_POST[nama_skp]',
													uraian_pekerjaan = '$_POST[uraian_pekerjaan]',
													jumlah_kegiatan = '$_POST[jumlah_kegiatan]',
													output_kegiatan = '$_POST[output_kegiatan]',
													waktu = '$_POST[waktu]'
											  		where id_daftar_skp = '$_POST[id_daftar_skp]'");
														
	if($query) { 
			echo "<script>alert('Data Berhasil di Update');window.location='03_daftar_skp.php'</script>";
	} else {
		echo "<script>alert('Data Gagal di Update');window.location='03_daftar_skp.php'</script>";
	}
?>	
