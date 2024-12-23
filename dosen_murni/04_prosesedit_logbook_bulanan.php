<?php 
	error_reporting(0); 
	include "session.php"; 
?>

<?php
		require_once("../config/koneksi.php");
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
		$qr = mysql_fetch_array(mysql_query("SELECT * FROM tb_detail_skp_dosen WHERE id_detail_skp = '$_POST[detail]'"));
		$waktu = $qr['alokasi_waktu'];
		$query=mysql_query("update tb_logbook_dosen set tanggal_logbook = '$_POST[tanggal_logbook]',
													jumlah_menit = '$_POST[jumlah_menit]',
													keterangan = '$_POST[keterangan]',
													jumlah_kegiatan_skp = '$_POST[jumlah_kegiatan_skp]',
													output_kegiatan_skp = '$_POST[output_kegiatan_skp]',
													jumlah_kegiatan = '$_POST[jumlah_kegiatan]',
													output_kegiatan = '$_POST[output_kegiatan]',
													id_daftar_skp = '$_POST[skp]',
													id_detail_skp = '$_POST[detail]',
													status = 'Belum di Nilai'
											  		where id_logbook = '$_POST[id_logbook]'");
														
	if($query) { 
			echo "<script>alert('Data Berhasil di Update');window.location='04_logbook_bulanan.php?bulan=$bulan&tahun=$tahun'</script>";
	} else {
		echo "<script>alert('Data Gagal di Update');window.location=''04_logbook_bulanan.php?bulan=$bulan&tahun=$tahun'</script>";
	}
?>	
