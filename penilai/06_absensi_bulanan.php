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
					   $a=mysql_fetch_array($query);
					   $qry = mysql_fetch_array($qr);
					   echo "<table class='table table-bordered'>   
                      <tr>
                          <td width=33%><b>Tanggal</b></td>
                          <td width=2%>:</td>
                          <td width=65%>$a[tanggal]</td>
                      </tr>   
                      <tr>
                          <td><b>Status</b></td>
                          <td>:</td>
                          <td>"; if ($a['status']=='Sudah Di Verifikasi'){ echo $a['status']. " Oleh ".$qry['nama_lengkap'];}else {echo $a['status'];} echo "</td>
                      </tr>   
                      <tr>
                          <td>Keterlambatan</td>
                          <td>:</td>
                          <td>$a[keterlambatan]</td>
                      </tr>   
                      <tr>
                          <td>Pulang Sebelum Waktunya</td>
                          <td>:</td>
                          <td>$a[pulang_sebelum]</td>
                      </tr>    
                      <tr>
                          <td>Tidak Apel Pagi</td>
                          <td>:</td>
                          <td>$a[apel_pagi]</td>
                      </tr>    
                      <tr>
                          <td>Tidak Apel Bersama</td>
                          <td>:</td>
                          <td>$a[apel_bersama]</td>
                      </tr>
                      <tr>
                          <td>Tidak Ditempat Tugas Tanpa Izin</td>
                          <td>:</td>
                          <td>$a[tidak_ditempat_tugas]</td>
                      </tr>   
                      <tr>
                          <td>Tidak Hadir tanpa keterangan</td>
                          <td>:</td>
                          <td>$a[tidak_hadir]</td>
                      </tr>    
                      <tr>
                          <td>Izin/Sakit</td>
                          <td>:</td>
                          <td>$a[izin_sakit]</td>
                      </tr>    
                      <tr>
                          <td>Cuti Diluar Cuti Tahunan</td>
                          <td>:</td>
                          <td>$a[cuti]</td>
                      </tr>   
                      <tr>
                          <td>Dari</td>
                          <td>:</td>
                          <td>$a[cuti_dari]</td>
                      </tr>   
                      <tr>
                          <td>Sampai</td>
                          <td>:</td>
                          <td>$a[cuti_sampai]</td>
                      </tr>    
                      <tr>
                          <td>Jenis Cuti</td>
                          <td>:</td>
                          <td>$a[jenis_cuti]</td>
                      </tr>    
                      <tr>
                          <td>DL Non Tusi</td>
                          <td>:</td>
                          <td>$a[dl_non_tusi]</td>
                      </tr>   
                  </table>
				  <table border='0'>
				  <tr>
					<td>";
						if($a['status']=="Sudah Di Nilai" OR $a['status']=="Sudah Di Verifikasi")
						{
							echo "<a href='06_edit_absensi.php?id_absensi=$a[id_absensi]&pegawai=$_GET[pegawai]'><input type=button value=Edit class='btn btn-success'></a> &nbsp;
							<a href='06_delete_absensi.php?id_absensi=$a[id_absensi]' onclick='return confirm(\"Anda yakin akan menghapus $a[id_absensi] ?\")'><input type=button value=Hapus class='btn btn-danger'></a> &nbsp;
							<a href='06_cetak_absensi.php?id_absensi=$a[id_absensi]&pegawai=$_GET[pegawai]' target='_blank'><input type=button value='Cetak Kehadiran Bulanan' class='btn btn-danger'></a>";
						}
						else
						{
							echo "<a href='06_edit_absensi.php?id_absensi=$a[id_absensi]&pegawai=$_GET[pegawai]'><input type=button value=Edit class='btn btn-success'></a> &nbsp;
							<a href='06_delete_absensi.php?id_absensi=$a[id_absensi]' onclick='return confirm(\"Anda yakin akan menghapus $a[id_absensi] ?\")'><input type=button value=Hapus class='btn btn-danger'></a> &nbsp;
							<a href='06_nilai_absensi.php?pegawai=$a[nip]&id_absensi=$a[id_absensi]&bulan=$_POST[bulan]&tahun=$_POST[tahun]'><input type=button value=Nilai class='btn btn-success'></a> &nbsp;
							<a href='06_cetak_absensi.php?id_absensi=$a[id_absensi]&pegawai=$_GET[pegawai]' target='_blank'><input type=button value='Cetak Kehadiran Bulanan' class='btn btn-danger'></a>";
						}
					echo "	
				  </tr>
				  </table>";
				   }
				   elseif(!empty($_GET['bulan']))
				   {
					   
					   $query = mysql_query("SELECT * FROM `tb_absensi` WHERE nip='$_GET[pegawai]' AND month(tanggal) = '$_GET[bulan]' AND year(tanggal) = '$_GET[tahun]'");
					   $qr = mysql_query("SELECT * FROM  tb_pegawai as p, `tb_absensi` as a WHERE a.nip_penilai=p.nip AND month(tanggal) = '$_GET[bulan]' AND year(tanggal) = '$_GET[tahun]'");
					   $a=mysql_fetch_array($query);
					   $qry = mysql_fetch_array($qr);
					   echo "<table class='table table-bordered'>   
                      <tr>
                          <td width=33%><b>Tanggal</b></td>
                          <td width=2%>:</td>
                          <td width=65%>$a[tanggal]</td>
                      </tr>   
                      <tr>
                          <td><b>Status</b></td>
                          <td>:</td>
                          <td>"; if ($a['status']=='Sudah Di Verifikasi'){ echo $a['status']. " Oleh ".$qry['nama_lengkap'];}else {echo $a['status'];} echo "</td>
                      </tr>   
                      <tr>
                          <td>Keterlambatan</td>
                          <td>:</td>
                          <td>$a[keterlambatan]</td>
                      </tr>   
                      <tr>
                          <td>Pulang Sebelum Waktunya</td>
                          <td>:</td>
                          <td>$a[pulang_sebelum]</td>
                      </tr>    
                      <tr>
                          <td>Tidak Apel Pagi</td>
                          <td>:</td>
                          <td>$a[apel_pagi]</td>
                      </tr>    
                      <tr>
                          <td>Tidak Apel Bersama</td>
                          <td>:</td>
                          <td>$a[apel_bersama]</td>
                      </tr>
                      <tr>
                          <td>Tidak Ditempat Tugas Tanpa Izin</td>
                          <td>:</td>
                          <td>$a[tidak_ditempat_tugas]</td>
                      </tr>   
                      <tr>
                          <td>Tidak Hadir tanpa keterangan</td>
                          <td>:</td>
                          <td>$a[tidak_hadir]</td>
                      </tr>    
                      <tr>
                          <td>Izin/Sakit</td>
                          <td>:</td>
                          <td>$a[izin_sakit]</td>
                      </tr>    
                      <tr>
                          <td>Cuti Diluar Cuti Tahunan</td>
                          <td>:</td>
                          <td>$a[cuti]</td>
                      </tr>   
                      <tr>
                          <td>Dari</td>
                          <td>:</td>
                          <td>$a[cuti_dari]</td>
                      </tr>   
                      <tr>
                          <td>Sampai</td>
                          <td>:</td>
                          <td>$a[cuti_sampai]</td>
                      </tr>    
                      <tr>
                          <td>Jenis Cuti</td>
                          <td>:</td>
                          <td>$a[jenis_cuti]</td>
                      </tr>    
                      <tr>
                          <td>DL Non Tusi</td>
                          <td>:</td>
                          <td>$a[dl_non_tusi]</td>
                      </tr>   
                  </table>
				  <table border='0'>
				  <tr>
					<td>";
					if($a['status']=="Sudah Di Nilai" OR $a['status']=="Sudah Di Verifikasi")
						{
							echo "<a href='06_edit_absensi.php?id_absensi=$a[id_absensi]&pegawai=$_GET[pegawai]&bulan=$_GET[bulan]&tahun=$_GET[tahun]'><input type=button value=Edit class='btn btn-success'></a> &nbsp;
					<a href='06_delete_absensi.php?id_absensi=$a[id_absensi]&pegawai=$_GET[pegawai]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' onclick='return confirm(\"Anda yakin akan menghapus $a[id_absensi] ?\")'><input type=button value=Hapus class='btn btn-danger'></a> &nbsp;
					<a href='06_cetak_absensi.php?id_absensi=$a[id_absensi]&pegawai=$_GET[pegawai]' target='_blank'><input type=button value='Cetak Kehadiran Bulanan' class='btn btn-danger'></a>";
						}
						else
						{
							echo "<a href='06_edit_absensi.php?id_absensi=$a[id_absensi]&pegawai=$_GET[pegawai]&bulan=$_GET[bulan]&tahun=$_GET[tahun]'><input type=button value=Edit class='btn btn-success'></a> &nbsp;
					<a href='06_delete_absensi.php?id_absensi=$a[id_absensi]&pegawai=$_GET[pegawai]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' onclick='return confirm(\"Anda yakin akan menghapus $a[id_absensi] ?\")'><input type=button value=Hapus class='btn btn-danger'></a> &nbsp;
					<a href='06_nilai_absensi.php?pegawai=$a[nip]&id_absensi=$a[id_absensi]&bulan=$_GET[bulan]&tahun=$_GET[tahun]'><input type=button value=Nilai class='btn btn-success'></a> &nbsp;
					<a href='06_cetak_absensi.php?id_absensi=$a[id_absensi]&pegawai=$_GET[pegawai]' target='_blank'><input type=button value='Cetak Kehadiran Bulanan' class='btn btn-danger'></a>";
						}
echo "					</tr>
				  </table>";
				   }
				  ?>

                  </div>
                
             </div>
             </div>
            </div>   
           </body>