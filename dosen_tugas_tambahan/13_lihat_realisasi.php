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

?>

<html>

    <body>

        <div>

            <?php

                $qr = mysql_query("SELECT * FROM `tb_daftar_skp_dosen` as s, tb_pegawai as p WHERE id_daftar_skp='$_GET[id_daftar_skp]'");

                $qry = mysql_fetch_array($qr);

				$tgl = tgl_baru($qry['bulan']);

            ?>


	<?php

	$query = mysql_query("SELECT SUM(tb_logbook_dosen.total_menit) AS totalmenit, SUM(tb_detail_skp_dosen.alokasi_menit) AS alokasimenit, SUM(tb_detail_skp_dosen.target_menit) AS targetmenit, SUM(tb_daftar_skp_dosen.target_kegiatan) AS targetkegiatan, SUM(tb_logbook_dosen.jumlah_kegiatan_skp) AS jumlahkegiatan, tb_logbook_dosen.*, tb_daftar_skp_dosen.* , tb_detail_skp_dosen.* FROM tb_logbook_dosen, `tb_daftar_skp_dosen`, tb_detail_skp_dosen WHERE tb_logbook_dosen.status='Belum di Nilai' AND tb_logbook_dosen.nip='$_GET[pegawai]' AND month(bulan) = '$_GET[bulan]' AND year(bulan) = '$_GET[tahun]' AND tb_logbook_dosen.id_daftar_skp=tb_daftar_skp_dosen.id_daftar_skp AND tb_logbook_dosen.id_detail_skp=tb_detail_skp_dosen.id_detail_skp GROUP BY tb_daftar_skp_dosen.id_daftar_skp order by id_logbook ASC");

	$qr = mysql_query("SELECT * FROM `tb_daftar_skp_dosen` as s, tb_pegawai as p WHERE s.nip_penilai=p.nip AND id_daftar_skp='$_GET[id_daftar_skp]'");

					   $qry = mysql_fetch_array($qr);
					   echo "<table id='example1' class='table table-bordered table-striped' style='font-size:12;'>

                    <thead>		

		  					<tr>

								<th width='5%' rowspan='2'>No.</th>

								<th rowspan='2' colspan='2'>KEGIATAN TUGAS POKOK DOSEN</th>

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

						$totpersen = 0;

						$totwaktu = 0;

				while($a=mysql_fetch_array($query)){

					if($a>0){

					$target = $target+$a['target_kegiatan'];

					$realisasi = $realisasi+$a['jumlahkegiatan'];

					$persen = ($a['jumlahkegiatan'] / $a['target_kegiatan']) * 100;

					if($persen > 100)

					{

						$persen = 100;

					}

					else

					{

						$persen;

					}

					$persen2 = number_format($persen, 2, ',', ',');

					$totpersen = $totpersen+$persen2;

					$jumenit = substr($a['jumlah_menit'], 0, 5);

					

					$hitung1 = $realisasi/$target*50;

					$hitung11 = floor($hitung1);

					$hitung2 = $jumlah_time1/$jumlah_time2*50;

					$hitung21 = floor($hitung2);

					if($hitung11>50){ $hitung12 = 50;} elseif($hitung11<=50){$hitung12 = $hitung11;}

					if($hitung21>50){ $hitung22 = 50;} elseif($hitung21<=50){$hitung22 = $hitung21;}

					$hitung3 = $hitung12+$hitung22;

				echo"

				<tr>

					<td>$i</td>

					<td colspan='2'>$a[nama_skp]</td>

					<td>$a[target_kegiatan]</td>

					<td>$a[output_kegiatan]</td>

					<td>&nbsp;</td>

					<td>$a[jumlahkegiatan]</td>

					<td>$a[output_kegiatan_skp]</td>

					<td>&nbsp;</td>

					<td>$persen2 %</td>

					<td>&nbsp;</td>

				</tr>";

				$que=mysql_query("SELECT SUM(tb_logbook_dosen.total_menit) AS totalmenit, tb_detail_skp_dosen.*, tb_logbook_dosen.* FROM `tb_detail_skp_dosen`, tb_logbook_dosen WHERE tb_logbook_dosen.id_detail_skp=tb_detail_skp_dosen.id_detail_skp AND tb_detail_skp_dosen.id_daftar_skp='$a[id_daftar_skp]' GROUP BY tb_detail_skp_dosen.id_detail_skp order by tb_detail_skp_dosen.id_detail_skp ASC");				

					$ii = 1;

				while($kueri=mysql_fetch_array($que)){

					$totalmenit = $kueri['totalmenit']; 

					$jumlah_time1 = $jumlah_time1+$totalmenit;

					

					$targetmenit = $kueri['target_menit'];

					$jumlah_time2 = $jumlah_time2+$targetmenit;

					

					$waktu = ($a['totalmenit']/$kueri['target_menit'])*100;

					if($waktu > 100)

					{

						$waktu = 100;

					}

					else

					{

						$waktu;

					}

					$waktu2 = number_format($waktu, 2, ',', ',');

					$totwaktu = $totwaktu + $waktu2;

				echo"

				<tr>

					<td>&nbsp;</td>

					<td>$ii</td>

					<td>$kueri[uraian_skp]</a></td>

					<td>&nbsp;</td>

					<td>&nbsp;</td>

					<td>$kueri[target_menit]</td>

					<td>&nbsp;</td>

					<td>&nbsp;</td>

					<td>$kueri[totalmenit]</td>

					<td>&nbsp;</td>

					<td>$waktu2 %</td>

				</tr>";



				$ii++;

				   }

				$i++;

				$absen = mysql_query("SELECT * FROM tb_absensi WHERE nip='$_GET[pegawai]' AND month(tanggal) = '$_GET[bulan]' AND year(tanggal) = '$_GET[tahun]'");

				$keterlambatan = 0;

				$q = 1;

				while($absensi = mysql_fetch_array($absen)){

					$keterlambatan0 = explode(":", $absensi['keterlambatan']);

					$keterlambatan1 = $keterlambatan0[0]*60;

					$keterlambatan12 = $keterlambatan0[1];

					$keterlambatan13 = $keterlambatan1 + $keterlambatan12;

					$keterlambatan14 = $keterlambatan13/60;

					$keterlambatan15 = number_format($keterlambatan14, 2, '.', ',');

					$keterlambatan = $keterlambatan+$keterlambatan15;

				}

				$q++;

					}

					else{

						echo"

						<tr>

					<td colspan='2'>Data Logbook Kosong atau Belum Di Verifikasi</td>

				</tr>";

					}

				   }

				   $absensi = mysql_query("SELECT * FROM tb_absensi WHERE nip='$_GET[pegawai]' AND month(tanggal)='$_GET[bulan]' AND year(tanggal)='$_GET[tahun]'");

				   $keterlambatan = 0;

				   $pulangsebelum = 0;

				   $apelpagi = 0;

				   $apelbersama = 0;

				   $tidakditempat = 0;

				   $tidakhadir = 0;

				   $izin = 0;

				   $cuti = 0;

				   $dl = 0;

				   $ab = 1;

				   while($absen=mysql_fetch_array($absensi)){

					   $absen11 = explode(":", $absen['keterlambatan']);

					   $absen12 = $absen11[0]*60;

					   $absen13 = $absen11[1];

					   $absen14 = $absen12 + $absen13;

					   $keterlambatan = $keterlambatan+$absen14;

					   

					   $absen21 = explode(":", $absen['pulang_sebelum']);

					   $absen22 = $absen21[0]*60;

					   $absen23 = $absen21[1];

					   $absen24 = $absen22 + $absen23;

					   $pulangsebelum = $pulangsebelum+$absen24;

					   

					   $absen31 = explode(":", $absen['apel_pagi']);

					   $absen32 = $absen31[0]*60;

					   $absen33 = $absen31[1];

					   $absen34 = $absen32 + $absen33;

					   $apelpagi = $apelpagi+$absen34;

					   

					   $absen41 = explode(":", $absen['apel_bersama']);

					   $absen42 = $absen41[0]*60;

					   $absen43 = $absen41[1];

					   $absen44 = $absen42 + $absen43;

					   $apelbersama = $apelbersama+$absen44;

					   

					   $absen51 = explode(":", $absen['tidak_ditempat_tugas']);

					   $absen52 = $absen51[0]*60;

					   $absen53 = $absen51[1];

					   $absen54 = $absen52 + $absen53;

					   $tidakditempat = $tidakditempat+$absen54;

					   

					   $absen61 = explode(":", $absen['tidak_hadir']);

					   $absen62 = $absen61[0]*60;

					   $absen63 = $absen61[1];

					   $absen64 = $absen62 + $absen63;

					   $tidakhadir = $tidakhadir+$absen64;

					   

					   $absen71 = explode(":", $absen['izin_sakit']);

					   $absen72 = $absen71[0]*60;

					   $absen73 = $absen71[1];

					   $absen74 = $absen72 + $absen73;

					   $izin = $izin+$absen74;

					   

					   $absen81 = explode(":", $absen['cuti']);

					   $absen82 = $absen81[0]*60;

					   $absen83 = $absen81[1];

					   $absen84 = $absen82 + $absen83;

					   $cuti = $cuti+$absen84;

					   

					   $absen91 = explode(":", $absen['dl_non_tusi']);

					   $absen92 = $absen91[0]*60;

					   $absen93 = $absen91[1];

					   $absen94 = $absen92 + $absen93;

					   $dl = $dl+$absen94;

					   

					   if($absen['jenis_cuti'] != NULL){

					   $absen101 = explode(":", '05:00:00');

					   $absen102 = $absen101[0]*60;

					   $absen103 = $absen101[1];

					   $absen104 = $absen102 + $absen103;

					   }

					   else{

						   $absen104 = 0;

					   }

					   $jeniscuti = $jeniscuti + $absen104;

					   

					   $totalab = $keterlambatan+$pulangsebelum+$apelpagi+$apelbersama+$tidakditempat+$tidakhadir+$izin+$cuti+$dl+$jeniscuti;

					   $totalabsen = $totalab/60;

					   $totalabsensi = floor($totalabsen);

					   

					   $hitung4 = floor($totalabsensi * $totalabsensi/100);

						$hitung5 = $hitung3-$hitung4;

				   }

				   $ab++;

				   

				   echo "

				   <tr>

					<td colspan='3'>Jumlah Persentase SKP</td>

					<td>$target</td>

					<td>&nbsp; </td>

					<td>$jumlah_time2 </td>

					<td>$realisasi</td>

					<td>&nbsp; </td>

					<td>$jumlah_time1 </td>

					<td>$hitung11</td>

					<td>$hitung21</td>

				   </tr>

				   <tr>

					<td colspan='9'>TOTAL SKP DAN LOGBOOK SETELAH DIKONVERSI</td>

					<td>$hitung12</td>

					<td>$hitung22</td>

				   </tr>

				   <tr>

					<td colspan='9'>TOTAL (SKP+LOGBOOK)</td>

					<td>$hitung3</td>

					<td>&nbsp;</td>

				   </tr>

				   <tr>

					<td colspan='3'>Pengurang (Kehadiran)</td>

					<td colspan='3'>$totalabsensi JAM</td>

					<td colspan='3'>$totalabsensi %</td>

					<td>$hitung4</td>

					<td>&nbsp;</td>

				   </tr>

				   <tr>

					<td colspan='9'>Nilai Bersih</td>

					<td>$hitung5</td>

					<td>&nbsp;</td>

				   </tr></table>";
// =========================================================== batas =======================================
				  ?>
				  
				  <?php
	$querya = mysql_query("SELECT SUM(tb_logbook.total_menit) AS totalmenit, SUM(tb_detail_skp.alokasi_menit) AS alokasimenit, SUM(tb_detail_skp.target_menit) AS targetmenit, SUM(tb_daftar_skp.target_kegiatan) AS targetkegiatan, SUM(tb_logbook.jumlah_kegiatan_skp) AS jumlahkegiatan, tb_logbook.*, tb_daftar_skp.* , tb_detail_skp.* FROM tb_logbook, `tb_daftar_skp`, tb_detail_skp WHERE tb_logbook.status='Belum di Nilai' AND tb_logbook.nip='$_GET[pegawai]' AND month(bulan) = '$_GET[bulan]' AND year(bulan) = '$_GET[tahun]' AND tb_logbook.id_daftar_skp=tb_daftar_skp.id_daftar_skp AND tb_logbook.id_detail_skp=tb_detail_skp.id_detail_skp GROUP BY tb_daftar_skp.id_daftar_skp order by id_logbook ASC");
	$qra = mysql_query("SELECT * FROM `tb_daftar_skp` as s, tb_pegawai as p WHERE s.nip_penilai=p.nip AND id_daftar_skp='$_GET[id_daftar_skp]'");
					   $qry = mysql_fetch_array($qra);
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
					   $ia = 1;
						$targeta = 0;
						$realisasia = 0;
						$totpersena = 0;
						$totwaktua = 0;
				while($b=mysql_fetch_array($querya)){
					if($b>0){
					$targeta = $targeta+$b['target_kegiatan'];
					$realisasia = $realisasia+$b['jumlahkegiatan'];
					$persena = ($b['jumlahkegiatan'] / $b['target_kegiatan']) * 100;
					if($persena > 100)
					{
						$persena = 100;
					}
					else
					{
						$persena;
					}
					$persen2a = number_format($persena, 2, ',', ',');
					$totpersena = $totpersena+$persen2a;
					$jumenita = substr($b['jumlah_menit'], 0, 5);
					
					$hitung1a = $realisasia/$targeta*50;
					$hitung11a = floor($hitung1a);
					$hitung2a = $jumlah_time1a/$jumlah_time2a*50;
					$hitung21a = floor($hitung2a);
					if($hitung11a>50){ $hitung12a = 50;} elseif($hitung11a<=50){$hitung12a = $hitung11a;}
					if($hitung21a>50){ $hitung22a = 50;} elseif($hitung21a<=50){$hitung22a = $hitung21a;}
					$hitung3a = $hitung12a+$hitung22a;
				echo"
				<tr>
					<td>$ia</td>
					<td colspan='2'>$b[nama_skp]</td>
					<td>$b[target_kegiatan]</td>
					<td>$b[output_kegiatan]</td>
					<td>&nbsp;</td>
					<td>$b[jumlahkegiatan]</td>
					<td>$b[output_kegiatan_skp]</td>
					<td>&nbsp;</td>
					<td>$persen2a %</td>
					<td>&nbsp;</td>
				</tr>";
				$quea=mysql_query("SELECT SUM(tb_logbook.total_menit) AS totalmenit, tb_detail_skp.*, tb_logbook.* FROM `tb_detail_skp`, tb_logbook WHERE tb_logbook.id_detail_skp=tb_detail_skp.id_detail_skp AND tb_detail_skp.id_daftar_skp='$b[id_daftar_skp]' GROUP BY tb_detail_skp.id_detail_skp order by tb_detail_skp.id_detail_skp ASC");				
					$iia = 1;
				while($kueria=mysql_fetch_array($quea)){
					$totalmenita = $kueria['totalmenit']; 
					$jumlah_time1a = $jumlah_time1a+$totalmenita;
					
					$targetmenita = $kueria['target_menit'];
					$jumlah_time2a = $jumlah_time2a+$targetmenita;
					
					$waktua = ($b['totalmenit']/$kueria['target_menit'])*100;
					if($waktua > 100)
					{
						$waktua = 100;
					}
					else
					{
						$waktua;
					}
					$waktu2a = number_format($waktua, 2, ',', ',');
					$totwaktua = $totwaktua + $waktu2a;
				echo"
				<tr>
					<td>&nbsp;</td>
					<td>$iia</td>
					<td>$kueria[uraian_skp]</a></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>$kueria[target_menit]</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>$kueria[totalmenit]</td>
					<td>&nbsp;</td>
					<td>$waktu2a %</td>
				</tr>";

				$iia++;
				   }
				$ia++;
				$absena = mysql_query("SELECT * FROM tb_absensi WHERE nip='$_GET[pegawai]' AND month(tanggal) = '$_GET[bulan]' AND year(tanggal) = '$_GET[tahun]'");
				$keterlambatana = 0;
				$qa = 1;
				while($absensia = mysql_fetch_array($absena)){
					$keterlambatan0a = explode(":", $absensia['keterlambatan']);
					$keterlambatan1a = $keterlambatan0a[0]*60;
					$keterlambatan12a = $keterlambatan0a[1];
					$keterlambatan13a = $keterlambatan1a + $keterlambatan12a;
					$keterlambatan14a = $keterlambatan13a/60;
					$keterlambatan15a = number_format($keterlambatan14a, 2, '.', ',');
					$keterlambatana = $keterlambatana+$keterlambatan15a;
				}
				$qa++;
					}
					else{
						echo"
						<tr>
					<td colspan='2'>Data Logbook Kosong atau Belum Di Verifikasi</td>
				</tr>";
					}
				   }
				   $absensia = mysql_query("SELECT * FROM tb_absensi WHERE nip='$_GET[pegawai]' AND month(tanggal)='$_GET[bulan]' AND year(tanggal)='$_GET[tahun]'");
				   $keterlambatana = 0;
				   $pulangsebeluma = 0;
				   $apelpagia = 0;
				   $apelbersamaa = 0;
				   $tidakditempata = 0;
				   $tidakhadira = 0;
				   $izina = 0;
				   $cutia = 0;
				   $dla = 0;
				   $aba = 1;
				   while($absena=mysql_fetch_array($absensia)){
					   $absen11a = explode(":", $absena['keterlambatan']);
					   $absen12a = $absen11a[0]*60;
					   $absen13a = $absen11a[1];
					   $absen14a = $absen12a + $absen13a;
					   $keterlambatana = $keterlambatana+$absen14a;
					   
					   $absen21a = explode(":", $absena['pulang_sebelum']);
					   $absen22a = $absen21a[0]*60;
					   $absen23a = $absen21a[1];
					   $absen24a = $absen22a + $absen23a;
					   $pulangsebeluma = $pulangsebeluma+$absen24a;
					   
					   $absen31a = explode(":", $absena['apel_pagi']);
					   $absen32a = $absen31a[0]*60;
					   $absen33a = $absen31a[1];
					   $absen34a = $absen32a + $absen33a;
					   $apelpagia = $apelpagia+$absen34a;
					   
					   $absen41a = explode(":", $absena['apel_bersama']);
					   $absen42a = $absen41a[0]*60;
					   $absen43a = $absen41a[1];
					   $absen44a = $absen42a + $absen43a;
					   $apelbersamaa = $apelbersamaa+$absen44a;
					   
					   $absen51a = explode(":", $absena['tidak_ditempat_tugas']);
					   $absen52a = $absen51a[0]*60;
					   $absen53a = $absen51a[1];
					   $absen54a = $absen52a + $absen53a;
					   $tidakditempata = $tidakditempata+$absen54a;
					   
					   $absen61a = explode(":", $absena['tidak_hadir']);
					   $absen62a = $absen61a[0]*60;
					   $absen63a = $absen61a[1];
					   $absen64a = $absen62a + $absen63a;
					   $tidakhadira = $tidakhadira+$absen64a;
					   
					   $absen71a = explode(":", $absena['izin_sakit']);
					   $absen72a = $absen71a[0]*60;
					   $absen73a = $absen71a[1];
					   $absen74a = $absen72a + $absen73a;
					   $izina = $izina+$absen74a;
					   
					   $absen81a = explode(":", $absena['cuti']);
					   $absen82a = $absen81a[0]*60;
					   $absen83a = $absen81a[1];
					   $absen84a = $absen82a + $absen83a;
					   $cutia = $cutia+$absen84a;
					   
					   $absen91a = explode(":", $absena['dl_non_tusi']);
					   $absen92a = $absen91a[0]*60;
					   $absen93a = $absen91a[1];
					   $absen94a = $absen92a + $absen93a;
					   $dla = $dla+$absen94a;
					   
					   if($absena['jenis_cuti'] != NULL){
					   $absen101a = explode(":", '05:00:00');
					   $absen102a = $absen101a[0]*60;
					   $absen103a = $absen101a[1];
					   $absen104a = $absen102a + $absen103a;
					   }
					   else{
						   $absen104a = 0;
					   }
					   $jeniscutia = $jeniscutia + $absen104a;
					   
					   $totalaba = $keterlambatana+$pulangsebeluma+$apelpagia+$apelbersamaa+$tidakditempata+$tidakhadira+$izina+$cutia+$dla+$jeniscutia;
					   $totalabsena = $totalaba/60;
					   $totalabsensia = floor($totalabsena);
					   
					   $hitung4a = floor($totalabsensia * $totalabsensia/100);
						$hitung5a = $hitung3a-$hitung4a;
				   }
				   $aba++;
				   
				   echo "
				   <tr>
					<td colspan='3'>Jumlah Persentase SKP</td>
					<td>$targeta</td>
					<td>&nbsp; </td>
					<td>$jumlah_time2a </td>
					<td>$realisasia</td>
					<td>&nbsp; </td>
					<td>$jumlah_time1a </td>
					<td>$hitung11a</td>
					<td>$hitung21a</td>
				   </tr>
				   <tr>
					<td colspan='9'>TOTAL SKP DAN LOGBOOK SETELAH DIKONVERSI</td>
					<td>$hitung12a</td>
					<td>$hitung22a</td>
				   </tr>
				   <tr>
					<td colspan='9'>TOTAL (SKP+LOGBOOK)</td>
					<td>$hitung3a</td>
					<td>&nbsp;</td>
				   </tr>
				   <tr>
					<td colspan='3'>Pengurang (Kehadiran)</td>
					<td colspan='3'>$totalabsensia JAM</td>
					<td colspan='3'>$totalabsensia %</td>
					<td>$hitung4a</td>
					<td>&nbsp;</td>
				   </tr>
				   <tr>
					<td colspan='9'>Nilai Bersih</td>
					<td>$hitung5a</td>
					<td>&nbsp;</td>
				   </tr></table>";
				  ?>



		



</body>

</html>