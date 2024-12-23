<?php
	include"01_nav.php";
	include "../assets/js/date.php";
	include("fucnt_tgl.php");
	error_reporting(0); 
	error_reporting(0);
	$query = mysql_query("SELECT * FROM tb_pegawai WHERE nip='$_GET[pegawai]'");
	$qr = mysql_fetch_array($query);
?>


<body>
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Target SKP Pegawai </h2>   
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
                        <td><?php echo $qr['nip'];?></td>
                    </tr>

                    <tr>
                        <td>Nama Pegawai</td>
                        <td width="2%">:</td>
                        <td><?php echo $qr['nama_lengkap'];?></td>
                    </tr>
                    
                    <tr>
                       	<td>Unit Kerja</td>
                        <td width="2%">:</td>
                        <td><?php echo $qr['unit_kerja'];?></td>
                    </tr>

                    <tr>
                        <td>Jabatan</td>
                        <td width="2%">:</td>
                        <td><?php echo $qr['jabatan'];?></td>
                   	</tr>
                </table>



	<div>
	    <form method="post" action="" enctype="multipart/form-data">    
	        <table width="100%" class= "table table-bordered" style="width:50%;">    
	            <tr>
		            <td><b>Lihat data SKP</b></td>
		            <td><input type="hidden" name="nip" value="<?php echo $_GET['pegawai']; ?>">
					<select class="form-control" name="bulan">
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
					   $query = mysql_query("SELECT * FROM `tb_daftar_skp` WHERE nip='$_POST[nip]' AND month(bulan) = '$_POST[bulan]' AND year(bulan) = '$_POST[tahun]'");
					   $a=mysql_fetch_array($query);
					   
					   $query11 = mysql_query("SELECT * FROM tb_pengaturan_skp WHERE month(tanggal_pengaturan_skp) = '$_POST[bulan]' AND year(tanggal_pengaturan_skp) = '$_POST[tahun]' AND nip_pegawai='$_POST[nip]'");
					   $dapat = mysql_fetch_array($query11);
					   echo "<table class='table table-bordered'>   
                      	<tr>
	                        <td width='5%'>Bulan</td>
	                        <td width='2%'>:</td>
	                        <td width='5%'>$a[bulan]</td>
	                    </tr>
	                    <tr>
	                        <td>Status SKP</td>
	                        <td>:</td>
	                        <td>";if($dapat['status_pengaturan_skp'] == 'Y'){ echo "SKP Terkunci";} else{ echo "SKP Tidak Terkunci";} echo "</td>
	                    </tr>
	                    <tr>
							<td><a href='11_cetak_target_skp_pegawai.php?id_daftar_skp=$a[id_daftar_skp]&pegawai=$a[nip]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' target='_blank'><input type=button value='Cetak Target SKP Pegawai' class='btn btn-success'></a></td>
							<td colspan='2'><a href='11_verifikasi_target_skp_pegawai.php?pegawai=$a[nip]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' target='_blank'><input type=button value='Verifikasi Target SKP' class='btn btn-success'></a></td>
							<td><a href='11_cetak_realisasi_skp_pegawai.php?id_daftar_skp=$a[id_daftar_skp]&pegawai=$a[nip]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' target='_blank'><input type=button value='Cetak Realisasi SKP Pegawai' class='btn btn-success'></a></td>
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
					$qr=mysql_query("SELECT * FROM `tb_daftar_skp` WHERE nip='$_POST[nip]' AND month(bulan) = '$_POST[bulan]' AND year(bulan) = '$_POST[tahun]' order by id_daftar_skp asc");
					$i = 1;
					$target = 0;
					$totalwaktu = 0;

				while($qry=mysql_fetch_array($qr)){
					$target = $target+$qry['target_kegiatan'];
					$query11 = mysql_query("SELECT * FROM tb_pengaturan_skp WHERE month(tanggal_pengaturan_skp) = '$_POST[bulan]' AND year(tanggal_pengaturan_skp) = '$_POST[tahun]' AND nip_pegawai='$_POST[nip]'");
					$dapat = mysql_fetch_array($query11);
				echo"
				<tr>
					<td>$i</td>

					<td colspan='2'><a href='11_tambah_detail_target_skp_pegawai.php?pegawai=$_POST[nip]&id_daftar_skp=$qry[id_daftar_skp]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' title='Tambah Detail SKP'>$qry[nama_skp]</a></td>
					<td>$qry[target_kegiatan]</td>
					<td>$qry[output_kegiatan]</td>
					<td>$qry[mutu]</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>";
					
					if($dapat['status_pengaturan_skp'] == 'Y')
					{
						echo "

						<td>

							<a href='#' class='btn btn-danger btn-xs' disabled >

								<span class='glyphicon glyphicon-lock' aria-hidden='true'></span>

							</a>

						</td>

						";
					}
					else
					{
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
								<a href='11_edit_target_skp_pegawai.php?id_daftar_skp=$qry[id_daftar_skp]&pegawai=$_GET[pegawai]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' class='btn btn-danger btn-xs'>
									<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
								</a>
								
								<a href='11_delete_target_skp_pegawai.php?pegawai=$_POST[nip]&id_daftar_skp=$qry[id_daftar_skp]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' onclick='return confirm(\"Anda yakin akan menghapus $qry[nama_skp] ?\")' class='btn btn-danger btn-xs'>
									<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
								</a>
							</td>
							";
						}
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

					<td>";
					if($dapat['status_pengaturan_skp'] == 'Y')
					{
						echo "
							<a href='#' class='btn btn-danger btn-xs' disabled >

								<span class='glyphicon glyphicon-lock' aria-hidden='true'></span>

							</a>

						";
					}
					else
					{
						echo"
						<a href='03_edit_detail_skp.php?id_detail_skp=$kueri[id_detail_skp]&pegawai=$_POST[nip]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' class='btn btn-danger btn-xs'>

							<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>

						</a>

						

						<a href='11_delete_detail_target_skp_pegawai.php?pegawai=$_POST[nip]&id_detail_skp=$kueri[id_detail_skp]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' onclick='return confirm(\"Anda yakin akan menghapus Uraian Pekerjaan $qry[uraian_skp] ?\")' class='btn btn-danger btn-xs'>

							<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>

						</a>";
					}
					echo "

					</td>

				</tr>";



				$ii++;

				   }



				$i++;

				   }
				   echo "<tr>
							<td colspan='3'>TOTAL</td>
							<td>$target</td>
							<td colspan=2>Dokumen</td>
							<td>$totalwaktu</td>
							<td colspan=2>Jam</td>
						</tr></table>";

				   }

				   elseif(!empty($_GET['bulan']))

				   {

					

					   $query = mysql_query("SELECT * FROM `tb_daftar_skp` WHERE nip='$_GET[pegawai]' AND month(bulan) = '$_GET[bulan]' AND year(bulan) = '$_GET[tahun]'");

					   $a=mysql_fetch_array($query);
					   $query11 = mysql_query("SELECT * FROM tb_pengaturan_skp WHERE month(tanggal_pengaturan_skp) = '$_GET[bulan]' AND year(tanggal_pengaturan_skp) = '$_GET[tahun]' AND nip_pegawai='$_GET[pegawai]'");
					   $dapat = mysql_fetch_array($query11);
					   echo "<table class='table table-bordered'>   
                      	<tr>
	                        <td width='5%'>Bulan</td>
	                        <td width='2%'>:</td>
	                        <td width='5%'>$a[bulan]</td>
	                    </tr>
	                    <tr>
	                        <td>Status SKP</td>
	                        <td>:</td>
	                        <td>";if($dapat['status_pengaturan_skp'] == 'Y'){ echo "SKP Terkunci";} else{ echo "SKP Tidak Terkunci";} echo "</td>
	                    </tr>
	                    <tr>
							<td><a href='11_cetak_target_skp_pegawai.php?id_daftar_skp=$a[id_daftar_skp]&pegawai=$a[nip]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' target='_blank'><input type=button value='Cetak Target SKP Pegawai' class='btn btn-success'></a></td>
							<td colspan='2'><a href='11_verifikasi_target_skp_pegawai.php?pegawai=$a[nip]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' target='_blank'><input type=button value='Verifikasi Target SKP' class='btn btn-success'></a></td>
							<td><a href='11_cetak_realisasi_skp_pegawai.php?id_daftar_skp=$a[id_daftar_skp]&pegawai=$a[nip]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' target='_blank'><input type=button value='Cetak Realisasi SKP Pegawai' class='btn btn-success'></a></td>
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

							

					$qr=mysql_query("SELECT * FROM `tb_daftar_skp` WHERE nip='$_GET[pegawai]' AND month(bulan) = '$_GET[bulan]' AND year(bulan) = '$_GET[tahun]' order by id_daftar_skp asc");

				

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

					if($dapat['status_pengaturan_skp'] == 'Y')
					{
						echo "

						<td>

							<a href='#' class='btn btn-danger btn-xs' disabled >

								<span class='glyphicon glyphicon-lock' aria-hidden='true'></span>

							</a>

						</td>

						";
					}
					else
					{
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
								<a href='11_edit_target_skp_pegawai.php?pegawai=$_GET[pegawai]&id_daftar_skp=$qry[id_daftar_skp]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' class='btn btn-danger btn-xs'>
									<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
								</a>
								
								<a href='11_delete_target_skp_pegawai.php?pegawai=$_GET[pegawai]&id_daftar_skp=$qry[id_daftar_skp]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' onclick='return confirm(\"Anda yakin akan menghapus $qry[nama_skp] ?\")' class='btn btn-danger btn-xs'>
									<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
								</a>
							</td>
							";
						}
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

					<td>";
					if($dapat['status_pengaturan_skp'] == 'Y')
					{
						echo "
							<a href='#' class='btn btn-danger btn-xs' disabled >

								<span class='glyphicon glyphicon-lock' aria-hidden='true'></span>

							</a>

						";
					}
					else
					{
						echo"
						<a href='11_edit_detail_target_skp_pegawai.php?pegawai=$_GET[pegawai]&id_detail_skp=$kueri[id_detail_skp]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' class='btn btn-danger btn-xs'>

							<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>

						</a>

						

						<a href='11_delete_detail_target_skp_pegawai.php?pegawai=$_GET[pegawai]&id_detail_skp=$kueri[id_detail_skp]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' onclick='return confirm(\"Anda yakin akan menghapus Uraian Pekerjaan $qry[uraian_skp] ?\")' class='btn btn-danger btn-xs'>

							<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>

						</a>";
					}
					
					echo "
					</td>

				</tr>";



				$ii++;

				   }



				$i++;

				   }
				   echo "<tr>
							<td colspan='3'>TOTAL</td>
							<td>$target</td>
							<td colspan=2>Dokumen</td>
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