<?php
//koneksi mwsql
$conn = mysqli_connect('localhost','root','');
if (!$conn) {
	die('Could not connect: ' . mysqli_connect_error());
}
mysqli_select_db($conn,'sipena');
//mysql_select_db('spi_monada', $conn);

function tanggal($tanggal){
	$tgl=explode("-",$tanggal);
	return $tgl[2]."-".$tgl[1]."-".$tgl[0];
}
function bulan($tanggal){
	$tgl=explode("-",$tanggal);
	if($tgl[1]=='1' || $tgl[1]=='01') $bulan="Januari";
	elseif($tgl[1]=='2' || $tgl[1]=='02') $bulan="Februari";
	elseif($tgl[1]=='3' || $tgl[1]=='03') $bulan="Maret";
	elseif($tgl[1]=='4' || $tgl[1]=='04') $bulan="April";
	elseif($tgl[1]=='5' || $tgl[1]=='05') $bulan="Mei";
	elseif($tgl[1]=='6' || $tgl[1]=='06') $bulan="Juni";
	elseif($tgl[1]=='7' || $tgl[1]=='07') $bulan="Juli";
	elseif($tgl[1]=='8' || $tgl[1]=='08') $bulan="Agustus";
	elseif($tgl[1]=='9' || $tgl[1]=='09') $bulan="September";
	elseif($tgl[1]=='10') $bulan="Oktober";
	elseif($tgl[1]=='11') $bulan="November";
	else $bulan="Desember";
	
	return $tgl[0]." ".$bulan." ".$tgl[2];
}
?>