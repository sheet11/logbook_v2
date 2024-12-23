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
								<th width="5%">No.</th><th>Tanggal</th><th>Terlambat 1 s/d 30</th><th>Terlambat 31 s/d 60</th><th>Terlambat 61 s/d 90</th><th>Terlambat >90</th><th>Pulang 1 s/d 30</th><th>Pulang 31 s/d 60</th><th>Pulang 61 s/d 90</th><th>Pulang >90</th><th>Tidak Di Tempat </th><th>Tidak Hadir</th><th>Izin</th><th>Cuti</th><th>Hudis</th><th>PPK</th><th>Status</th><th>Aksi</th>
							</tr>
					</thead>
			<?php 
			include "../config/koneksi.php";
							
					$query=mysql_query("select * from tb_absensi where nip='$_SESSION[nip]' ");
				
					$i =  +1;		
				while($a=mysql_fetch_array($query)){
				echo"
				<tr>
					<td>$i</td>
					<td>$a[tanggal]</td>
					<td>$a[terlambatsatu]</td>
					<td>$a[terlambatdua]</td>
					<td>$a[terlambattiga]</td>
					<td>$a[terlambatempat]</td>
					<td>$a[pulangsatu]</td>
					<td>$a[pulangdua]</td>
					<td>$a[pulangtiga]</td>
					<td>$a[pulangempat]</td>
					<td>$a[tidakditempat]</td>
					<td>$a[tidakhadir]</td>
					<td>$a[izin]</td>
					<td>$a[cuti]</td>
					<td>$a[hudis]</td>
					<td>$a[ppk]</td>
					<td>$a[status]</td>
					<td><a href='06_edit_absensi.php?id_absensi=$a[id_absensi]'>
							<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
						</a> | <a href='06_delete_absensi.php?id_absensi=$a[id_absensi]' onclick='return confirm(\"Anda yakin akan menghapus $a[id_absensi] ?\")'>
							<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
						</a></td>

					
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




