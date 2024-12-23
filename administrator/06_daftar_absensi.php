<?php include"01_nav.php";
 include "fucnt_tgl.php";
error_reporting(0); ?>
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap.css">

<div id="page-wrapper">
	<h2>Selamat Datang</h2>   
    <h5>Di Halaman Daftar Absensi</h5>

<div style="margin:20px;">	
	<a href="06_tambah_absensi.php" class="btn btn-primary">Tambah Absensi +</a>
</div>
      

			<div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>		
		  					<tr class="info">
								<th width="5%">No.</th><th>Nama</th><th>NIP</th><th>Jabatan</th><th>Golongan</th><th width="10%">Aksi</th>
							</tr>
					</thead>
			<?php 
			include "../config/koneksi.php";
							
					$query=mysql_query("select * from tb_pegawai");
				
					$i =  +1;		
				while($a=mysql_fetch_array($query)){
				echo"
				<tr>
					<td>$i</td>
					<td>$a[nama_lengkap]</td>
					<td>$a[nip]</td>
					<td>$a[jabatan]</td>
					<td>$a[golongan]</td>

					<td>
						<a href='06_lihat_absensi.php?pegawai=$a[nip]'><button class='btn btn-danger'>Lihat</button>
						
					</td>
				</tr>";

				$i++;
			}
			?>
			</table>
		
	 
	</div>
</div>
		<script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/dataTables.bootstrap.js"></script>	
        <script type="text/javascript">
            $(function() {
                $('#example1').dataTable();
            });
        </script>			




