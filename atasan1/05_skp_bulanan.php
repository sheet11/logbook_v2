<?php
include"01_nav.php";
include "../assets/js/date.php";
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
					</select>
			  </td>
       
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
					   $query = mysql_query("SELECT * FROM `tb_daftar_skp` WHERE nip='$_GET[pegawai]' AND month(bulan) = '$_POST[bulan]' AND year(bulan) = '$_POST[tahun]'");
					   $a=mysql_fetch_array($query);
					   echo "<table border='0' width='35%'>   
                      <tr>
                          <td><b>Tanggal</b></td>
                          <td>:</td>
                          <td>$a[bulan]</td>
                      </tr>   
                  </table><br />
				  <table class='table table-bordered table-striped'>
                    <thead>		
		  					<tr class='info'>
								<th width='5%'>No.</th><th>Nama SKP</th><th>Target</th><th>Kegiatan</th><th width='10%'>Aksi</th>
							</tr>
					</thead>";
							
					$qr=mysql_query("SELECT * FROM `tb_daftar_skp` WHERE nip='$_GET[pegawai]' AND month(bulan) = '$_POST[bulan]' AND year(bulan) = '$_POST[tahun]' order by id_daftar_skp asc");
				
					$i = 1;
						$target = 0;
				while($qry=mysql_fetch_array($qr)){
					$target = $target+$qry['target_kegiatan'];
				echo"
				<tr>
					<td>$i</td>
					<td>$qry[nama_skp]</td>
					<td>$qry[target_kegiatan]</td>
					<td>$qry[output_kegiatan]</td>";
					if($a['status'] == "Sudah Di Nilai")
					{
						echo "
						<td>
							<span>Sudah Di Nilai</span>
						</td>
						";
					}
					else
					{
						echo "
						<td>
							<a href='05_nilai_skp.php?id_daftar_skp=$a[id_daftar_skp]&nip=$_SESSION[nip]&pegawai=$pg[nip]&bulan=$_POST[bulan]&tahun=$_POST[tahun]'>
								<span>Nilai</span>
							</a>
						</td>
						";
					}
					echo "
				</tr>";

				$i++;
				   }
				   echo "<tr><td colspan='2'>TOTAL</td><td>$target</td><td colspan='2'></td></tr></table>";
				   }
				   elseif(!empty($_GET['bulan']))
				   {
					
					   $query = mysql_query("SELECT * FROM `tb_daftar_skp` WHERE nip='$_GET[pegawai]' AND month(bulan) = '$_GET[bulan]' AND year(bulan) = '$_GET[tahun]'");
					   $a=mysql_fetch_array($query);
					   echo "<table border='0' width='35%'>   
                      <tr>
                          <td><b>Tanggal</b></td>
                          <td>:</td>
                          <td>$a[bulan]</td>
                      </tr>   
                  </table><br />
				  <table class='table table-bordered table-striped'>
                    <thead>		
		  					<tr class='info'>
								<th width='5%'>No.</th><th>Nama SKP</th><th>Target</th><th>Kegiatan</th><th width='10%'>Aksi</th>
							</tr>
					</thead>";
							
					$qr=mysql_query("SELECT * FROM `tb_daftar_skp` WHERE nip='$_GET[pegawai]' AND month(bulan) = '$_GET[bulan]' AND year(bulan) = '$_GET[tahun]' order by id_daftar_skp asc");
				
					$i = 1;		
						$target = 0;
				while($qry=mysql_fetch_array($qr)){
					$target = $target+$qry['target_kegiatan'];
				echo"
				<tr>
					<td>$i</td>
					<td>$qry[nama_skp]</td>
					<td>$qry[target_kegiatan]</td>
					<td>$qry[output_kegiatan]</td>";
					if($a['status'] == "Sudah Di Nilai")
					{
						echo "
						<td>
							<span>Sudah Di Nilai</span>
						</td>
						";
					}
					else
					{
						echo "
						<td>
							<a href='05_nilai_skp.php?id_daftar_skp=$a[id_daftar_skp]&nip=$_SESSION[nip]&pegawai=$pg[nip]&bulan=$_GET[bulan]&tahun=$_GET[tahun]'>
								<span>Nilai</span>
							</a>
						</td>
						";
					}
					echo "
				</tr>";

				$i++;
				   }  
				   echo "<tr><td colspan='2'>TOTAL</td><td>$target</td><td colspan='2'></td></tr></table>";
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