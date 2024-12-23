<?php
include "../config/koneksi.php";
include "session.php";

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=DetailSkp.xls");
?>
<table border="1">
	<tr>
		<td>id Detail SKP</td>
		<td>Uraian SKP</td>
		<td>Alokasi Waktu</td>
		<td>Target Waktu</td>
	</tr>
<?php
$skp = mysql_query("SELECT id_daftar_skp FROM `tb_daftar_skp` WHERE nip='$_SESSION[nip]' AND month(bulan) = '$_GET[bulan]' AND year(bulan) = '$_GET[tahun]'");
$row = 1;
while($data = mysql_fetch_array($skp)){
	$ia = 1;
	$detailSkp = mysql_query("SELECT * FROM tb_detail_skp WHERE id_daftar_skp=$data[id_daftar_skp]");
	while($dapat=mysql_fetch_array($detailSkp)){
		echo '<tr>
					<td>'.$dapat['id_detail_skp'].'</td>
					<td>'.$dapat['uraian_skp'].'</td>
					<td>'.$dapat['alokasi_waktu'].'</td>
					<td>'.$dapat['target_waktu'].'</td>
				</tr>';
		$ia++;
	}
	$row++;
}
?>