<script src="../assets/js/jquery-1.11.0.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css" />
    <!-- Bootstrap Core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- BOOTSTRAP STYLES-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />


<div id="page-wrapper">  
    <h3>Daftar Data Pegawai</h3>

       <table id="example1" class="table table-bordered table-striped">
            		
		  					<tr class="info">
								<th width="5%">No.</th><th>NIP</th><th>Nama Pegawai</th><th>Alamat</th><th>No HP</th><th>Pangkat</th><th>Jabatan</th><th>Unit Kerja</th><th>Grade</th><th>Total P2</th><th>Nama Bank</th><th>Atas Nama</th><th>No Rekening</th>
			<?php 
			include "../config/koneksi.php";
							
					$query=mysql_query("select * from tb_pegawai ");
				
					$i =  +1;		
				while($a=mysql_fetch_array($query)){
				echo"
				<tr>
					<td>$i</td>
					<td>$a[nip]</td>
					<td>$a[nama_lengkap]</td>
					<td>$a[alamat]</td>
					<td>$a[no_hp]</td>
					<td>$a[pangkat]</td>
					<td>$a[jabatan]</td>
					<td>$a[unit_kerja]</td>
					<td>$a[grade]</td>
					<td>$a[p2]</td>
					<td>$a[nama_bank]</td>
					<td>$a[atas_nama]</td>
					<td>$a[no_rekening]</td>

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




