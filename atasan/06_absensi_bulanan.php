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
            <td><b>Lihat data Absensi</b></td>
            
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
					   $query = mysql_query("SELECT * FROM `tb_absensi` WHERE nip='$_GET[pegawai]' AND month(tanggal) = '$_POST[bulan]' AND year(tanggal) = '$_POST[tahun]'");
					   $qr = mysql_query("SELECT * FROM  tb_pegawai as p, `tb_absensi` as a WHERE a.nip_penilai=p.nip AND month(tanggal) = '$_POST[bulan]' AND year(tanggal) = '$_POST[tahun]'");
					   $qry = mysql_fetch_array($qr);
             echo"
                  <p>&nbsp;</p>
                  <table class= 'table table-bordered'>
                  <tr>
                      <td colspan='9' class='info'><b>Data Absensi Bulanan</b></td>
                  </tr>

                  <tr>
                      <th width='5%'>No.</th><th>Tanggal</th><th>Tidak Apel Pagi </th><th>Tidak Apel Bersama</th><th>Tidak Ditempat Tugas Tanpa Izin</th><th>Tidak Hadir Tanpa Keterangan</th><th>Izin</th><th width='13%'>Aksi</th>
                  </tr>";
				  $i = 1;
				  while ($a=mysql_fetch_array($query)){
                  echo "<tr> 
                      <td>$i</td><td>$a[tanggal]</td><td>$a[apel_pagi]</td><td>$a[apel_bersama]</td><td>$a[tidak_ditempat_tugas]</td><td>$a[tidak_hadir]</td><td>$a[izin_sakit]</td> <td>        

       
            <a href='06_edit_absensi_bulanan.php?id_absensi=$a[id_absensi]&bulan=$_POST[bulan]&tahun=$_POST[tahun]&pegawai=$_GET[pegawai]' class='btn btn-danger'>
            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
            </a>
            
            <a href='06_delete_absensi_bulanan.php?id_absensi=$a[id_absensi]&bulan=$_POST[bulan]&tahun=$_POST[tahun]&pegawai=$_GET[pegawai]' onclick='return confirm(\"Anda yakin akan menghapus absensi pada tanggal $a[tanggal] ?\")' class='btn btn-danger'>
            <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
            </a>";
				  $i++;
				  }
          
                 echo "
                </td>
                  </table>";
				   }
				   elseif(!empty($_GET['bulan']))
				   {
					   
					   $query = mysql_query("SELECT * FROM `tb_absensi` WHERE nip='$_GET[pegawai]' AND month(tanggal) = '$_GET[bulan]' AND year(tanggal) = '$_GET[tahun]'");
					   $qr = mysql_query("SELECT * FROM  tb_pegawai as p, `tb_absensi` as a WHERE a.nip_penilai=p.nip AND month(tanggal) = '$_GET[bulan]' AND year(tanggal) = '$_GET[tahun]'");
					   $qry = mysql_fetch_array($qr);
                         echo"
                  <p>&nbsp;</p>
                  <table class= 'table table-bordered'>
                  <tr>
                      <td colspan='9' class='info'><b>Data Absensi Bulanan</b></td>
                  </tr>

                  <tr>
                      <th width='5%'>No.</th><th>Tanggal</th><th>Tidak Apel Pagi </th><th>Tidak Apel Bersama</th><th>Tidak Ditempat Tugas Tanpa Izin</th><th>Tidak Hadir Tanpa Keterangan</th><th>Izin</th><th width='13%'>Aksi</th>
                  </tr>";
				  $i = 1;
				  while ($a=mysql_fetch_array($query)){
                  echo "
                  <tr> 
                      <td>$i</td><td>$a[tanggal]</td><td>$a[apel_pagi]</td><td>$a[apel_bersama]</td><td>$a[tidak_ditempat_tugas]</td><td>$a[tidak_hadir]</td><td>$a[izin_sakit]</td> <td>        

       
            <a href='06_edit_absensi_bulanan.php?id_absensi=$a[id_absensi]&bulan=$_GET[bulan]&tahun=$_GET[tahun]&pegawai=$_GET[pegawai]' class='btn btn-danger'>
            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
            </a>
            
            <a href='06_delete_absensi_bulanan.php?id_absensi=$a[id_absensi]&bulan=$_POST[bulan]&tahun=$_POST[tahun]&pegawai=$_GET[pegawai]' onclick='return confirm(\"Anda yakin akan menghapus absensi pada tanggal $a[tanggal] ?\")' class='btn btn-danger'>
            <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
            </a>";
			$i++;
				  }
          
                 echo "
                </td>
                  </table>";
				   }
				  ?>

                  </div>
                
             </div>
             </div>
            </div>   
           </body>