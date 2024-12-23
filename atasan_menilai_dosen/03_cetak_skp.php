
<?php
  include "session.php";
?>
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

      <div >
                <table class="table table-bordered table-striped">
                    <thead>   
                <tr class="info">
                <th width="5%">No.</th><th>Uraian Kegiatan</th><th>Alokasi Waktu</th>
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
          <td>$a[uraian_pekerjaan]</td>
          <td>$a[waktu]</td>

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




