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
                $qr = mysql_query("SELECT * FROM `tb_daftar_skp` as s, tb_pegawai as p WHERE id_daftar_skp='$_GET[id_daftar_skp]'");
                $qry = mysql_fetch_array($qr);
                $tgl = tgl_baru($qry['bulan']);
            ?>

            <?php
                $qr = mysql_query("SELECT nip_atasan FROM tb_pegawai WHERE nip='$_SESSION[nip]'");
                $qry = mysql_fetch_array($qr);
                $atasan = $qry['nip_atasan'];
                $qr2 = mysql_query("SELECT nama_lengkap, jabatan, unit_kerja FROM tb_pegawai WHERE nip='$atasan'");
                $qry2 = mysql_fetch_array($qr2);
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

                <table class="table table-bordered" style="font-size:12;text-transform:uppersize;">
                    <tr>
                        <td colspan="6" align="center"><b>TARGET SASARAN KINERJA PEGAWAI (SKP) </b></td>
                    </tr>

                    <tr>
                        <td colspan="6" align="center"><b>BULAN <?php echo $tgl; ?></b></td>
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
                        <td><?php echo $qry2['nama_lengkap']; ?></td>
                        <td>1.</td>
                        <td>Nama</td>
                        <td><?php echo $_SESSION['nama_lengkap'];?></td>
                    </tr>

                    <tr>
                        <td>2.</td>
                        <td>NIP</td>
                        <td><?php echo $atasan; ?></td>
                        <td>2.</td>
                        <td>NIP</td>
                        <td><?php echo $_SESSION['nip'];?></td>
                    </tr>

                    <tr>
                        <td>4.</td>
                        <td>Jabatan</td>
                        <td><?php echo $qry2['jabatan'];?></td>
                        <td>4.</td>
                        <td>Jabatan</td>
                        <td><?php echo $_SESSION['jabatan'];?></td>
                    </tr>

                    <tr>
                        <td>5.</td>
                        <td>Unit Kerja</td>
                        <td><?php echo $qry2['unit_kerja'];?></td>
                        <td>5.</td>
                        <td>Unit Kerja</td>
                        <td><?php echo $_SESSION['unit_kerja'];?></td>
                    </tr>

                  </table>

                <br/>
                <?php
                    $query = mysql_query("SELECT * FROM `tb_daftar_skp` WHERE nip='$_GET[pegawai]' AND month(bulan) = '$_GET[bulan]' AND year(bulan) = '$_GET[tahun]' order by id_daftar_skp asc");
                           echo "<table id='example1' class='table table-bordered table-striped' style='font-size:12;'>
                                    <thead>
                                        <tr class='info'>
                                            <th width='5%' rowspan='2'><center>No.</center></th><th rowspan='2' colspan='2'><center>KEGIATAN TUGAS POKOK JABATAN</center></th><th colspan='2'><center>Target Kegiatan</center></th><th colspan='2'><center>Target Waktu</center></th>
                                        </tr>

                                        <tr class='info'>
                                            <th>Kuantitas</th><th>Output</th><th>Waktu</th><th>Output</th>
                                        </tr>
                                   </thead>";
                                            $i = 1;
                                            $target = 0;
											$totaltime = 0;
                                            while($a=mysql_fetch_array($query))
                                                {
                                                    $target = $target+$a['target_kegiatan'];
                                                    echo"
                                                        <tr>
                                                            <td>$i</td>
                                                            <td colspan='2'>$a[nama_skp]</td>
                                                            <td>$a[target_kegiatan]</td>
                                                            <td>$a[output_kegiatan]</td>
                                                            <td></td>
                                                            <td>&nbsp;</td>
                                                        </tr>";
                                                    $que=mysql_query("SELECT * FROM `tb_detail_skp` WHERE id_daftar_skp='$a[id_daftar_skp]' order by id_detail_skp asc");           
                                                    $ii = 1;
                                                    while($kueri=mysql_fetch_array($que))
                                                    {
														$waktu = explode(":", $kueri['target_waktu']);
														$waktu2 = $waktu[0];
														$waktu3 = $waktu[1]/60;
														$waktu4 = $waktu2 + $waktu3;
														$totaltime = $totaltime+$waktu4;
                                                        echo"
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td>$ii</td>
                                                            <td>$kueri[uraian_skp]</a></td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>$waktu4</td>
                                                            <td>Jam</td>
                                                        </tr>";

                                                        $ii++;
                                                    }
                                                    $i++;
                                                }

                                       echo "<tr>
                                                <td colspan='3'>TOTAL</td>
                                                <td>$target</td>
                                                <td>SKS</td>
                                                <td>$totaltime</td>
                                                <td>Jam</td>
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

                    <?php
                        $qr = mysql_query("SELECT nip_atasan FROM tb_pegawai WHERE nip='$_SESSION[nip]'");
                        $qry = mysql_fetch_array($qr);
                        $atasan = $qry['nip_atasan'];
                        $qr2 = mysql_query("SELECT nama_lengkap FROM tb_pegawai WHERE nip='$atasan'");
                        $qry2 = mysql_fetch_array($qr2);
                    ?>

                    <tr>
                        <td style="text-transform:uppersize;"><u><b><?php echo $qry2['nama_lengkap']; ?></b></u></td>
                        <td style="text-transform:uppersize;"><u><b><?php echo $_SESSION['nama_lengkap'];?></b></u></td>
                    </tr>

                    <tr>
                        <td>NIP. <?php echo $atasan; ?> </td><td>NIP. <?php echo $_SESSION['nip'];?></td>
                    </tr>
                </table>
    </body>
</html>
<?php
/**
<script>
  window.print();
</script>
**/
?>