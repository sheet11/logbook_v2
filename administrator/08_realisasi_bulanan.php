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
                     <h2>Realisasi Bulanan </h2>   
                </div>
            </div> 
                <hr />
            <div>
               


      <div>
        <form method="post" action="" enctype="multipart/form-data">    
          <table width="100%" class= "table table-bordered" style="width:50%;">    
            <tr>
            <td><b>Lihat data Realisasi</b></td>
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
                  $query = mysql_query("SELECT * FROM `tb_logbook` WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_POST[bulan]' AND year(tanggal_logbook) = '$_POST[tahun]' order by tanggal_logbook asc");

                  $jumlah = mysql_num_rows($query);

				  if($query){

                  echo"

                  <p>&nbsp;</p>

                  <table class= 'table table-bordered'>

                  <tr>

                      <td colspan='9' class='info'><b>Data Logbook Bulanan</b></td>

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

            <a href='04_edit_logbook_bulanan.php?id_logbook=$a[id_logbook]&bulan=$_POST[bulan]&tahun=$_POST[tahun]'>

            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>

            </a>

            

            <a href='04_delete_logbook_bulanan.php?id_logbook=$a[id_logbook]&bulan=$_POST[bulan]&tahun=$_POST[tahun]' onclick='return confirm(\"Anda yakin akan menghapus $a[uraian_pekerjaan] ?\")'>

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

            echo "<a href='04_edit_logbook_bulanan.php?id_logbook=$a[id_logbook]'>

                  <button type='button' class='btn btn-warning btn-circle'><i class='glyphicon glyphicon-envelope'></i></button>

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

			echo "<a target='_blank' href='04_cetak_logbook_bulanan.php?bulan=$_POST[bulan]&tahun=$_POST[tahun]'><button class='btn btn-danger' >Cetak</button></a>";

			echo " | <a target='_blank' href='04_cetak_excel_logbook_bulanan.php?bulan=$_POST[bulan]&tahun=$_POST[tahun]'><button class='btn btn-success'>Export Excel</button></a>



      <p>

</p>





";

$qr = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_POST[bulan]' AND year(tanggal_logbook) = '$_POST[tahun]'");

    $qry = mysql_fetch_assoc($qr);

    $jumenit = substr($qry['timeSum'], 0, 5);

    $arr = explode(":", $qry['timeSum']);

    $menit = $arr[1]/60;

    $jam = $arr[0]*60;

    

    $tglnew2 = $_POST['tahun']."-".$_POST['bulan']."-01";

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

                        <td colspan='3' class='info'><b>Data Komulatif Log Book Bulanan</b></td>

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

	  elseif(!empty($_GET['bulan']))

	  {

		  

                  $query = mysql_query("SELECT * FROM `tb_logbook` WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_GET[bulan]' AND year(tanggal_logbook) = '$_GET[tahun]' order by tanggal_logbook asc");

                  $jumlah = mysql_num_rows($query);

				  if($query){

                  echo"

                  <p>&nbsp;</p>

                  <table class= 'table table-bordered'>

                  <tr>

                      <td colspan='9' class='info'><b>Data Logbook Bulanan</b></td>

                  </tr>



                  <tr>

                      <th width='5%'>No.</th><th>Tanggal</th><th>Uraian Kegiatan</th><th>Jumlah Menit</th><th>Keterangan</th><th>Jumlah Kegiatan</th><th>Output Kegiatan</th><th width='10%'>Status Logbook</th>

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

            <a href='04_edit_logbook_bulanan.php?id_logbook=$a[id_logbook]&bulan=$_GET[bulan]&tahun=$_GET[tahun]'>

            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>

            </a>

            

            <a href='04_delete_logbook_bulanan.php?id_logbook=$a[id_logbook]&bulan=$_GET[bulan]&tahun=$_GET[tahun]' onclick='return confirm(\"Anda yakin akan menghapus $a[uraian_pekerjaan] ?\")'>

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

            echo "<a href='04_edit_logbook_bulanan.php?id_logbook=$a[id_logbook]'>

                  <button type='button' class='btn btn-warning btn-circle'><i class='glyphicon glyphicon-envelope'></i></button>

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

			echo "<a target='_blank' href='04_cetak_logbook_bulanan.php?bulan=$_POST[bulan]&tahun=$_POST[tahun]'><button class='btn btn-danger' >Cetak</button></a>";

			echo " | <a target='_blank' href='04_cetak_excel_logbook_bulanan.php?bulan=$_POST[bulan]&tahun=$_POST[tahun]'><button class='btn btn-success'>Export Excel</button></a>



      <p>

</p>





";

$qr = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook WHERE nip='$_SESSION[nip]' AND month(tanggal_logbook) = '$_POST[bulan]' AND year(tanggal_logbook) = '$_POST[tahun]'");

    $qry = mysql_fetch_assoc($qr);

    $jumenit = substr($qry['timeSum'], 0, 5);

    $arr = explode(":", $qry['timeSum']);

    $menit = $arr[1]/60;

    $jam = $arr[0]*60;

    

    $tglnew2 = $_POST['tahun']."-".$_POST['bulan']."-01";

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

                        <td colspan='3' class='info'><b>Data Komulatif Log Book Bulanan</b></td>

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