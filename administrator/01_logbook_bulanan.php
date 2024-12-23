<?php
include"01_nav.php";
include "../assets/js/date.php";
error_reporting(0); ?>


<body>
    <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Kegiatan Bulanan Log Book</h2>   
                    </div>
                </div> 
                             
                 <!-- /. ROW  -->
                  <hr />
                  <div>

                  <table class="table table-hover">   
                      <tr>
                          <td>NIP</td>
                          <td><?php echo $_SESSION['nip'];?></td>
                      </tr>
                      <tr>
                          <td>Nama Pegawai</td>
                          <td><?php echo $_SESSION['nama_lengkap'];?></td>
                      </tr>
                      <tr>
                          <td>Unit Kerja</td>
                          <td><?php echo $_SESSION['unit_kerja'];?></td>
                      </tr>

                      <tr>
                          <td>Jabatan</td>
                          <td><?php echo $_SESSION['jabatan'];?></td>
                      </tr>

                      <tr>
                          <td>Grade</td>
                          <td><?php echo $_SESSION['grade'];?></td>
                      </tr>
                  </table>

      <div class="container-fluid" style="margin:30px;">
        <form method="post" action="" enctype="multipart/form-data">    
          <table width="100%" class= table table-hover style="width:40%;">    
            <tr>
            
              <td><select class="form-control" name="bulan">
					<?php for($bln = 1; $bln < 13 ;$bln++){
                        echo "<option value='$bln'>$bln</option>";
                    }?>
                    </select></td>

              <td><select class="form-control" name="tahun">
						<?php
							for($thn = (date('Y')-6);$thn <= date('Y');$thn++){
								echo "<option value='$thn'>$thn</option>";
							}
						?>
					</select>
			  </td>
       
              <td><input type="submit" name="submit" value="Proses" class="btn btn-primary"></td>
            </tr>

          </table>
        </form>   
            </div>
          </div>
                   

                   <?php
      
                  require_once("../config/koneksi.php");
                  if(isset($_POST['submit'])){
                  $query = mysql_query("SELECT * FROM `tb_logbook` WHERE month(tanggal_logbook) = '$_POST[bulan]' AND year(tanggal_logbook) = '$_POST[tahun]' AND nip='$_SESSION[nip]'");
                  $jumlah = mysql_num_rows($query);
				  if($query){
                  echo"
                  <p>&nbsp;</p>
                  <table class='table table-bordered table-striped'>
                  <tr>
                  <th width='5%'>No.</th><th>Tanggal</th><th>Uraian Kegiatan</th><th>Jumlah Menit</th><th>Keterangan</th><th>Jumlah Kegiatan</th><th>Output Kegiatan</th><th width='10%'>Aksi</th>
            </tr>
        ";
          $i =  +1;
          while($a=mysql_fetch_array($query)){
			$jumenit = substr($a['jumlah_menit'], 0, 5);
            echo"
              <tr>
                <td>$i</td><td>$a[tanggal_logbook]</td><td>$a[uraian_pekerjaan]</td><td>$jumenit</td><td>$a[keterangan]</td><td>$a[jumlah_kegiatan]</td><td>$a[output_kegiatan]</td>
                <td>";
					if($a['status'] == 'belum')
					{
						echo "
						<a href='01_edit_logbook.php?id_logbook=$a[id_logbook]'>Verifikasi
						</a>
						<a href='01_edit_logbook.php?id_logbook=$a[id_logbook]'>
						<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
						</a>
						<a href='01_delete_logbook.php?id_logbook=$a[id_logbook]' onclick='return confirm(\"Anda yakin akan menghapus $a[tanggal_kegiatan] ?\")'>
						<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
						</a>";
					}
					else
					{
						echo "Terverifikasi";
					}
                 echo "
                </td>
            </tr>
             
              "; 
				$i++;
          }
        echo "</table>";
			echo "<a target='_blank' href='01_cetak_logbook_bulanan.php?bulan=$_POST[bulan]&tahun=$_POST[tahun]'><button >Cetak</button></a>";
        }
        
        else{   
          echo"data tidak ditemukan";
        } 
        
      }
	  $qr = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook WHERE month(tanggal_logbook) = '$_POST[bulan]' AND year(tanggal_logbook) = '$_POST[tahun]' AND nip='$_SESSION[nip]'");
	  $qry = mysql_fetch_assoc($qr);
	  $jumenit = substr($qry['timeSum'], 0, 5);
	  $arr = explode(":", $qry['timeSum']);
	  $jam = $arr[1]/60;
	  $hjam1 = $arr[0] * 25000;
	  $hjam2 = $jam * 25000;
	  $tuang = floor($hjam1 + $hjam2);
	  $juang = number_format($tuang, 0, '', '.');
          echo "<table class='table table-bordered table-striped'>
              <tr>
                  <td>Total Kuantitatif / Volume </td> <td> : $jumlah </td> 
              </tr>
              <tr>
              <td>Total Jam Kerja Efektif </td> <td> : $jumenit</td> 
              </tr>
			  <tr>
				<td>Total uang</td><td> : $juang </td>
			  </tr>
          </table>";
		  ?>

                  </div>
                
             </div>
             </div>
            </div>   
           </body>