<?php 
	include"01_nav.php";
    error_reporting(0); 
?>
<div id="page-wrapper">
	<h2>Selamat Datang</h2>   
    <h5>Di Halaman Daftar Semua Pegawai</h5>
	<div style="margin:20px;">
		<a href="08_cetak_realisasi_pegawai.php" class="btn btn-warning">Ceta Data Pegawai</a>
		<a href="08_export_to_excel_realisasi_pegawai.php" class="btn btn-success">Export to Excel</a>
	</div>
      

			<div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>		
		  					<tr class="info">
								<th width="5%">No.</th><th>NIP</th><th>Nama Pegawai</th><th>Logbook/Tugas Tambahan</th><th>Dosen Murni</th>
							</tr>
					</thead>
			<?php 
				include "../config/koneksi.php";
								
						$query=mysql_query("select * from tb_pegawai ");
					
						$i =  +1;		
					while($a=mysql_fetch_array($query))
						{
							echo"
							<tr>
								<td>$i</td>
								<td>$a[nip]</td>
								<td>$a[nama_lengkap]</td>
								<td>100%</td>
								<td>100%</td>
								
							</tr>";

							$i++;
						}
			?>
			</table>
	</div>
</div>
			




