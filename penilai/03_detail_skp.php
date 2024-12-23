<?php include"01_nav.php";
error_reporting(0); ?>
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap.css">

<div id="page-wrapper">
	<h2>Selamat Datang</h2>   
    <h5>Di Halaman Detail SKP</h5>

<div style="margin:20px;">	
	<a href="03_tambah_detail_skp.php?id_daftar_skp=<?php echo $_GET['id_daftar_skp']; ?>" class="btn btn-primary">Tambah Detail SKP +</a>
</div>
      

			<div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>		
		  					<tr class="info">
								<th width="5%">No.</th><th>Uraian SKP</th><th>Waktu</th><th>Output</th><th width="10%">Aksi</th>
							</tr>
					</thead>
			<?php 
			include "../config/koneksi.php";
							
					$query=mysql_query("select * from tb_detail_skp where id_daftar_skp='$_GET[id_daftar_skp]' order by id_detail_skp DESC");
				
					$i =  +1;		
				while($a=mysql_fetch_array($query)){
				echo"
				<tr>
					<td>$i</td>
					<td>$a[uraian_skp]</td>
					<td>$a[target_waktu]</td>
					<td>Jam</td>
					<td>
						<a href='03_edit_detail_skp.php?id_detail_skp=$a[id_detail_skp]'>
							<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
						</a> 

						<a href='03_delete_detail_skp.php?id_detail_skp=$a[id_detail_skp]' onclick='return confirm(\"Anda yakin akan menghapus Uraian Pekerjaan $a[uraian_pekerjaan] ?\")'>
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




