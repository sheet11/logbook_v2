

<?php
	include "session.php";
	include"../config/koneksi.php";

		
	$query = mysql_query("SELECT * FROM `tb_logbook` WHERE month(tanggal_logbook) = '$_GET[bulan]' AND year(tanggal_logbook) = '$_GET[tahun]' AND nip='$_SESSION[nip]'");
	$jumlah = mysql_num_rows($query);
?>
<html>
<body>

<div>
	<table border="1">
	 	<tr>
        	<td colspan="3"><b>Data Pegawai</b></td>
        </tr>
		<tr>
			<td colspan="2">Nama Pegawai</td>
			<td width="2%">:</td>
			<td><?php echo $_SESSION['nama_lengkap'];?></td>
		</tr>
		<tr>
			<td colspan="2">Unit Kerja</td>
			<td width="2%">:</td>
			<td><?php echo $_SESSION['unit_kerja'];?></td>
		</tr>
		<tr>
			<td colspan="2">Jabatan</td>
			<td width="2%">:</td>
			<td><?php echo $_SESSION['jabatan'];?></td>
		</tr>
	</table>
	<br />
	<table border="1">
		<tr>
            <td colspan='3'><b>Data Logbook Bulanan</b></td>
        </tr>
		<tr>
			<th width='5%'>No.</th><th>Tanggal</th><th>Uraian Kegiatan</th><th>Jumlah Menit</th><th>Keterangan</th><th>Jumlah Kegiatan</th><th>Output Kegiatan</th><th width='10%'>Status</th>
		</tr>
		<?php
		$i =  +1;
          while($a=mysql_fetch_array($query)){
			$jumenit = substr($a['jumlah_menit'], 0, 5);
			  echo "
		<tr>
			<td>$i</td><td>$a[tanggal_logbook]</td><td>$a[uraian_pekerjaan]</td><td>$jumenit</td><td>$a[keterangan]</td><td>$a[jumlah_kegiatan]</td><td>$a[output_kegiatan]</td><td>$a[status_penilai]</td>
		</tr>";
		 $i++;}
		 $qr = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook WHERE month(tanggal_logbook) = '$_GET[bulan]' AND year(tanggal_logbook) = '$_GET[tahun]' AND nip='$_SESSION[nip]'");
	  $qry = mysql_fetch_assoc($qr);
	  $arr = explode(":", $qry['timeSum']);
	  $jumenit = substr($qry['timeSum'], 0, 5);
	  $jam = $arr[1]/60;
	  $hjam1 = $arr[0] * 25000;
	  $hjam2 = $jam * 25000;
	  $tuang = floor($hjam1 + $hjam2);
	  $juang = number_format($tuang, 0, '', '.');
	  $kueri = mysql_fetch_array(mysql_query("SELECT * FROM tb_absensi where month(bulan) = '$_GET[bulan]' AND year(bulan)='$_GET[tahun]' AND nip='$_SESSION[nip]'"));
	  $izin = $kueri['izin'];
	  $sakit = $kueri['sakit'];
	  $alpa = $kueri['alpa'];
	  $totalabsen = $tuang-$izin-$sakit-$alpa;
	  $totuang = number_format($totalabsen, 0, '', '.');
          echo "<table border='1'>
	          		<tr>
	                    <td colspan='3'><b>Data Komulatif Log Book Bulanan</b></td>
	                </tr>

	              	<tr>
	                  	<td colspan='2'>Total Kuantitatif / Volume </td> <td width='2%'> :</td><td> $jumlah </td> 
	              	</tr>

	              	<tr>
		              	<td colspan='2'>Total Jam Kerja Efektif </td> <td> :</td><td> $jumenit</td> 
		            </tr>

					<tr>
						<td colspan='2'>Total uang</td><td> :</td><td> $juang </td>
					</tr>

					<tr>
						<td colspan='2'>Total uang setelah dikurangi absensi</td><td> :</td><td>: $totuang </td>
			  		</tr>";
		 ?>
	</table>
</body>
</html>
<script>
  window.print();
</script>