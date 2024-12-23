<?php
include "../config/koneksi.php";
$detail = $_GET['detail'];
$dapat = mysql_query("SELECT * FROM tb_detail_skp WHERE id_detail_skp='$detail' order by id_detail_skp ASC");
while($k = mysql_fetch_array($dapat))
	{
    	echo "<option value=\"".$k['id_detail_skp']."\">".$k['alokasi_waktu']."</option>\n";
	}
?>
