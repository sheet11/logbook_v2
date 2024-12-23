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
?>
<html>
    <body>
        <div>
            <?php
                $qr = mysql_query("SELECT * FROM `tb_daftar_skp` as s, tb_pegawai as p WHERE s.nip_penilai=p.nip AND id_daftar_skp='$_GET[id_daftar_skp]'");
                $qry = mysql_fetch_array($qr);
            ?>
	           <table class="table table-bordered" style="font-size:12;">
                    <tr>
                        <td width="25%">Lampiran 2a :</td>
                        <td>Peraturan Direktur Politeknik Kesehatan Kemenkes Bengkulu</td>
                    </tr>

                    <tr>
                        <td>&nbsp;</b></td>
                        <td>Nomor : HK.02.04/1460/1460/1/VII/2016 Tanggal 22 Juni 2016</td>
                    </tr>

                    <tr>
                        <td>&nbsp;</b></td>
                        <td>Tentang Pedoman Penetapan Kinerja, Evaluasi Kinerja dan Penilaian Prestasi Kerja Bagi Jabatan Dosen, Tugas Tambahan, dan Tenaga Kependidikan dalam Rangka Pelaksanaan Remunerasi di Lingkungan Politeknik Kesehatan Kemenkes Bengkulu</td>
                    </tr>
                </table>

                <table class="table table-bordered" style="font-size:12;">
            		<tr>
                    	<td colspan="6" align="center"><b>TARGET SASARAN KINERJA PEGAWAI (SKP) </b></td>
                    </tr>
                   	<tr>
                    	<td colspan="6" align="center"><b>BULAN <?php echo $qry['bulan']; ?></b></td>
                    </tr>

                    <tr>
                    	<td width="1%"><b>No</b></td>
                    	<td colspan="2"><b>I. PEJABAT PENILAI</b></td>
                    	<td width="1%"><b>No</b></td>
                    	<td colspan="2"><b>II. PNS YANG DINILAI </b></td>
                    </tr>

            	 	<tr>
                    	<td>1.</td>
                    	<td>Nama</td>
                    	<td><?php echo $qry['nama_lengkap']; ?></td>
                    	<td>1.</td>
                    	<td>Nama</td>
                    	<td><?php echo $_SESSION['nama_lengkap'];?></td>
                    </tr>

                    <tr>
                    	<td>2.</td>
                    	<td>NIP</td>
                    	<td><?php echo $qry['nip']; ?></td>
                    	<td>2.</td>
                    	<td>NIP</td>
                    	<td><?php echo $_SESSION['nip'];?></td>
                    </tr>

                    <tr>
                    	<td>4.</td>
                    	<td>Jabatan</td>
                    	<td><?php echo $qry['jabatan'];?></td>
                    	<td>4.</td>
                    	<td>Jabatan</td>
                    	<td><?php echo $_SESSION['jabatan'];?></td>
                    </tr>

                    <tr>
                    	<td>5.</td>
                    	<td>Unit Kerja</td>
                    	<td><?php echo $qry['unit_kerja'];?></td>
                    	<td>5.</td>
                    	<td>Unit Kerja</td>
                    	<td><?php echo $_SESSION['unit_kerja'];?></td>
                    </tr>

                  </table>

            	<br />
            	<?php
            	$query = mysql_query("SELECT * FROM `tb_daftar_skp` WHERE nip='$_GET[pegawai]'  AND month(bulan) = '$_GET[bulan]' AND year(bulan) = '$_GET[tahun]' order by id_daftar_skp asc");
	
					   echo "<table id='example1' class='table table-bordered table-striped' style='font-size:12;'>
                                <thead>		
        		  					<tr>
        								<th width='5%' rowspan='2'>No.</th>
        								<th rowspan='2'valign='top'>III KEGIATAN TUGAS POKOK JABATAN</th>
        								<th colspan='2' align='center'>Target</th>
        								<th align='center'>Kual/Mutu</th>
        								<th align='center'>Bukti Kinerja</th>
        							</tr>
        							<tr>
        								<th align='center'>Kuantitas</th>
        								<th align='center'>Output</th>
        							</tr>
        					   </thead>";
                					    $i = 1;
                						$target = 0;
                				        while($a=mysql_fetch_array($query)){
                					    $target = $target+$a['target_kegiatan'];
				                echo"
                    				<tr>
                    					<td>$i</td>
                    					<td>$a[nama_skp]</td>
                    					<td>$a[target_kegiatan]</td>
                    					<td>$a[output_kegiatan]</td>
                    					<td>$a[mutu]</td>
                    					<td>$a[output_kegiatan]</td>

                    				</tr>";

                				$i++;
                				   }
                				   echo "
                				   <tr>
                    					<td colspan='2'>TOTAL</td>
                    					<td>$target</td>
                    					<td>&nbsp; </td>
                				   </tr></table>";
                ?>

        		 <table border="0" width="100%" style="font-size:12;">
            	 	<tr>
                    	<td width="65%">&nbsp;</td><td width="50%">Bengkulu, <?php echo date('d-m-Y'); ?></td>
                    </tr>
                    <tr>
                    	<td>&nbsp;</td><td >&nbsp;</td>
                    </tr>
                    <tr>
                    	<td>Pejabat Penilai </td><td >Pegawai</td>
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
                    	<td>&nbsp;</td><td >&nbsp;</td>
                    </tr>
                    <tr>
                    	<td>&nbsp;</td><td >&nbsp;</td>
                    </tr>
                    <tr>
            			<td style="text-transform:uppersize;"><u><b><?php echo $qry['nama_lengkap']; ?></b></u></td>
            			<td style="text-transform:uppersize;"><u><b><?php echo $_SESSION['nama_lengkap'];?></b></u></td>
            		</tr>
            		<tr>
            			<td><?php echo $qry['nip_penilai']; ?> </td><td>NIP. <?php echo $_SESSION['nip'];?></td>
            		</tr>
            	</table>
    </body>
</html>
