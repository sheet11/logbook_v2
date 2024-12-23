<?php
include"01_nav.php";
include "../assets/js/date.php";
include("fucnt_tgl.php");
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
					   $query = mysql_query("SELECT * FROM `tb_absensi` WHERE nip='$_SESSION[nip]' AND month(tanggal) = '$_POST[bulan]' AND year(tanggal) = '$_POST[tahun]'");
					   $a=mysql_fetch_array($query);
					   echo "<table class='table table-bordered'>   
                      <tr>
                          <td width=33%><b>Tanggal</b></td>
                          <td width=2%>:</td>
                          <td width=65%>$a[tanggal]</td>
                      </tr>   
                      <tr>
                          <td><b>Status</b></td>
                          <td>:</td>
                          <td>$a[status]</td>
                      </tr>   
                      <tr class='info'>
                          <td colspan=3><b>Tingkat Keterlambatan (Menit)</b></td>
                      </tr>   
                      <tr>
                          <td>1 s/d 30</td>
                          <td>:</td>
                          <td>$a[terlambatsatu]</td>
                      </tr>   
                      <tr>
                          <td>31 s/d 60</td>
                          <td>:</td>
                          <td>$a[terlambatdua]</td>
                      </tr>    
                      <tr>
                          <td>61 s/d 90</td>
                          <td>:</td>
                          <td>$a[terlambattiga]</td>
                      </tr>    
                      <tr>
                          <td>>90</td>
                          <td>:</td>
                          <td>$a[terlambatempat]</td>
                      </tr>   
                      <tr class='info'>
                          <td colspan=3><b>Tingkat Pulang Sebelum Waktunya (Menit)</b></td>
                      </tr>   
                      <tr>
                          <td>1 s/d 30</td>
                          <td>:</td>
                          <td>$a[pulangsatu]</td>
                      </tr>   
                      <tr>
                          <td>31 s/d 60</td>
                          <td>:</td>
                          <td>$a[pulangdua]</td>
                      </tr>    
                      <tr>
                          <td>61 s/d 90</td>
                          <td>:</td>
                          <td>$a[pulangtiga]</td>
                      </tr>    
                      <tr>
                          <td>>90</td>
                          <td>:</td>
                          <td>$a[pulangempat]</td>
                      </tr>   
                      <tr>
                          <td>Tidak Ditempat Tugas (Hari)</td>
                          <td>:</td>
                          <td>$a[tidakditempat]</td>
                      </tr>   
                      <tr>
                          <td>Tidak Hadir (Hari)</td>
                          <td>:</td>
                          <td>$a[tidakhadir]</td>
                      </tr>    
                      <tr>
                          <td>Izin > 2 Hari (Hari)</td>
                          <td>:</td>
                          <td>$a[izin]</td>
                      </tr>    
                      <tr>
                          <td>Cuti</td>
                          <td>:</td>
                          <td>$a[cuti]</td>
                      </tr>   
                      <tr class='info'>
                          <td colspan=3><b>Besaran Potongan</b></td>
                      </tr>   
                      <tr>
                          <td>Hudis</td>
                          <td>:</td>
                          <td>$a[hudis]</td>
                      </tr>   
                      <tr>
                          <td>PPk</td>
                          <td>:</td>
                          <td>$a[ppk]</td>
                      </tr>   
                  </table>
				  <table border='0'>
				  <tr>
					<td>";
						if($a['status']=="Belum Di Nilai")
						{
							echo "<a href='06_edit_absensi.php?id_absensi=$a[id_absensi]'><input type=button value=Edit class='btn btn-success'></a> &nbsp;
							<a href='06_delete_absensi.php?id_absensi=$a[id_absensi]' onclick='return confirm(\"Anda yakin akan menghapus $a[id_absensi] ?\")'><input type=button value=Hapus class='btn btn-danger'></a> &nbsp;
							<a href='06_cetak_absensi.php?id_absensi=$a[id_absensi]' target='_blank'><input type=button value='Cetak Kehadiran Bulanan' class='btn btn-success'></a>";
						}
						else
						{
							echo "<a href='06_cetak_absensi.php?id_absensi=$a[id_absensi]' target='_blank'><input type=button value='Cetak Kehadiran Bulanan' class='btn btn-success'></a>";
						}
					echo "	
				  </tr>
				  </table>";
				   }
				  ?>

                  </div>
                
             </div>
             </div>
            </div>   
           </body>