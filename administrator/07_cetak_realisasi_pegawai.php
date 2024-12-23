<?php
	include"01_nav.php";
	include "../assets/js/date.php";
	include("fucnt_tgl.php");
	error_reporting(0); 
?>


<body>
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                   	<h2>Realisasi Bulanan </h2>   
                </div>
            </div> 
                  <hr/>

		  

<?php

	require_once("../config/koneksi.php");
	if(isset($_POST['submit'])){
		$query = mysql_query("SELECT SUM(tb_logbook.jumlah_kegiatan_skp) AS jumlahkegiatan, tb_logbook.*, tb_pegawai.*, tb_daftar_skp.* FROM `tb_logbook`, tb_pegawai, tb_daftar_skp WHERE tb_logbook.id_daftar_skp=tb_daftar_skp.id_daftar_skp AND tb_logbook.nip=tb_pegawai.nip AND month(tanggal_logbook) = '$_POST[bulan]' AND year(tanggal_logbook) = '$_POST[tahun]' GROUP BY tb_pegawai.nip order by nama_lengkap asc");

		$jumlah = mysql_num_rows($query);

		if($query)

		{

			echo"<div class='box-body table-responsive'>
				<table id='example1' class='table table-bordered table-striped'>
					<thead>
						<tr class='info'>
							<th width='5%'>No.</th><th>NIP</th><th>Nama Pegawai</th><th>Status</th><th>Logbook/Tugas Tambahan</th><th>Dosen Murni</th>
						</tr>
					</thead>";
			$i =  +1;

			while($a=mysql_fetch_array($query)){

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

				$b = mysql_fetch_array(mysql_query("SELECT SUM(tb_logbook_dosen.jumlah_kegiatan_skp) AS jumlahkegiatan, tb_logbook_dosen.*, tb_pegawai.*, tb_daftar_skp_dosen.* FROM `tb_logbook_dosen`, tb_pegawai, tb_daftar_skp_dosen WHERE tb_logbook_dosen.id_daftar_skp=tb_daftar_skp_dosen.id_daftar_skp AND tb_logbook_dosen.nip=tb_pegawai.nip AND month(tanggal_logbook) = '$_POST[bulan]' AND year(tanggal_logbook) = '$_POST[tahun]' AND tb_logbook_dosen.nip='$a[nip]' GROUP BY tb_pegawai.nip order by nama_lengkap asc"));

				

				$persen3 = ($b['jumlahkegiatan'] / $b['target_kegiatan']) * 100;

				if($persen3 > 100)

				{

					$persen3 = 100;

				}

				else

				{

					$persen3;

				}

				$persen4 = number_format($persen3, 2, ',', ',');

            echo"
				<tr>
					<td>$i</td><td>$a[nip]</td><td>$a[nama_lengkap]</td><td>$a[level]</td><td>$persen2 %</td><td> $persen4 %</td>
				</tr>

              "; 

				$i++;
			}
		}
	}
?>

			</div>
		</div>
	</div>
