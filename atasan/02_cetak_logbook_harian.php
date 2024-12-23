<script src="../assets/js/jquery-1.11.0.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css" />
<!-- Bootstrap Core CSS -->
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="../assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- BOOTSTRAP STYLES-->
<link href="../assets/css/bootstrap.css" rel="stylesheet" />
<!-- FONTAWESOME STYLES-->
<link href="../assets/css/font-awesome.css" rel="stylesheet" />

<?php
	include "session.php";
	include"../config/koneksi.php";
	include("bar128.php");
    include("library.php");
	include("fucnt_tgl.php");	
	$query = mysql_query("SELECT * FROM tb_logbook WHERE tanggal_logbook BETWEEN '$_GET[awal]' AND '$_GET[akhir]' AND nip='$_SESSION[nip]'");
	$jumlah = mysql_num_rows($query);

?>

<html>
	<body>
		<div align=center>
			<img src="../assets/img/kop.jpg">
		</div>
		<div>
			<table class="table table-bordered">
			 	<tr>
		        	<td colspan="3" class="success"><b>Data Pegawai</b></td>
		        </tr>

				<tr>
					<td width="25%">NIP</td>
					<td width="2%">:</td>
					<td><?php echo $_SESSION['nip'];?></td>
				</tr>

				<tr>
					<td>Nama Pegawai</td>
					<td width="2%">:</td>
					<td><?php echo $_SESSION['nama_lengkap'];?></td>
				</tr>

				<tr>
					<td>Unit Kerja</td>
					<td width="2%">:</td>
					<td><?php echo $_SESSION['unit_kerja'];?></td>
				</tr>

				<tr>
					<td>Jabatan</td>
					<td width="2%">:</td>
					<td><?php echo $_SESSION['jabatan'];?></td>
				</tr>
			</table>

			<br />

			<table class="table table-bordered">
				<tr>
		            <td colspan='8' class="success"><b>Data Logbook Harian</b></td>
		        </tr>

				<tr>
					<th width='5%'>No.</th><th>Tanggal</th><th>Uraian Kegiatan</th><th>Jumlah Menit</th><th>Keterangan</th><th>Jumlah Kegiatan</th><th>Output Kegiatan</th><th width='10%'>Status</th>
				</tr>

			<?php

				$i =  +1;

		        while($a=mysql_fetch_array($query)){

				$jumenit = substr($a['jumlah_menit'], 0, 5);

				echo "<tr>
						<td>$i</td><td>$a[tanggal_logbook]</td><td>$a[uraian_pekerjaan]</td><td>$jumenit</td><td>$a[keterangan]</td><td>$a[jumlah_kegiatan]</td><td>$a[output_kegiatan]</td><td>$a[status_penilai]</td>

					</tr>";

		 			$i++;}

		 			$qr = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook WHERE tanggal_logbook BETWEEN '$_GET[awal]' AND '$_GET[akhir]' AND nip='$_SESSION[nip]'");

				  $qry = mysql_fetch_assoc($qr);
				  $arr = explode(":", $qry['timeSum']);
				  $jumenit = substr($qry['timeSum'], 0, 5);
				  $jam = $arr[1]/60;
				  $hjam1 = $arr[0] * 25000;
				  $hjam2 = $jam * 25000;
				  $tuang = floor($hjam1 + $hjam2);
				  $juang = number_format($tuang, 0, '', '.');

          		echo "<table class='table table-bordered table-striped'>
             		<tr>
                        <td colspan='3' class='success'><b>Data Komulatif Log Book Harian</b></td>
                    </tr>
                    <tr>
                        <td>Total Kuantitatif / Volume </td> <td width='2%'> :</td><td> $jumlah </td> 
                    </tr>
                    <tr>
                        <td>Total Jam Kerja Efektif </td> <td> :</td><td> $jumenit</td> 
                    </tr>
                </table>";

		 	?>


		<table class="table table-bordered">
		 	<tr>
	        	<td width="70%">&nbsp;</td><td>Bengkulu,       2016</td>
	        </tr>

	        <tr>
	        	<td>&nbsp;</td><td >&nbsp;</td>
	        </tr>

	        <tr>
	        	<td>&nbsp;</td><td >&nbsp;</td>
	        </tr>

	        <tr>
				<td>&nbsp;</td><td style="text-transform:uppersize;"><u><b><?php echo $_SESSION['nama_lengkap'];?></b></u></td>
			</tr>

			<tr>
				<td>&nbsp;</td><td>NIP. <?php echo $_SESSION['nip'];?></td>
			</tr>
		</table>
	</body>
</html>
<script>
  window.print();
</script>