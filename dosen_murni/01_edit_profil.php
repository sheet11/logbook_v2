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
                     <h2>Edit Profil</h2>   
                    </div>
                </div> 
                             
                 <!-- /. ROW  -->
                  <hr />
                 	 <div>
                 	 		<form role="form" action="01_prosesedit_profil.php" method="POST" enctype="multipart/form-data" >
									<div class="form-group">
										<label>NIP</label>
										<input class="form-control" value="<?php echo $qry['nip'];?>" disabled />
									</div>
									<div class="form-group">
										<label>Nama Lengkap</label>
										<input type="text" class="form-control" value="<?php echo $qry['nama_lengkap'];?>" name="nama" required />
									</div>
									<div class="form-group">
										<label>Pangkat</label>
										<textarea class="form-control" name="pangkat" required ><?php echo $qry['pangkat'];?></textarea>
									</div>
									<div class="form-group">
										<label>Jabatan</label>
										<textarea class="form-control" name="jabatan" required ><?php echo $qry['jabatan'];?></textarea>
									</div>
									<div class="form-group">
										<label>Unit Kerja</label>
										<textarea class="form-control" name="unit_kerja" required ><?php echo $qry['unit_kerja'];?></textarea>
									</div>
									<div class="form-group">
										<label>Alamat</label>
										<textarea class="form-control" name="alamat" required ><?php echo $qry['alamat'];?></textarea>
									</div>
									<div class="form-group">
										<label>Kontak</label>
										<input type="number" class="form-control" name="telepon" value="<?php echo $qry['no_hp'];?>" required />
									</div>

									<div class="form-group">
										<label>Nama Bank</label>
										<input type="text" class="form-control" name="nama_bank" value="<?php echo $qry['nama_bank'];?>"/>
									</div>

									<div class="form-group">
										<label>Atas Nama</label>
										<input type="text" class="form-control" name="atas_nama" value="<?php echo $qry['atas_nama'];?>" />
									</div>

									<div class="form-group">
										<label>No Rekening</label>
										<input type="number" class="form-control" name="no_rekening" value="<?php echo $qry['no_rekening'];?>"/>
									</div>


									<div class="form-group">
										<label>Foto Profil</label>
										<input type="file" class="form-control" name="foto" />
										<small> *) Kosongkan jika tidak di ubah. </small><br />
										<small> *) Type gambar harus .jpg , .jpeg , .gif , .png </small><br />
										<small> *) Ukuran tidak boleh melebihi 1 Mb </small>
									</div>
									<hr />
									<input type="submit" class="btn btn-default" name="submit" value="Simpan">
									<input type="reset" class="btn btn-primary" value="Hapus">
								</form>
            </div>
          </div>
            </div>   
           </body>