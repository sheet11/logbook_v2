<?php include"01_nav.php";
 include "fucnt_tgl.php";
error_reporting(0); ?>
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap.css">

<div id="page-wrapper">
	<h2>Selamat Datang</h2>   
    <h5>Di Halaman Logbook Harian</h5>
    	<div style="margin:20px;">	
			<a href="01_tambah_logbook.php" class="btn btn-primary">Tambah Log Book +</a>
		</div>

			<div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>		
		  					<tr class="info">
								<th width="5%">No.</th><th>Tanggal</th><th>Uraian Kegiatan</th><th>Jumlah Waktu</th><th>Keterangan/Kendala Kegiatan</th><th>Jumlah Kegiatan</th><th>Output Kegiatan</th><th width="10%">Aksi</th>
							</tr>
					</thead>
			<?php 
			include "../config/koneksi.php";
							
					$query=mysql_query("select * from tb_logbook where nip='$_SESSION[nip]' order by tanggal_logbook desc ");
				
					$i =  +1;		
				while($a=mysql_fetch_array($query)){
					$jumenit = substr($a['jumlah_menit'], 0, 5);
					$tgl = tgl_indo($a['tanggal_logbook']);
				echo"
				<tr>
					<td>$i</td>
					<td>$tgl</td>
					<td>$a[uraian_pekerjaan]</td>
					<td>$jumenit</td>
					<td>$a[keterangan]</td>
					<td>$a[jumlah_kegiatan]</td>
					<td>$a[output_kegiatan]</td>
					<td>
						<a href='01_edit_logbook.php?id_logbook=$a[id_logbook]'>
							<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
						</a> 

						<a href='01_delete_logbook.php?id_logbook=$a[id_logbook]' onclick='return confirm(\"Anda yakin akan menghapus $a[tanggal_kegiatan] ?\")'>
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




