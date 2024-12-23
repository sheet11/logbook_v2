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
                     <h2>Kegiatan Log Book Bulanan </h2>   
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
            <td><b>Lihat data Logbook</b></td>
            
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
                  if(isset($_POST['submit'])){
                  $query = mysql_query("SELECT * FROM `tb_logbook_dosen`, tb_detail_skp_dosen WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_POST[bulan]' AND year(tanggal_logbook) = '$_POST[tahun]' AND tb_logbook_dosen.id_detail_skp=tb_detail_skp_dosen.id_detail_skp order by tanggal_logbook asc");
                  $jumlah = mysql_num_rows($query);
          if($query){
            echo "<a target='_blank' href='12_cetak_logbook_bulanan.php?bulan=$_POST[bulan]&tahun=$_POST[tahun]'><button class='btn btn-danger' >Cetak</button></a>";
            echo "<p></p>";
                  echo"
                  <table class= 'table table-bordered'>
                  <tr>
                      <td colspan='9' class='info'><b>Data Logbook Bulanan</b></td>
                  </tr>

                  <tr>
                      <th width='5%'>No.</th><th>Tanggal</th><th>Uraian Kegiatan</th><th>Jumlah Menit</th><th>Keterangan</th><th>Jumlah Kegiatan</th><th>Output Kegiatan</th><th width='13%'>Status Look Book</th>
                  </tr>
        ";
          $i =  +1;
          while($a=mysql_fetch_array($query)){
      $jumenit = substr($a['jumlah_menit'], 0, 5);
      $tgl=tgl_indo($a['tanggal_logbook']);
            echo"
              <tr>
                <td>$i</td><td>$tgl</td><td>$a[uraian_skp]</td><td>$jumenit</td><td>$a[keterangan]</td><td>$a[jumlah_kegiatan]</td><td>$a[output_kegiatan]</td>
                <td>";
          
          if($a['status'] == 'Belum di Nilai')
          {
            echo "
            <a href='12_edit_logbook_bulanan.php?id_logbook=$a[id_logbook]&bulan=$_POST[bulan]&tahun=$_POST[tahun]&tanggal=$a[tanggal_logbook]' class='btn btn-danger'>
            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
            </a>
            
            <a href='12_delete_logbook_bulanan.php?id_logbook=$a[id_logbook]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' onclick='return confirm(\"Anda yakin akan menghapus $a[uraian_pekerjaan] ?\")' class='btn btn-danger'>
            <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
            </a>";
          }
          elseif($a['status'] == 'Dinilai')
          {
            echo "<button type='button' class='btn btn-info btn-circle'><i class='glyphicon glyphicon-ok'></i></button>
            ";
          }

          elseif($a['status'] == 'Dikembalikan')
          {
            echo "<a href='12_edit_logbook_bulanan.php?id_logbook=$a[id_logbook]&bulan=$_POST[bulan]&tahun=$_POST[tahun]'>
                  <button type='button' class='btn btn-warning btn-circle'><i class='glyphicon glyphicon-envelope'></i></button>
                  </a>
                  <a href='12_delete_logbook_bulanan.php?id_logbook=$a[id_logbook]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' onclick='return confirm(\"Anda yakin akan menghapus $a[uraian_pekerjaan] ?\")' class='btn btn-warning'>
                  <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
                  </a>
            ";
          }

          elseif($a['status'] == 'Sudah di Verifikasi')
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
      

  $qr = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook_dosen WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_POST[bulan]' AND year(tanggal_logbook) = '$_POST[tahun]'");
    $qry = mysql_fetch_assoc($qr);
    $jumenit = substr($qry['timeSum'], 0, 5);
    $arr = explode(":", $qry['timeSum']);
    $menit = $arr[0]*60;
    $jam = $arr[1];
    $tjam = $menit + $jam;
  
  $qr1 = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook_dosen WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_POST[bulan]' AND year(tanggal_logbook) = '$_POST[tahun]' AND status='Belum di Nilai'");
    $qry1 = mysql_fetch_assoc($qr1);
    $jumenit1 = substr($qry1['timeSum'], 0, 5);
    $arr1 = explode(":", $qry1['timeSum']);
    $menit1 = $arr1[0]*60;
    $jam1 = $arr1[1];
    $tjam1 = $menit1 + $jam1;
  
  $qr2 = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook_dosen WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_POST[bulan]' AND year(tanggal_logbook) = '$_POST[tahun]' AND status='Dinilai'");
    $qry2 = mysql_fetch_assoc($qr2);
    $jumenit2 = substr($qry2['timeSum'], 0, 5);
    $arr2 = explode(":", $qry2['timeSum']);
    $menit2 = $arr2[0]*60;
    $jam2 = $arr2[1];
    $tjam2 = $menit2 + $jam2;
  
  $qr3 = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook_dosen WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_POST[bulan]' AND year(tanggal_logbook) = '$_POST[tahun]' AND status='Sudah di Verifikasi'");
    $qry3 = mysql_fetch_assoc($qr3);
    $jumenit3 = substr($qry3['timeSum'], 0, 5);
    $arr3 = explode(":", $qry3['timeSum']);
    $menit3 = $arr3[0]*60;
    $jam3 = $arr3[1];
    $tjam3 = $menit3 + $jam3;
  
  $qr4 = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook_dosen WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_POST[bulan]' AND year(tanggal_logbook) = '$_POST[tahun]' AND status='Dikembalikan'");
    $qry4 = mysql_fetch_assoc($qr4);
    $jumenit4 = substr($qry4['timeSum'], 0, 5);
    $arr4 = explode(":", $qry4['timeSum']);
    $menit4 = $arr4[0]*60;
    $jam4 = $arr4[1];
    $tjam4 = $menit4 + $jam4;
  

    
          echo "<table class='table table-bordered table-striped'>
                    <tr>
                        <td colspan='3' class='info'><b>Data Komulatif Log Book Bulanan</b></td>
                    </tr>

                    <tr>
                        <td>Total Kuantitatif / Volume </td> <td> : $jumlah</td> 
                    </tr>
                    <tr>
                        <td>Total Menit Yang Dicapai </td> <td> : $tjam Menit</td> 
                    </tr>
                    <tr>
                        <td>Total Menit Belum di Nilai </td> <td> : $tjam1 Menit</td> 
                    </tr>
                    <tr>
                        <td>Total Menit Sudah di Nilai </td> <td> : $tjam2 Menit</td> 
                    </tr>
                    <tr>
                        <td>Total Menit Sudah di Verifikasi </td> <td> : $tjam3 Menit</td> 
                    </tr>
                    <tr>
                        <td>Total Menit Di Kembalikan </td> <td> : $tjam4 Menit</td> 
                    </tr>

              </table>";
        }
        
        else{   
          echo"data tidak ditemukan";
        } 
        
      }
    elseif(!empty($_GET['bulan']))
    {
      
                  $query = mysql_query("SELECT * FROM `tb_logbook_dosen`, tb_detail_skp_dosen WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_GET[bulan]' AND year(tanggal_logbook) = '$_GET[tahun]' AND tb_logbook_dosen.id_detail_skp=tb_detail_skp_dosen.id_detail_skp order by tanggal_logbook asc");
                  $jumlah = mysql_num_rows($query);
          if($query){
             echo "<a target='_blank' href='12_cetak_logbook_bulanan.php?bulan=$_GET[bulan]&tahun=$_GET[tahun]'><button class='btn btn-danger' >Cetak</button></a>";
             echo "<p></p>";
                  echo"
                  <p>&nbsp;</p>
                  <table class= 'table table-bordered'>
                  <tr>
                      <td colspan='9' class='info'><b>Data Logbook Bulanan</b></td>
                  </tr>

                  <tr>
                      <th width='5%'>No.</th><th>Tanggal</th><th>Uraian Kegiatan</th><th>Jumlah Menit</th><th>Keterangan</th><th>Jumlah Kegiatan</th><th>Output Kegiatan</th><th width='13%'>Status Logbook</th>
                  </tr>
        ";
          $i =  +1;
          while($a=mysql_fetch_array($query)){
      $jumenit = substr($a['jumlah_menit'], 0, 5);
      $tgl=tgl_indo($a['tanggal_logbook']);
            echo"
              <tr>
                <td>$i</td><td>$tgl</td><td>$a[uraian_skp]</td><td>$jumenit</td><td>$a[keterangan]</td><td>$a[jumlah_kegiatan]</td><td>$a[output_kegiatan]</td>
                <td>";
          
          if($a['status'] == 'Belum di Nilai')
          {
            echo "
            <a href='12_edit_logbook_bulanan.php?id_logbook=$a[id_logbook]&bulan=$_GET[bulan]&tahun=$_GET[tahun]&tanggal=$a[tanggal_logbook]' class='btn btn-danger'>
            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
            </a>
            
            <a href='12_delete_logbook_bulanan.php?id_logbook=$a[id_logbook]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' onclick='return confirm(\"Anda yakin akan menghapus $a[uraian_pekerjaan] ?\")' class='btn btn-danger'>
            <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
            </a>";
          }
          elseif($a['status'] == 'Dinilai')
          {
            echo "<button type='button' class='btn btn-info btn-circle'><i class='glyphicon glyphicon-ok'></i></button>
            ";
          }

          elseif($a['status'] == 'Dikembalikan')
          {
            echo "<a href='12_edit_logbook_bulanan.php?id_logbook=$a[id_logbook]&bulan=$_GET[bulan]&tahun=$_GET[tahun]'>
                  <button type='button' class='btn btn-warning btn-circle'><i class='glyphicon glyphicon-envelope'></i></button>
                  </a>
                  <a href='12_delete_logbook_bulanan.php?id_logbook=$a[id_logbook]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' onclick='return confirm(\"Anda yakin akan menghapus $a[uraian_pekerjaan] ?\")' class='btn btn-warning'>
                  <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
                  </a>
            ";
          }

          elseif($a['status'] == 'Sudah di Verifikasi')
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
      

  $qr = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook_dosen WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_GET[bulan]' AND year(tanggal_logbook) = '$_GET[tahun]'");
    $qry = mysql_fetch_assoc($qr);
    $jumenit = substr($qry['timeSum'], 0, 5);
    $arr = explode(":", $qry['timeSum']);
    $menit = $arr[0]*60;
    $jam = $arr[1];
    $tjam = $menit + $jam;
  
  $qr1 = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook_dosen WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_GET[bulan]' AND year(tanggal_logbook) = '$_GET[tahun]' AND status='Belum di Nilai'");
    $qry1 = mysql_fetch_assoc($qr1);
    $jumenit1 = substr($qry1['timeSum'], 0, 5);
    $arr1 = explode(":", $qry1['timeSum']);
    $menit1 = $arr1[0]*60;
    $jam1 = $arr1[1];
    $tjam1 = $menit1 + $jam1;
  
  $qr2 = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook_dosen WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_GET[bulan]' AND year(tanggal_logbook) = '$_GET[tahun]' AND status='Dinilai'");
    $qry2 = mysql_fetch_assoc($qr2);
    $jumenit2 = substr($qry2['timeSum'], 0, 5);
    $arr2 = explode(":", $qry2['timeSum']);
    $menit2 = $arr2[0]*60;
    $jam2 = $arr2[1];
    $tjam2 = $menit2 + $jam2;
  
  $qr3 = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook_dosen WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_GET[bulan]' AND year(tanggal_logbook) = '$_GET[tahun]' AND status='Sudah di Verifikasi'");
    $qry3 = mysql_fetch_assoc($qr3);
    $jumenit3 = substr($qry3['timeSum'], 0, 5);
    $arr3 = explode(":", $qry3['timeSum']);
    $menit3 = $arr3[0]*60;
    $jam3 = $arr3[1];
    $tjam3 = $menit3 + $jam3;
  
  $qr4 = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook_dosen WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_GET[bulan]' AND year(tanggal_logbook) = '$_GET[tahun]' AND status='Dikembalikan'");
    $qry4 = mysql_fetch_assoc($qr4);
    $jumenit4 = substr($qry4['timeSum'], 0, 5);
    $arr4 = explode(":", $qry4['timeSum']);
    $menit4 = $arr4[0]*60;
    $jam4 = $arr4[1];
    $tjam4 = $menit4 + $jam4;

    
          echo "<table class='table table-bordered table-striped'>
                    <tr>
                        <td colspan='3' class='info'><b>Data Komulatif Log Book Bulanan</b></td>
                    </tr>

                    <tr>
                        <td>Total Kuantitatif / Volume </td> <td> : $jumlah</td> 
                    </tr>
                    <tr>
                        <td>Total Menit Yang Dicapai </td> <td> : $tjam Menit</td> 
                    </tr>
                    <tr>
                        <td>Total Menit Belum di Nilai </td> <td> : $tjam1 Menit</td> 
                    </tr>
                    <tr>
                        <td>Total Menit Sudah di Nilai </td> <td> : $tjam2 Menit</td> 
                    </tr>
                    <tr>
                        <td>Total Menit Sudah di Verifikasi </td> <td> : $tjam3 Menit</td> 
                    </tr>
                    <tr>
                        <td>Total Menit Di Kembalikan </td> <td> : $tjam4 Menit</td> 
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