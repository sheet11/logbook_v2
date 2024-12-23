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
		
	$query = mysql_query("SELECT * FROM `tb_logbook` WHERE month(tanggal_logbook) = '$_GET[bulan]' AND year(tanggal_logbook) = '$_GET[tahun]' AND nip='$_SESSION[nip]'");
	$jumlah = mysql_num_rows($query);
?>
<html>
<body>
<div align=center>
<img src="../assets/img/kop.jpg">
<div>
<div class="container-fluid" style="margin:30px;">
</div>
	<table class="table">
		<tr>
			<td>NIP</td>
			<td><?php echo $_SESSION['nip'];?></td>
		</tr>
		<tr>
			<td>Nama Pegawai</td>
			<td><?php echo $_SESSION['nama_lengkap'];?></td>
		</tr>
		<tr>
			<td>Unit Kerja</td>
			<td><?php echo $_SESSION['unit_kerja'];?></td>
		</tr>
		<tr>
			<td>Jabatan</td>
			<td><?php echo $_SESSION['jabatan'];?></td>
		</tr>
		<tr>
			<td>Grade</td>
			<td><?php echo $_SESSION['grade'];?></td>
		</tr>
	</table> <br />
	<table class="table table-bordered table-striped">
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
          echo "<table class='table table-bordered table-striped'>
              <tr>
                  <td>Total Kuantitatif / Volume </td> <td> : $jumlah </td> 
              </tr>
              <tr>
              <td>Total Jam Kerja Efektif </td> <td> : $jumenit</td> 
              </tr>
              <tr>
              <td>Total Uang </td> <td> : $juang</td> 
              </tr>";
		 ?>
	</table>
</body>
</html>
<script>
  window.print();
</script>