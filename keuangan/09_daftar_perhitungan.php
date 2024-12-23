<?php include"01_nav.php";
error_reporting(0); ?>
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap.css">

<div id="page-wrapper">
	<h2>Selamat Datang</h2>   
    <h5>Di Halaman Daftar Semua Pegawai</h5>

	<div style="margin:20px;">	
		<a href="09_tambah_perhitungan.php" class="btn btn-primary">Tambah Perhitungan +</a>
	</div>
      

			<div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>		
		  					<tr class="info">
								<th width="5%">No.</th><th>Total P2</th><th>Standar Waktu</th><th>Tanggal</th><th>Nip</th><th>Nama Pegawai</th><th width="10%">Aksi</th>
							</tr>
					</thead>
			<?php 
			include "../config/koneksi.php";
							
					$query=mysql_query("select * from tb_hitungan as h, tb_pegawai as p WHERE h.nip=p.nip ORDER BY tanggal_hitungan ASC ");
				
					$i =  +1;		
				while($a=mysql_fetch_array($query)){
				echo"
				<tr>
					<td>$i</td>
					<td>$a[p2]</td>
					<td>$a[standar_waktu]</td>
					<td>$a[tanggal_hitungan]</td>
					<td>$a[nip]</td>
					<td>$a[nama_lengkap]</td>
					<td>
						<a href='09_edit_perhitungan.php?id_perhitungan=$a[id_hitungan]'>
							<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
						</a> 

						<a href='09_delete_perhitungan.php?id_perhitungan=$a[id_hitungan]' onclick='return confirm(\"Anda yakin akan menghapus $a[nama_lengkap] ?\")'>
							<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
						</a>
						
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




