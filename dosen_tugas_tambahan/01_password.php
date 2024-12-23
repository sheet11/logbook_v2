<?php
include"01_nav.php";
include "../assets/js/date.php";
include "../config/koneksi.php";
error_reporting(0);

$qr = mysql_query("SELECT * FROM tb_pegawai WHERE nip = '$_SESSION[nip]'");
$qry = mysql_fetch_array($qr);
?>

<body>
    <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Ubah Password</h2>   
                    </div>
                </div> 
                             
                 <!-- /. ROW  -->
                  <hr />
                  <div><form role="form" action="01_prosesedit_password.php" method="POST" >
									<div class="form-group">
										<label>NIP</label>
										<input class="form-control" value="<?php echo $qry['nip'];?>" disabled />
									</div>
									<div class="form-group">
										<label>Nama Lengkap</label>
										<input type="text" class="form-control" value="<?php echo $qry['nama_lengkap'];?>" disabled />
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="password" class="form-control" name="password1" required />
									</div>
									<div class="form-group">
										<label>Ulangi Password</label>
										<input type="password" class="form-control" name="password2" required />
									</div>
									<hr />
									<input type="submit" class="btn btn-default" name="submit" value="Simpan">
									<input type="reset" class="btn btn-primary" value="Hapus">
								</form>
            </div>
          </div>
            </div>   
           </body>