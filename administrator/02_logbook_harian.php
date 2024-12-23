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
                     <h2>Kegiatan Log Book Harian</h2>   
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
          <table class= "table table-bordered" >    
            <tr>
                <td width="15%"><b>Lihat data Logbook</b></td><td width="2%">:</td>                
                <td><input id="tgls" type="text" placeholder="Tanggal" name="tanggal_awal" required="yes" class="form-control"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="submit" value="Proses" class="btn btn-primary"></td>
            </tr>

          </table>
        </form>   
            </div>
          </div>
                   

                   <?php
      
                  require_once("../config/koneksi.php");
                  if(isset($_POST['submit'])){
                  $query = mysql_query("SELECT * FROM tb_logbook WHERE nip='$_SESSION[nip]' AND tanggal_logbook = '$_POST[tanggal_awal]'");
                  $jumlah = mysql_num_rows($query);
				  if($query){
                  echo"
                  <p>&nbsp;</p>
                  <table class='table table-bordered'>
                  <tr>
                      <td colspan='9' class='info'><b>Data Logbook Harian</b></td>
                  </tr>
                  <tr>
                  <th width='5%'>No.</th><th>Tanggal</th><th>Uraian Kegiatan</th><th>Jumlah Menit</th><th>Keterangan</th><th>Jumlah Kegiatan</th><th>Output Kegiatan</th><th width='10%'>Status Look Book</th>
            </tr>
        ";
          $i =  +1;
          while($a=mysql_fetch_array($query)){
			$jumenit = substr($a['jumlah_menit'], 0, 5);
			$tgl=tgl_indo($a['tanggal_logbook']);
            echo"
              <tr>
                <td>$i</td><td>$tgl</td><td>$a[uraian_pekerjaan]</td><td>$jumenit</td><td>$a[keterangan]</td><td>$a[jumlah_kegiatan]</td><td>$a[output_kegiatan]</td>
                <td>";
					if($a['status_atasan'] == 'Belum di Verifikasi')
					{
						echo "
						<a href='02_edit_logbook_harian.php?id_logbook=$a[id_logbook]&tanggal_awal=$_POST[tanggal_awal]'>
						<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
						</a>
						
						<a href='02_delete_logbook_harian.php?id_logbook=$a[id_logbook]&tanggal_awal=$_POST[tanggal_awal]' onclick='return confirm(\"Anda yakin akan menghapus $a[uraian_pekerjaan] ?\")'>
						<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
						</a>";
					}
					 elseif($a['status_atasan'] == 'Dinilai')
          {
            echo "<button type='button' class='btn btn-info btn-circle'><i class='glyphicon glyphicon-ok'></i></button>
            ";
          }

          elseif($a['status_atasan'] == 'Dikembalikan')
          {
            echo "<a href='02_edit_logbook_harian.php?id_logbook=$a[id_logbook]'>
                  <button type='button' class='btn btn-warning btn-circle'><i class='glyphicon glyphicon-envelope'></i></button>
                  </a>

                  <a href='02_delete_logbook_harian.php?id_logbook=$a[id_logbook]' onclick='return confirm(\"Anda yakin akan menghapus $a[uraian_pekerjaan] ?\")'>
                  <button type='button' class='btn btn-warning btn-circle'><i class='glyphicon glyphicon-remove'></i></button>		         
		          </a>

            ";
          }

          elseif($a['status_atasan'] == 'Sudah di Verifikasi')
                      {
                        echo "
                        <button type='button' class='btn btn-success btn-circle'><i class='glyphicon glyphicon-ok'></i></button>
                        ";
                      }
                 
                 echo "
                </td>
            </tr>
                
             
              "; 

          
				$i++;
          }
        echo "</table>";
			echo "<a target='_blank' href='02_cetak_logbook_harian.php?tanggal=$_POST[tanggal_awal]'><button class='btn btn-success'>Cetak</button></a>
<p>
</p>

            ";
      $qr = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook WHERE  nip='$_SESSION[nip]' AND tanggal_logbook = '$_POST[tanggal_awal]'");
    $qry = mysql_fetch_assoc($qr);
    $jumenit = substr($qry['timeSum'], 0, 5);
    $arr = explode(":", $qry['timeSum']);
    $menit = $arr[1]/60;
    $jam = $arr[0]*60;
    
    $tanggal2 = $_POST['tanggal_awal'];
    $tgl2 = substr($tanggal2,8,2);
    $bln2 = substr($tanggal2,5,2);
    $thn2 = substr($tanggal2,0,4);
    $tglnew2 = $thn2."-".$bln2."-01";
    $pegawai = mysql_fetch_array(mysql_query("SELECT * FROM tb_hitungan where nip='$_SESSION[nip]' AND tanggal_hitungan='$tglnew2'"));
    $p2 = $pegawai['p2'];
    $swaktu = $pegawai['standar_waktu'];
    $pir = $p2/$swaktu;
    $tjam = $menit + $jam;
    $tuang = $pir * $tjam;
    $juang = number_format($tuang, 0, '', '.');
    $np2 = number_format($p2, 0, '', '.');
    $nswaktu = number_format($swaktu, 0, '', '.');
    $npir = number_format($pir, 0, '', '.');
	  
          echo "<table class='table table-bordered table-striped'>
                    <tr>
                        <td colspan='3'><b>Data Komulatif Log Book Bulanan</b></td>
                    </tr>

                    <tr>
                        <td>Total Kuantitatif / Volume </td> <td> : $jumlah</td> 
                    </tr>
                    <tr>
                        <td>Total Menit Yang Dicapai </td> <td> : $tjam</td> 
                    </tr>
      			        <tr>
      				          <td>Total P2</td><td> : $np2 </td>
      			        </tr>
    			          <tr>
    				            <td>Standar Waktu</td><td> : $nswaktu </td>
    			          </tr>
    			          <tr>
    				            <td>PIR/menit</td><td> : $npir </td>
    			          </tr>
    			          <tr>
    				            <td><b>Total uang yang diterima</b></td><td> <b>: $juang </b></td>
    			          </tr> 
              </table>";
        }
        
        else{   
          echo"data tidak ditemukan";
        } 
        
      }
	  elseif(!empty($_GET['tanggal_awal']))
	  {
		 
                  $query = mysql_query("SELECT * FROM tb_logbook WHERE nip='$_SESSION[nip]' AND tanggal_logbook = '$_GET[tanggal_awal]'");
                  $jumlah = mysql_num_rows($query);
				  if($query){
                  echo"
                  <p>&nbsp;</p>
                  <table class='table table-bordered'>
                  <tr>
                      <td colspan='9' class='danger'><b>Data Logbook Harian</b></td>
                  </tr>
                  <tr>
                  <th width='5%'>No.</th><th>Tanggal</th><th>Uraian Kegiatan</th><th>Jumlah Menit</th><th>Keterangan</th><th>Jumlah Kegiatan</th><th>Output Kegiatan</th><th width='10%'>Status Look Book </th>
            </tr>
        ";
          $i =  +1;
          while($a=mysql_fetch_array($query)){
			$jumenit = substr($a['jumlah_menit'], 0, 5);
			$tgl=tgl_indo($a['tanggal_logbook']);
            echo"
              <tr>
                <td>$i</td><td>$tgl</td><td>$a[uraian_pekerjaan]</td><td>$jumenit</td><td>$a[keterangan]</td><td>$a[jumlah_kegiatan]</td><td>$a[output_kegiatan]</td>
                <td>";
					if($a['status_atasan'] == 'Belum di Verifikasi')
					{
						echo "
						<a href='02_edit_logbook_harian.php?id_logbook=$a[id_logbook]&tanggal_awal=$_GET[tanggal_awal]'>
						<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
						</a>
						
						<a href='02_delete_logbook_harian.php?id_logbook=$a[id_logbook]&tanggal_awal=$_GET[tanggal_awal]' onclick='return confirm(\"Anda yakin akan menghapus $a[uraian_pekerjaan] ?\")'>
						<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
						</a>";
					}
					 elseif($a['status_atasan'] == 'Dinilai')
          {
            echo "<button type='button' class='btn btn-info btn-circle'><i class='glyphicon glyphicon-ok'></i></button>
            ";
          }

          elseif($a['status_atasan'] == 'Dikembalikan')
          {
            echo "<a href='02_edit_logbook_harian.php?id_logbook=$a[id_logbook]'>
                  <button type='button' class='btn btn-warning btn-circle'><i class='glyphicon glyphicon-envelope'></i></button>
                  </a>

                  <a href='02_delete_logbook_harian.php?id_logbook=$a[id_logbook]' onclick='return confirm(\"Anda yakin akan menghapus $a[uraian_pekerjaan] ?\")'>
                  <button type='button' class='btn btn-warning btn-circle'><i class='glyphicon glyphicon-remove'></i></button>		         
		          </a>

            ";
          }

          elseif($a['status_atasan'] == 'Sudah di Verifikasi')
                      {
                        echo "
                        <button type='button' class='btn btn-success btn-circle'><i class='glyphicon glyphicon-ok'></i></button>
                        ";
                      }
                 
                 echo "
                </td>
            </tr>
                
             
              "; 

          
				$i++;
          }
        echo "</table>";
			echo "<a target='_blank' href='02_cetak_logbook_harian.php?tanggal=$_GET[tanggal_awal]'><button class='btn btn-success'>Cetak</button></a>
<p>
</p>

            ";
      $qr = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook WHERE  nip='$_SESSION[nip]' AND tanggal_logbook = '$_POST[tanggal_awal]'");
    $qry = mysql_fetch_assoc($qr);
    $jumenit = substr($qry['timeSum'], 0, 5);
    $arr = explode(":", $qry['timeSum']);
    $menit = $arr[1]/60;
    $jam = $arr[0]*60;
    
    $tanggal2 = $_POST['tanggal_awal'];
    $tgl2 = substr($tanggal2,8,2);
    $bln2 = substr($tanggal2,5,2);
    $thn2 = substr($tanggal2,0,4);
    $tglnew2 = $thn2."-".$bln2."-01";
    $pegawai = mysql_fetch_array(mysql_query("SELECT * FROM tb_hitungan where nip='$_SESSION[nip]' AND tanggal_hitungan='$tglnew2'"));
    $p2 = $pegawai['p2'];
    $swaktu = $pegawai['standar_waktu'];
    $pir = $p2/$swaktu;
    $tjam = $menit + $jam;
    $tuang = $pir * $tjam;
    $juang = number_format($tuang, 0, '', '.');
    $np2 = number_format($p2, 0, '', '.');
    $nswaktu = number_format($swaktu, 0, '', '.');
    $npir = number_format($pir, 0, '', '.');
	  
          echo "<table class='table table-bordered table-striped'>
                    <tr>
                        <td colspan='3'><b>Data Komulatif Log Book Bulanan</b></td>
                    </tr>

                    <tr>
                        <td>Total Kuantitatif / Volume </td> <td> : $jumlah</td> 
                    </tr>
                    <tr>
                        <td>Total Menit Yang Dicapai </td> <td> : $tjam</td> 
                    </tr>
      			        <tr>
      				          <td>Total P2</td><td> : $np2 </td>
      			        </tr>
    			          <tr>
    				            <td>Standar Waktu</td><td> : $nswaktu </td>
    			          </tr>
    			          <tr>
    				            <td>PIR/menit</td><td> : $npir </td>
    			          </tr>
    			          <tr>
    				            <td><b>Total uang yang diterima</b></td><td> <b>: $juang </b></td>
    			          </tr> 
              </table>";
        }
        
        else{   
          echo"data tidak ditemukan";
        } 
	  }
	  
		  ?>

                  </div>
                
             </div>
             </div>
            </div>   
           </body>