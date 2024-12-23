<?php
	include "session.php";
?>

<?php
	include"../config/koneksi.php";
	include("bar128.php");
    include("library.php");
  include("fucnt_tgl.php");
	
		
	$query=mysql_query("select * from tb_penelitian where username='$_SESSION[username]' ");
	 $a=mysql_fetch_array($query);
  $tanggal = tgl_indo($a['tanggal_masuk']);
?>
<html>
	<body>

   <body lang=EN-US style='tab-interval:36.0pt'>

<div class=Section1>

<div align=center>

<p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;font-family:"Bookman Old Style","serif"'><img src="../assets/img/kop.jpg"><o:p></o:p></span></b></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=642
 style='width:481.8pt;border-collapse:collapse;border:none;mso-yfti-tbllook:
 1184;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;mso-border-insideh:none;mso-border-insidev:
 none'>
 <p></p>

 
 <tr style='mso-yfti-irow:4;height:18.9pt'>
  <td width=214 valign=top style='width:160.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.9pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Times New Roman","serif"'>No <span
  class=SpellE>Pendaftaran</span><span style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><o:p></o:p></span></p>
  </td>
  <td width=21 valign=top style='width:16.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Times New Roman","serif"'>:<o:p></o:p></span></p>
  </td>
  <td width=407 valign=top style='width:305.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:left;line-height:normal'><span style='font-family:"Times New Roman","serif"'><o:p><?php echo "$a[id_pemohon]"; ?></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;height:20.1pt'>
  <td width=214 valign=top style='width:160.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:20.1pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span class=SpellE><span style='font-family:"Times New Roman","serif"'>Nama</span></span><span
  style='font-family:"Times New Roman","serif"'><span style='mso-tab-count:
  1'>&nbsp;&nbsp; </span><o:p></o:p></span></p>
  </td>
  <td width=21 valign=top style='width:16.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:20.1pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Times New Roman","serif"'>:   <o:p></o:p></span></p>
  </td>
  <td width=407 valign=top style='width:305.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:20.1pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:left;line-height:normal'><span style='font-family:"Times New Roman","serif"'><?php echo "$a[nama_pemohon]"; ?><o:p></o:p></span></p>
  </td>
 </tr>
 
 <tr style='mso-yfti-irow:2;height:20.1pt'>
  <td width=214 valign=top style='width:160.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:20.1pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span class=SpellE><span style='font-family:"Times New Roman","serif"'>Alamat</span></span><span
  style='font-family:"Times New Roman","serif"'><span style='mso-tab-count:
  1'>&nbsp;&nbsp; </span><o:p></o:p></span></p>
  </td>
  <td width=21 valign=top style='width:16.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:20.1pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Times New Roman","serif"'>:   <o:p></o:p></span></p>
  </td>
  <td width=407 valign=top style='width:305.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:20.1pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:left;line-height:normal'><span style='font-family:"Times New Roman","serif"'><?php echo "$a[alamat_pemohon]"; ?><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;height:20.1pt'>
  <td width=214 valign=top style='width:160.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:20.1pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span class=SpellE><span style='font-family:"Times New Roman","serif"'>Jenis Perizinan</span></span><span
  style='font-family:"Times New Roman","serif"'><span style='mso-tab-count:
  1'>&nbsp;&nbsp; </span><o:p></o:p></span></p>
  </td>
  <td width=21 valign=top style='width:16.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:20.1pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Times New Roman","serif"'>:   <o:p></o:p></span></p>
  </td>
  <td width=407 valign=top style='width:305.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:20.1pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:left;line-height:normal'><span style='font-family:"Times New Roman","serif"'>Izin Penelitian<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;height:18.9pt'>
  <td width=214 valign=top style='width:160.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.9pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Times New Roman","serif"'>No HP<span
  style='mso-tab-count:1'>&nbsp; </span><o:p></o:p></span></p>
  </td>
  <td width=21 valign=top style='width:16.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Times New Roman","serif"'>:<o:p></o:p></span></p>
  </td>
  <td width=407 valign=top style='width:305.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:left;line-height:normal'><span style='font-family:"Times New Roman","serif"'><o:p><?php echo "$a[no_hp_pemohon]"; ?></o:p></span></p>
  </td>
 </tr>
 


 <tr style='mso-yfti-irow:5;mso-yfti-lastrow:yes;height:110.2pt'>
  <td width=214 valign=bottom style='width:160.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:110.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Times New Roman","serif"'><o:p><?php echo bar128 (stripslashes($a['id_pemohon'])); ?></o:p></span></p>
  </td>
  <td width=21 valign=top style='width:16.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:110.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Times New Roman","serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=407 valign=top style='width:305.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:110.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Times New Roman","serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Times New Roman","serif"'>Bengkulu,&nbsp;&nbsp;<?php echo "$tanggal"; ?><o:p></o:p></span></p>

 
</table>

</div>

<p class=MsoNormal align=center style='text-align:center'><span
style='font-family:"Times New Roman","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal><span style='font-family:"Times New Roman","serif"'><o:p>&nbsp;</o:p></span></p>

</div>

</body>
</html>
<script>
  window.print();
</script>