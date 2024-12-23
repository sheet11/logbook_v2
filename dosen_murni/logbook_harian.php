<?php
include"01_nav.php";
?>

<body>
    <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Poltekkes Kemenkes Bengkulu </h2>   
                        <h5>Selamat Datang <?php echo $_SESSION['nama_lengkap'];?> Di Halaman Aplikasi Log Book Online </h5>
                    </div>
                </div> 
                             
                 <!-- /. ROW  -->
                  <hr />
                  <div>

                  <table class="table table-hover">   
                      <tr>
                          <td rowspan="4" width="15%"><img src="../assets/img/find_user.png" class="user-image img-responsive"/></td>
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
                  </table>
                    
                  </div>
                
             </div>
             </div>
            </div>   
           </body>