
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
	error_reporting(0);
		
	$query = mysql_query("SELECT * FROM `tb_logbook_dosen`, tb_detail_skp_dosen WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_GET[bulan]' AND year(tanggal_logbook) = '$_GET[tahun]' AND tb_logbook_dosen.id_detail_skp=tb_detail_skp_dosen.id_detail_skp order by tanggal_logbook asc");
	$jumlah = mysql_num_rows($query);
?>
<html>
<body>
<div align=center>
	<img src="../assets/img/kop.jpg">
</div>
<div>
	<table class="table table-bordered" style="font-size:12">
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
	<table class="table table-bordered" style="font-size:12">
		<tr>
            <td colspan='8' class="success"><b>Data Logbook Bulanan</b></td>
        </tr>
		<tr>
			<th width='5%'>No.</th><th>Tanggal</th><th>Uraian Kegiatan</th><th>Jumlah Menit</th><th>Keterangan</th><th>Jumlah Kegiatan</th><th>Output Kegiatan</th>
		</tr>
		<?php
		$i =  +1;
          while($a=mysql_fetch_array($query)){
			$jumenit = substr($a['jumlah_menit'], 0, 5);
			$tgl=tgl_indo($a['tanggal_logbook']);
			  echo "
		<tr>
			<td>$i</td><td>$tgl</td><td>$a[uraian_skp]</td><td>$jumenit</td><td>$a[keterangan]</td><td>$a[jumlah_kegiatan]</td><td>$a[output_kegiatan]</td>
		</tr>";
		 $i++;}
		$qr = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook_dosen WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_GET[bulan]' AND year(tanggal_logbook) = '$_GET[tahun]'");
    $qry = mysql_fetch_assoc($qr);
    $jumenit = substr($qry['timeSum'], 0, 5);
    $arr = explode(":", $qry['timeSum']);
    $menit = $arr[0]*60;
    $jam = $arr[1];
    $tjam = $menit + $jam;
	
	$qr1 = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook_dosen WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_GET[bulan]' AND year(tanggal_logbook) = '$_GET[tahun]' AND status='Belum di Nilai'");
    $qry1 = mysql_fetch_assoc($qr1);
    $jumenit1 = substr($qry1['timeSum'], 0, 5);
    $arr1 = explode(":", $qry1['timeSum']);
    $menit1 = $arr1[0]*60;
    $jam1 = $arr1[1];
    $tjam1 = $menit1 + $jam1;
	
	$qr2 = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook_dosen WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_GET[bulan]' AND year(tanggal_logbook) = '$_GET[tahun]' AND status='Dinilai'");
    $qry2 = mysql_fetch_assoc($qr2);
    $jumenit2 = substr($qry2['timeSum'], 0, 5);
    $arr2 = explode(":", $qry2['timeSum']);
    $menit2 = $arr2[0]*60;
    $jam2 = $arr2[1];
    $tjam2 = $menit2 + $jam2;
	
	$qr3 = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook_dosen WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_GET[bulan]' AND year(tanggal_logbook) = '$_GET[tahun]' AND status='Sudah di Verifikasi'");
    $qry3 = mysql_fetch_assoc($qr3);
    $jumenit3 = substr($qry3['timeSum'], 0, 5);
    $arr3 = explode(":", $qry3['timeSum']);
    $menit3 = $arr3[0]*60;
    $jam3 = $arr3[1];
    $tjam3 = $menit3 + $jam3;
	
	$qr4 = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook_dosen WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_GET[bulan]' AND year(tanggal_logbook) = '$_GET[tahun]' AND status='Dikembalikan'");
    $qry4 = mysql_fetch_assoc($qr4);
    $jumenit4 = substr($qry4['timeSum'], 0, 5);
    $arr4 = explode(":", $qry4['timeSum']);
    $menit4 = $arr4[0]*60;
    $jam4 = $arr4[1];
    $tjam4 = $menit4 + $jam4;
	

	  
          echo "<table class='table table-bordered table-striped' style='font-size:12'>
                    <tr>
                        <td colspan='3' class='info'><b>Data Komulatif Log Book Bulanan</b></td>
                    </tr>

                    <tr>
                        <td>Total Kuantitatif / Volume </td> <td> : $jumlah</td> 
                    </tr>
                    <tr>
                        <td>Total Menit Yang Dicapai </td> <td> : $tjam Menit</td> 
                    </tr>
                    <tr>
                        <td>Total Menit Belum di Nilai </td> <td> : $tjam1 Menit</td> 
                    </tr>
                    <tr>
                        <td>Total Menit Sudah di Nilai </td> <td> : $tjam2 Menit</td> 
                    </tr>
                    <tr>
                        <td>Total Menit Sudah di Verifikasi </td> <td> : $tjam3 Menit</td> 
                    </tr>
                    <tr>
                        <td>Total Menit Di Kembalikan </td> <td> : $tjam4 Menit</td> 
                    </tr>

              </table>";
			  ?>
</body>
</html>
<script>
  window.print();
</script>