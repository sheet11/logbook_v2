<?php include"01_nav.php";
error_reporting(0); ?>
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap.css">

<div id="page-wrapper">
	<h2>Selamat Datang</h2>   
    <h5>Di Halaman Daftar SKP</h5>

<div style="margin:20px;">	
	<a href="03_tambah_skp.php" class="btn btn-primary">Tambah SKP +</a>  &nbsp;&nbsp;&nbsp;<a href="03_cetak_skp.php" class="btn btn-warning">Cetak SKP</a>
</div>
      

			<div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>		
		  					<tr class="info">
								<th width="5%">No.</th><th>Nama SKP</th><th>Uraian Kegiatan</th><th>Target Kegiatan/Tahun</th><th>Output Kegiatan</th><th>Alokasi Waktu Per Hari</th><th width="10%">Aksi</th>
							</tr>
					</thead>
			<?php 
			include "../config/koneksi.php";
							
					$query=mysql_query("select * from tb_daftar_skp where nip='$_SESSION[nip]' order by uraian_pekerjaan asc");
				
					$i =  +1;		
				while($a=mysql_fetch_array($query)){
				echo"
				<tr>
					<td>$i</td>
					<td>$a[nama_skp]</td>
					<td>$a[uraian_pekerjaan]</td>
					<td>$a[jumlah_kegiatan]</td>
					<td>$a[output_kegiatan]</td>
					<td>$a[waktu]</td>
					<td>
						<a href='03_edit_skp.php?id_daftar_skp=$a[id_daftar_skp]'>
							<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
						</a> 

						<a href='03_delete_skp.php?id_daftar_skp=$a[id_daftar_skp]' onclick='return confirm(\"Anda yakin akan menghapus Uraian Pekerjaan $a[uraian_pekerjaan] ?\")'>
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




