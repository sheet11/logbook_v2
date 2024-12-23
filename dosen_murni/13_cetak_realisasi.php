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
                $qr = mysql_query("SELECT * FROM `tb_daftar_skp_dosen` as s, tb_pegawai as p WHERE id_daftar_skp='$_GET[id_daftar_skp]'");
                $qry = mysql_fetch_array($qr);
				$tgl = tgl_baru($qry['bulan']);
            ?>
	           <table class="table table-bordered" style="font-size:12;">
                    <tr>
                        <td width="25%">Lampiran 5a :</td>
                        <td>Peraturan Direktur Politeknik Kesehatan Kemenkes Bengkulu</td>
                    </tr>

                    <tr>
                        <td>&nbsp;</b></td>
                        <td>Nomor : HK.02.04/1460/1/VII/2016 Tanggal 22 Juni 2016</td>
                    </tr>

                    <tr>
                        <td>&nbsp;</b></td>
                        <td>Tentang Pedoman Penetapan Kinerja, Evaluasi Kinerja dan Penilaian Prestasi Kerja Bagi Jabatan Dosen, Tugas Tambahan, dan Tenaga Kependidikan dalam Rangka Pelaksanaan Remunerasi di Lingkungan  Politeknik Kesehatan Kemenkes Bengkulu. </td>
                    </tr>
                </table>

                <table class="table table-bordered" style="font-size:12;">
            		<tr>
                    	<td colspan="6" align="center"><b>PENILAIAN CAPAIAN SASARAN KERJA </b></td>
                    </tr>

                    <tr>
                    	<td colspan="6" align="center"><b>PEGAWAI NEGERI SIPIL</b></td>
                    </tr>

                   	<tr>
                    	<td colspan="6" align="center"><b>BULAN <?php echo $tgl; ?></b></td>
                    </tr>

                   
                  </table>
	<br />
	<?php
	$query = mysql_query("SELECT * FROM tb_logbook_dosen, `tb_daftar_skp_dosen`, tb_detail_skp_dosen WHERE tb_logbook_dosen.nip='$_GET[pegawai]' AND month(bulan) = '$_GET[bulan]' AND year(bulan) = '$_GET[tahun]' AND tb_logbook_dosen.id_daftar_skp=tb_daftar_skp_dosen.id_daftar_skp AND tb_logbook_dosen.id_detail_skp=tb_detail_skp_dosen.id_detail_skp order by id_logbook asc");
	$qr = mysql_query("SELECT * FROM `tb_daftar_skp_dosen` as s, tb_pegawai as p WHERE s.nip_penilai=p.nip AND id_daftar_skp='$_GET[id_daftar_skp]'");
					   $qry = mysql_fetch_array($qr);
					   echo "<table id='example1' class='table table-bordered table-striped' style='font-size:12;'>
                    <thead>		
		  					<tr>
								<th width='5%' rowspan='2'>No.</th>
								<th rowspan='2' colspan='2'>KEGIATAN TUGAS POKOK JABATAN</th>
								<th colspan='3'>Target</th>
								<th colspan='3'>Ralisasi</th>
								<th colspan='2'>Realisasi %</th>
							</tr>
							<tr>
        						<th align='center'>Kuantitas</th>
        						<th align='center'>Output</th>
        						<th align='center'>Waktu</th>
        						<th align='center'>Kuantitas</th>
        						<th align='center'>Output</th>
        						<th align='center'>Waktu</th>
        						<th align='center'>Kuantitas</th>
        						<th align='center'>Waktu</th>
        						
        					</tr>
					</thead>";
					   $i = 1;
						$target = 0;
						$realisasi = 0;
				while($a=mysql_fetch_array($query)){
					$target = $target+$a['target_kegiatan'];
					$realisasi = $realisasi+$a['jumlah_kegiatan'];
					$persen = $a['jumlah_kegiatan'] / $a['target_kegiatan'] * 100;
					$persen2 = number_format($persen, 2, ',', ',');
					$jumenit = substr($a['jumlah_menit'], 0, 5);
					$arr1 = explode(":", $a['jumlah_menit']);
					$menit1 = $arr1[0]*60;
					$jam1 = $arr1[1];
					$tjam1 = $menit1 + $jam1;
					
					$arr2 = explode(":", $a['alokasi_waktu']);
					$menit2 = $arr2[0]*60;
					$jam2 = $arr2[1];
					$tjam2 = $menit2 + $jam2;
					
					$waktu = $tjam1/$tjam2*100;
					$waktu2 = number_format($waktu, 2, ',', ',');
				echo"
				<tr>
					<td>$i</td>
					<td colspan='2'>$a[nama_skp]</td>
					<td>$a[target_kegiatan]</td>
					<td>$a[output_kegiatan]</td>
					<td>$a[alokasi_waktu]</td>
					<td>$a[jumlah_kegiatan]</td>
					<td>$a[output_kegiatan]</td>
					<td>$jumenit</td>
					<td>$persen2 %</td>
					<td>$waktu2 %</td>
				</tr>";$que=mysql_query("SELECT * FROM `tb_detail_skp_dosen` WHERE id_daftar_skp='$a[id_daftar_skp]' order by id_detail_skp asc");				
					$ii = 1;
				while($kueri=mysql_fetch_array($que)){
				echo"
				<tr>
					<td>&nbsp;</td>
					<td>$ii</td>
					<td>$kueri[uraian_skp]</a></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>$kueri[alokasi_waktu]</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>";

				$ii++;
				   }
				$i++;
				   }
				   echo "
				   <tr>
					<td colspan='2'>TOTAL</td>
					<td>&nbsp; </td>
					<td>$target</td>
					<td>&nbsp; </td>
					<td>&nbsp; </td>
					<td>$realisasi</td>
					<td>&nbsp; </td>
					<td>&nbsp; </td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				   </tr></table>";
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
        <?php
                $qr = mysql_query("SELECT * FROM `tb_daftar_skp_dosen` as s, tb_pegawai as p WHERE id_daftar_skp='$_GET[id_daftar_skp]'");
                $qry = mysql_fetch_array($qr);
            ?>
                    <tr>
            			<td style="text-transform:uppersize;"><u><b><?php echo $qry['nama_lengkap']; ?></b></u></td>
            			<td style="text-transform:uppersize;"><u><b><?php echo $_SESSION['nama_lengkap'];?></b></u></td>
            		</tr>
            		<tr>
            			<td>NIP. <?php echo $qry['nip']; ?> </td><td>NIP. <?php echo $_SESSION['nip'];?></td>
            		</tr>
            	</table>

</body>
</html>
<script>
  window.print();
</script>