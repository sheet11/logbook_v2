<?php
  include"01_nav.php";
?>

<body>
    <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
	                    <h2>Poltekkes Kemenkes Bengkulu </h2>   
	                    <h5>Selamat Datang <b><?php echo $_SESSION['nama_lengkap'];?></b> Di Halaman Aplikasi Log Book Online </h5>
                	</div>
                </div> 
                  	<hr />
                <div>
				<?php
					$foto = mysql_query("SELECT * FROM tb_pegawai WHERE nip = '$_SESSION[nip]'");
					$ft = mysql_fetch_array($foto);

				?>
                  	<table class="table table-bordered">  
	                    <tr class="success">
	                        <td colspan="4"><b>Data Pegawai</b></td>
	                    </tr> 
	                    <tr>
	                        <td rowspan="11" width="15%">
	                            <a href="../assets/foto/<?php echo $ft['foto_profil'];?>" class="fancy">
	                            <img src="../assets/foto/<?php echo $ft['foto_profil'];?>" class="user-image img-responsive"></td>
	                        <td width="15%">NIP</td>
	                        <td width="2%">:</td>
	                        <td><?php echo $ft['nip'];?></td>
	                    </tr>

	                    <tr>
	                        <td>Nama Pegawai</td>
	                        <td width="2%">:</td>
	                        <td><?php echo $ft['nama_lengkap'];?></td>
	                    </tr>

	                    <tr>
	                        <td>Pangkat</td>
	                        <td width="2%">:</td>
	                        <td><?php echo $ft['pangkat'];?></td>
	                    </tr>

	                    <tr>
	                        <td>Jabatan</td>
	                        <td width="2%">:</td>
	                        <td><?php echo $ft['jabatan'];?></td>
	                    </tr>

	                    <tr>
	                        <td>Unit Kerja</td>
	                        <td width="2%">:</td>
	                        <td><?php echo $ft['unit_kerja'];?></td>
	                    </tr>

	                    <tr>
	                        <td>Alamat</td>
	                        <td width="2%">:</td>
	                        <td><?php echo $ft['alamat'];?></td>
	                    </tr>

	                    <tr>
	                        <td>Kontak</td>
	                        <td width="2%">:</td>
	                        <td><?php echo $ft['no_hp'];?></td>
	                    </tr>

	                    <tr>
	                        <td colspan="3"><a href="01_edit_profil.php"><button class='btn btn-danger' >Edit</button></a></td>
	                    </tr>
                  	</table>
                </div>
            </div>
        </div>
   	</div>   
</body>