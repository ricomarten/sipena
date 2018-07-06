<?php
include "../koneksinya.php";
include "../plugins/AES/function.php";
//print_r($_POST);


$datediff = strtotime(tanggal($_POST['jadwal_akhir'])) - strtotime(tanggal($_POST['jadwal_awal']));
$A=(round($datediff / (60 * 60 * 24))+1);
$B=$_POST['target'];
$C=$_POST['olah'];
$D=$B*$C;
$E=$_POST['jam_kerja'];
$F=$E*60;
$G=$_POST['pc'];
$H=round(($D/$F)/$G);

#Bila A = H maka selesai tepat waktu
#Bila A > H maka selesai lebih cepat (A-H) hari
#Bila A < H maka terlambat (A-H) hari
if($H==0) $H=1;
if($A==$H){
	$prediksi= "Selesai tepat waktu";
}elseif($A>$H){
	$prediksi= "Selesai lebih cepat ".($A-$H)." hari";
}elseif($A<$H){
	$prediksi= "Terlambat ".($H-$A)." hari";
}
echo "Dengan data yang ada maka pengolahan akan diselesaikan dalam $H hari. \n\nSelanjutnya silahkan tentukan tanggal rencana hari kerja sebanyak $H hari.";	
$rek=round(($D/$F)/$A);
$rek2=round(($D/($H*$G))/60);
$rekomendasi="Selanjutnya silahkan tentukan tanggal rencana hari kerja sebanyak $H hari.";
//echo "Status : ".$prediksi."\n";
// if($A<$H){
	// echo "Rekomendasi : ".$rekomendasi."\n";
// }
			
		
?>