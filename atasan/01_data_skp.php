<?php
include "../config/koneksi.php";
$daftar = $_GET['daftar'];
$detail = mysql_query("SELECT id_detail_skp,uraian_skp FROM tb_detail_skp WHERE id_daftar_skp='$daftar' order by id_detail_skp ASC");
echo "<option>-- Pilih Uraian SKP --</option>";
while($k = mysql_fetch_array($detail))
	{
    	echo "<option value=\"".$k['id_detail_skp']."\">".$k['uraian_skp']."</option>\n";
	}
?>
