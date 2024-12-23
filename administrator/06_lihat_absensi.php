<?php include"01_nav.php";
error_reporting(0); ?>
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap.css">

<div id="page-wrapper">
	<h2>Selamat Datang</h2>   
    	<h5>Di Halaman Daftar Absensi</h5>
			<div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>		
		  					<tr class="info">
								<th width="5%">No.</th><th>Tanggal</th><th>Terlambat Satu</th><th>Terlambat Dua</th><th>Terlambat Tiga</th><th>Terlambat Empat</th><th>Pulang Satu</th><th>Pulang Dua</th><th>Pulang Tiga</th><th>Pulang Empat</th><th>Tidak Di Tempat </th><th>Tidak Hadir</th><th>Tidak Izin</th><th>Izin</th><th>Cuti</th><th>Hudis</th><th>PPK</th>
							</tr>
					</thead>
			<?php 
			include "../config/koneksi.php";
							
					$query=mysql_query("select * from tb_absensi where nip='$_GET[pegawai]' ");
				
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
					<td>$a[tidakditepat]</td>
					<td>$a[tidakhadir]</td>
					<td>$a[tidakizin]</td>
					<td>$a[izin]</td>
					<td>$a[cuti]</td>
					<td>$a[hudis]</td>
					<td>$a[ppk]</td>

					
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




