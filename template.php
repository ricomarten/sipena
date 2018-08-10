<?php
include ("koneksinya.php");
$sql=mysqli_query($conn,"select * from kegiatan where id='".$_GET['id']."'");
$data=mysqli_fetch_array($sql);
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=Dokumen Kesepakatan ".$data['nama'].".doc");
        
?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
<title>Asdasdasd</title>
<style>
<!--
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
    {margin:0cm;
    margin-bottom:.0001pt;
    font-size:12.0pt;
    font-family:"Times New Roman";}
@page Section1
    {size:595.3pt 841.9pt;
    margin:2.0cm 42.5pt 2.0cm 3.0cm;}
div.Section1
    {page:Section1;}
-->
</style>

</head>

<body lang=EN>

<div class=Section1>

<p class=MsoNormal><span lang=LV style='font-size:11.0pt;font-family:"Arial";'>
<center><b>KESEPAKATAN PERENCANAAN PENGOLAHAN DATA</b></center>
<br>
<br>
<br>
<br>
Yang bertanda tangan di bawah ini:<br>
<ol>
<li>Kepala BPS Kabupaten Tapanuli Utara</li>
<li>Subject Matter dan </li>
<li>Kepala Seksi IPDS</li>
</ol>
<br>
<span style="line-height:2">Telah membuat Kesepakatan Perencanaan <?php echo $data['nama'];?> pada tanggal <?php echo bulan(tanggal(date("Y-m-d")));?> dengan rincian seperti pada aplikasi SI PENA.Demikian kesepakatan ini dibuat agar dapat dipatuhi bersama.</span>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
(Kepala)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
(Subject Matter)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Kepala Seksi IPDS)

</span></p>
</div>

</body>

</html>
 