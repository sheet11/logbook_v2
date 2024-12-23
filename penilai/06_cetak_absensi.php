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
$pegawai = mysql_query("SELECT * FROM tb_pegawai WHERE nip='$_GET[pegawai]'");
$pg = mysql_fetch_array($pegawai);
error_reporting(0); ?>


<body>
    <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Absensi Bulanan </h2>   
                    </div>
                </div> 
                             
                 <!-- /. ROW  -->
                  <hr />
                  <div>

                  <table class="table table-bordered">   
                      <tr class="info">
                          <td colspan="4"><b>Data Pegawai</b></td>
                      </tr> 
                      <tr>
                          <td width="15%">NIP</td>
                          <td width="2%">:</td>
                          <td><?php echo $pg['nip'];?></td>
                      </tr>

                      <tr>
                          <td>Nama Pegawai</td>
                          <td width="2%">:</td>
                          <td><?php echo $pg['nama_lengkap'];?></td>
                      </tr>

                      <tr>
                          <td>Unit Kerja</td>
                          <td width="2%">:</td>
                          <td><?php echo $pg['unit_kerja'];?></td>
                      </tr>

                      <tr>
                          <td>Jabatan</td>
                          <td width="2%">:</td>
                          <td><?php echo $pg['jabatan'];?></td>
                      </tr>
                  </table>
	<br />
	<?php
	$query = mysql_query("SELECT * FROM `tb_absensi` WHERE id_absensi='$_GET[id_absensi]'");
	$qr = mysql_query("SELECT * FROM `tb_absensi` as a, tb_pegawai as p WHERE a.nip_penilai=p.nip AND id_absensi='$_GET[id_absensi]'");
					   $a=mysql_fetch_array($query);
					   $qry = mysql_fetch_array($qr);
					   echo "<table class='table table-bordered'>   
                      <tr>
                          <td width=33%><b>Tanggal</b></td>
                          <td width=2%>:</td>
                          <td width=65%>$a[tanggal]</td>
                      </tr>   
                      <tr>
                          <td><b>Status</b></td>
                          <td>:</td>
                          <td>$a[status]</td>
                      </tr>   
                      <tr class='info'>
                          <td colspan=3><b>Tingkat Keterlambatan (Menit)</b></td>
                      </tr>   
                      <tr>
                          <td>1 s/d 30</td>
                          <td>:</td>
                          <td>$a[terlambatsatu]</td>
                      </tr>   
                      <tr>
                          <td>31 s/d 60</td>
                          <td>:</td>
                          <td>$a[terlambatdua]</td>
                      </tr>    
                      <tr>
                          <td>61 s/d 90</td>
                          <td>:</td>
                          <td>$a[terlambattiga]</td>
                      </tr>    
                      <tr>
                          <td>>90</td>
                          <td>:</td>
                          <td>$a[terlambatempat]</td>
                      </tr>   
                      <tr class='info'>
                          <td colspan=3><b>Tingkat Pulang Sebelum Waktunya (Menit)</b></td>
                      </tr>   
                      <tr>
                          <td>1 s/d 30</td>
                          <td>:</td>
                          <td>$a[pulangsatu]</td>
                      </tr>   
                      <tr>
                          <td>31 s/d 60</td>
                          <td>:</td>
                          <td>$a[pulangdua]</td>
                      </tr>    
                      <tr>
                          <td>61 s/d 90</td>
                          <td>:</td>
                          <td>$a[pulangtiga]</td>
                      </tr>    
                      <tr>
                          <td>>90</td>
                          <td>:</td>
                          <td>$a[pulangempat]</td>
                      </tr>   
                      <tr>
                          <td>Tidak Ditempat Tugas (Hari)</td>
                          <td>:</td>
                          <td>$a[tidakditempat]</td>
                      </tr>   
                      <tr>
                          <td>Tidak Hadir (Hari)</td>
                          <td>:</td>
                          <td>$a[tidakhadir]</td>
                      </tr>    
                      <tr>
                          <td>Izin > 2 Hari (Hari)</td>
                          <td>:</td>
                          <td>$a[izin]</td>
                      </tr>    
                      <tr>
                          <td>Cuti</td>
                          <td>:</td>
                          <td>$a[cuti]</td>
                      </tr>   
                      <tr class='info'>
                          <td colspan=3><b>Besaran Potongan</b></td>
                      </tr>   
                      <tr>
                          <td>Hudis</td>
                          <td>:</td>
                          <td>$a[hudis]</td>
                      </tr>   
                      <tr>
                          <td>PPk</td>
                          <td>:</td>
                          <td>$a[ppk]</td>
                      </tr>   
                  </table>";
				  ?>

		 <table border="0" width="100%">
	 	<tr>
        	<td width="50%">&nbsp;</td><td width="50%">Bengkulu, <?php echo date('d-m-Y'); ?></td>
        </tr>
        <tr>
        	<td>&nbsp;</td><td >&nbsp;</td>
        </tr>
        <tr>
        	<td>Pejabat Penilai Pegawai</td><td >Pegawai</td>
        </tr>
        <tr>
        	<td>&nbsp;</td><td >&nbsp;</td>
        </tr>
        <tr>
        	<td>&nbsp;</td><td >&nbsp;</td>
        </tr>
        <tr>
        	<td>&nbsp;</td><td >&nbsp;</td>
        </tr>
        <tr>
        	<td>&nbsp;</td><td >&nbsp;</td>
        </tr>
        <tr>
			<td style="text-transform:uppersize;"><u><b><?php echo $qry['nama_lengkap']; ?></b></u></td>
			<td style="text-transform:uppersize;"><u><b><?php echo $pg['nama_lengkap'];?></b></u></td>
		</tr>
		<tr>
			<td><?php echo $qry['nip_penilai']; ?> </td><td>NIP. <?php echo $pg['nip'];?></td>
		</tr>
	</table>

</body>
</html>
<script>
  window.print();
</script>