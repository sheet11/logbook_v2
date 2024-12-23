<?php
  	include"01_nav.php";
  	include "../assets/js/date.php";
  	error_reporting(0);
  	$query = mysql_query("SELECT * FROM tb_pegawai WHERE nip='$_GET[pegawai]'");
  	$qr = mysql_fetch_array($query);
?>
<body>
    <div id="page-wrapper" >
       	<div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                     <h2>Verifikasi Target SKP Pegawai</h2>   
                </div>
            </div> 
                             
                 <!-- /. ROW  -->
                  <hr />
                  <div>

                  <table class="table table-bordered">   
                      <tr>
                          <td colspan="3" class="success"><b>Data Pegawai</b></td>
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
          </div>

<?php
require_once("../config/koneksi.php");
$query = mysql_query("SELECT * FROM tb_pengaturan_skp WHERE month(tanggal_pengaturan_skp) = '$_GET[bulan]' AND year(tanggal_pengaturan_skp) = '$_GET[tahun]' AND nip_pegawai='$_GET[pegawai]'");
	$dapat = mysql_fetch_array($query);
?>
<form method="post" action="11_proses_update_verifikasi_target_skp_pegawai.php" enctype="multipart/form-data">    
          	<table class= "table table-bordered">    
            	<tr>
					<td colspan="3"><h2>Status Pengaturan SKP</h2>
				</tr>
				<tr>
					<td><b>Bulan : </b></td>
					<td> : </td>
					<td><?php if($_GET['bulan'] == '1'){echo "Januari";} elseif($_GET['bulan'] == '2'){ echo "Februari";} elseif($_GET['bulan'] == '3'){ echo "Maret";} elseif($_GET['bulan'] == '4'){ echo "April";} elseif($_GET['bulan'] == '5'){ echo "Mei";} elseif($_GET['bulan'] == '6'){ echo "Juni";} elseif($_GET['bulan'] == '7'){ echo "Juli";} elseif($_GET['bulan'] == '8'){ echo "Agustus";} elseif($_GET['bulan'] == '9'){ echo "September";} elseif($_GET['bulan'] == '10'){ echo "Oktober";} elseif($_GET['bulan'] == '11'){ echo "November";} elseif($_GET['bulan'] == '12'){ echo "Desember";}else{echo "Error";}?> <?php echo $_GET['tahun']; ?></td>
				</tr>
				<tr>
              		<td width="15%"><b>Status</b></td><td width="2%">:</td> 
              		<td><input type="hidden" name="pegawai" value="<?php echo $_GET['pegawai']; ?>">
              		<input type="hidden" name="id" value="<?php echo $dapat['id_pengaturan_skp']; ?>">
              		<input type="hidden" name="bulan" value="<?php echo $_GET['bulan']; ?>">
              		<input type="hidden" name="tahun" value="<?php echo $_GET['tahun']; ?>">
			        	<select class="form-control" name="status" required>
			          	<?php
						if($dapat == NULL)
						{
							echo "<option value=''>Belum Di Atur</option>";
						}
						else
						{
							echo "<option value='$dapat[status_pengaturan_skp]'>"; if($dapat['status_pengaturan_skp']== "Y"){echo "Aktif";}elseif($dapat['status_pengaturan_skp']=="N"){echo "Tidak Aktif";}else{echo "Belum Di Atur";} echo "</option>";
						}
			            ?>
						<option value="Y">Aktif</option>
						
			            </select></td>
			            </tr>
			            <tr>
			                <td></td>
			                <td></td>
			                <td><input type="submit" name="submit" value="Atur" class="btn btn-warning"></td>
			            </tr>
			          </table>
        </form>

                  </div>
                
             </div>
             </div>
            </div>   
           </body>