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
                    <h2>SKP Bulanan </h2>   
                </div>
            </div> 
                <hr />
            <div>

                <table class="table table-bordered">   
                    <tr class="info">
                        <td colspan="4"><b>Data Pegawai</b></td>
                    </tr>

                    <tr>
                        <td width="15%">NIP</td>
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



	<div>
	    <form method="post" action="" enctype="multipart/form-data">    
	        <table width="100%" class= "table table-bordered" style="width:50%;">    
	            <tr>
		            <td><b>Lihat data SKP</b></td>
		            <td><select class="form-control" name="bulan">
							<?php for($bln = 1; $bln < 13 ;$bln++){
		                        echo "<option value='$bln'>$bln</option>";
		                    }?>
		                    </select></td>
		            <td><select class="form-control" name="tahun">
								<?php
									for($thn = (date('Y')-1);$thn <= date('Y');$thn++){
										echo "<option value='$thn'>$thn</option>";
									}
								?>
							</select></td>
	              	<td align="center"><input type="submit" name="submit" value="Proses" class="btn btn-danger"></td>
	            </tr>
	        </table>
	    </form>   
	</div>
</div>
                   <?php
				   require_once("../config/koneksi.php");
				   if(isset($_POST['submit']))
				   {
					   $query = mysql_query("SELECT * FROM `tb_daftar_skp` WHERE nip='$_SESSION[nip]' AND month(bulan) = '$_POST[bulan]' AND year(bulan) = '$_POST[tahun]'");
					   $a=mysql_fetch_array($query);
					   echo "<table class='table table-bordered'>   
                      	<tr>
	                        <td><b>Tanggal</b></td>
	                        <td>:</td>
	                        <td>$a[bulan]</td>
							<td><a href='03_cetak_target.php?id_daftar_skp=$a[id_daftar_skp]&pegawai=$_SESSION[nip]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' target='_blank'><input type=button value='Cetak Target' class='btn btn-primary'></a></td>
							<td><a href='03_lihat_realisasi.php?id_daftar_skp=$a[id_daftar_skp]&pegawai=$_SESSION[nip]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' target='_blank'><input type=button value='Lihat Realisasi' class='btn btn-info'></a></td>
							<td><a href='03_cetak_realisasi.php?id_daftar_skp=$a[id_daftar_skp]&pegawai=$_SESSION[nip]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' target='_blank'><input type=button value='Cetak Realisasi' class='btn btn-success'></a></td>
                      	</tr>   

                  </table><br />

				  <table class='table table-bordered table-striped'>
                    <thead>		
		  					<tr class='info'>
								<th width='5%' rowspan='2'><center>No.</center></th><th rowspan='2' colspan='2'><center>KEGIATAN TUGAS POKOK JABATAN</center></th><th colspan='3'><center>Target Kegiatan</center></th><th colspan='2'><center>Target Waktu</center></th><th width='10%' rowspan='2'><center>Aksi</center></th>
							</tr>
							<tr class='info'>
								<th>Kuantitas</th><th>Output</th><th>Mutu (%)</th><th>Waktu</th><th>Output</th>
							</tr>
					</thead>";
					$qr=mysql_query("SELECT * FROM `tb_daftar_skp` WHERE nip='$_SESSION[nip]' AND month(bulan) = '$_POST[bulan]' AND year(bulan) = '$_POST[tahun]' order by id_daftar_skp asc");
					$i = 1;
					$target = 0;
					$totalwaktu = 0;

				while($qry=mysql_fetch_array($qr)){
					$target = $target+$qry['target_kegiatan'];
				echo"
				<tr>
					<td>$i</td>

					<td colspan='2'><a href='03_tambah_detail_skp.php?id_daftar_skp=$qry[id_daftar_skp]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' title='Tambah Detail SKP'>$qry[nama_skp]</a></td>
					<td>$qry[target_kegiatan]</td>
					<td>$qry[output_kegiatan]</td>
					<td>$qry[mutu]</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>";

					if($qry['status'] == "Sudah Di Nilai")

					{

						echo "

						<td>

							<button class='btn btn-success btn-xs'><i class='glyphicon glyphicon-ok'></i></button>

						</td>

						";

					}

					else

					{

						echo "

						<td>

							<a href='03_edit_skp.php?id_daftar_skp=$qry[id_daftar_skp]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' class='btn btn-danger btn-xs'>

								<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>

							</a> 



							<a href='03_delete_skp.php?id_daftar_skp=$qry[id_daftar_skp]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' onclick='return confirm(\"Anda yakin akan menghapus $qry[nama_skp] ?\")' class='btn btn-danger btn-xs'>

								<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>

							</a>

						</td>

						";

					}

					echo "

				</tr>";

				$que=mysql_query("SELECT * FROM `tb_detail_skp` WHERE id_daftar_skp='$qry[id_daftar_skp]' order by id_detail_skp asc");				

					$ii = 1;

				while($kueri=mysql_fetch_array($que)){
					$waktu = explode(":", $kueri['target_waktu']);
					$waktu2 = $waktu[0];
					$waktu3 = $waktu[1]/60;
					$waktu4 = $waktu2 + $waktu3;
					$totalwaktu = $totalwaktu+$waktu4;

				echo"

				<tr>

					<td>&nbsp;</td>

					<td>$ii</td>

					<td>$kueri[uraian_skp]</a></td>

					<td>&nbsp;</td>

					<td>&nbsp;</td>

					<td>&nbsp;</td>

					<td>$waktu4</td>

					<td>Jam</td>

					<td>

						<a href='03_edit_detail_skp.php?id_detail_skp=$kueri[id_detail_skp]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' class='btn btn-danger btn-xs'>

							<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>

						</a>

						

						<a href='03_delete_detail_skp.php?id_detail_skp=$kueri[id_detail_skp]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' onclick='return confirm(\"Anda yakin akan menghapus Uraian Pekerjaan $qry[uraian_skp] ?\")' class='btn btn-danger btn-xs'>

							<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>

						</a>

					</td>

				</tr>";



				$ii++;

				   }



				$i++;

				   }
				   echo "<tr>
							<td colspan='3'>TOTAL</td>
							<td>$target</td>
							<td colspan=2>Dokumen/Examplar</td>
							<td>$totalwaktu</td>
							<td colspan=2>Jam</td>
						</tr></table>";

				   }

				   elseif(!empty($_GET['bulan']))

				   {

					

					   $query = mysql_query("SELECT * FROM `tb_daftar_skp` WHERE nip='$_SESSION[nip]' AND month(bulan) = '$_GET[bulan]' AND year(bulan) = '$_GET[tahun]'");

					   $a=mysql_fetch_array($query);

					   echo "<table class='table table-bordered'>   

                      <tr>

                          <td><b>Tanggal</b></td>

                          <td>:</td>

                          <td>$a[bulan]</td>

						  <td><a href='03_cetak_target.php?id_daftar_skp=$a[id_daftar_skp]&pegawai=$_SESSION[nip]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' target='_blank'><input type=button value='Cetak Target' class='btn btn-primary'></a></td>
							<td><a href='03_lihat_realisasi.php?id_daftar_skp=$a[id_daftar_skp]&pegawai=$_SESSION[nip]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' target='_blank'><input type=button value='Lihat Realisasi' class='btn btn-info'></a></td>
							<td><a href='03_cetak_realisasi.php?id_daftar_skp=$a[id_daftar_skp]&pegawai=$_SESSION[nip]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' target='_blank'><input type=button value='Cetak Realisasi' class='btn btn-success'></a></td>

                      </tr>   

                  </table><br />

				  <table class='table table-bordered table-striped'>

                    <thead>		

		  					<tr class='info'>

								<th width='5%' rowspan='2'><center>No.</center></th><th rowspan='2' colspan='2'><center>KEGIATAN TUGAS POKOK JABATAN</center></th><th colspan='3'><center>Target Kegiatan</center></th><th colspan='2'><center>Target Waktu</center></th><th width='10%' rowspan='2'><center>Aksi</center></th>

							</tr>

							<tr class='info'>

								<th>Kuantitas</th><th>Output</th><th>Mutu (%)</th><th>Waktu</th><th>Output</th>

							</tr>

					</thead>";

							

					$qr=mysql_query("SELECT * FROM `tb_daftar_skp` WHERE nip='$_SESSION[nip]' AND month(bulan) = '$_GET[bulan]' AND year(bulan) = '$_GET[tahun]' order by id_daftar_skp asc");

				

					$i = 1;
					$target = 0;
					$totalwaktu = 0;

				while($qry=mysql_fetch_array($qr)){
					$target = $target+$qry['target_kegiatan'];

				echo"

				<tr>

					<td>$i</td>

					<td colspan='2'><a href='03_tambah_detail_skp.php?id_daftar_skp=$qry[id_daftar_skp]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' title='Tambah Detail SKP'>$qry[nama_skp]</a></td>

					<td>$qry[target_kegiatan]</td>

					<td>$qry[output_kegiatan]</td>

					<td>$qry[mutu]</td>

					<td>&nbsp;</td>
					<td>&nbsp;</td>";

					if($qry['status'] == "Sudah Di Nilai")

					{

						echo "

						<td>

							<button class='btn btn-success btn-xs'><i class='glyphicon glyphicon-ok'></i></button>

						</td>

						";

					}

					else

					{

						echo "

						<td>

							<a href='03_edit_skp.php?id_daftar_skp=$qry[id_daftar_skp]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' class='btn btn-danger btn-xs'>

								<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>

							</a> 



							<a href='03_delete_skp.php?id_daftar_skp=$qry[id_daftar_skp]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' onclick='return confirm(\"Anda yakin akan menghapus $qry[nama_skp] ?\")' class='btn btn-danger btn-xs'>

								<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>

							</a>

						</td>

						";

					}

					echo "

				</tr>";

				$que=mysql_query("SELECT * FROM `tb_detail_skp` WHERE id_daftar_skp='$qry[id_daftar_skp]' order by id_detail_skp asc");				

					$ii = 1;

				while($kueri=mysql_fetch_array($que)){
					$waktu = explode(":", $kueri['target_waktu']);
					$waktu2 = $waktu[0];
					$waktu3 = $waktu[1]/60;
					$waktu4 = $waktu2 + $waktu3;
					$totalwaktu = $totalwaktu+$waktu4;

				echo"

				<tr>

					<td>&nbsp;</td>

					<td>$ii</td>

					<td>$kueri[uraian_skp]</a></td>

					<td>&nbsp;</td>

					<td>&nbsp;</td>

					<td>&nbsp;</td>

					<td>$kueri[target_waktu]</td>

					<td>Jam</td>

					<td>

						<a href='03_edit_detail_skp.php?id_detail_skp=$kueri[id_detail_skp]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' class='btn btn-danger btn-xs'>

							<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>

						</a>

						

						<a href='03_delete_detail_skp.php?id_detail_skp=$kueri[id_detail_skp]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' onclick='return confirm(\"Anda yakin akan menghapus Uraian Pekerjaan $qry[uraian_skp] ?\")' class='btn btn-danger btn-xs'>

							<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>

						</a>

					</td>

				</tr>";



				$ii++;

				   }



				$i++;

				   }
				   echo "<tr>
							<td colspan='3'>TOTAL</td>
							<td>$target</td>
							<td colspan=2>Dokumen/Examplar</td>
							<td>$totalwaktu</td>
							<td colspan=2>Jam</td>
						</tr></table>";

				   }

				  ?>
                  </div>
            </div>
        </div>
    </div> 

		<script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/dataTables.bootstrap.js"></script>	
        <script type="text/javascript">
            $(function() {

                $('#example1').dataTable();

            });
        </script>  
           </body>