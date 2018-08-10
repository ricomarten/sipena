<?php
include "../koneksinya.php";
include "../plugins/AES/function.php";
//print_r($_POST);
for($i=0;$i<count($_POST['hari']);$i++){
	$start_ts = strtotime(tanggal($_POST['jadwal_awal']));
	$end_ts = strtotime(tanggal($_POST['jadwal_akhir']));
	$user_ts = strtotime(tanggal($_POST['hari'][$i]));

  // Check that user date is between start & end
  if(($user_ts >= $start_ts) && ($user_ts <= $end_ts)){
	  $cek_batas=false;
  }
  else{
	  $cek_batas=true;
	  break;
  }
}
if($cek_batas){
	echo "error#Rencana pengerjaan tidak boleh diluar rentang jadwal pengolahan";
}else{
	$hari_pengolahan=0;
	for($i=0;$i<count($_POST['hari']);$i++){
		if($_POST['hari'][$i]!=""){
			$hari_pengolahan++;
		}		
	}
	//$datediff = strtotime(tanggal($_POST['jadwal_akhir'])) - strtotime(tanggal($_POST['jadwal_awal']));
	//$A=(round($datediff / (60 * 60 * 24))+1);
	$A=round($hari_pengolahan);
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
	echo "Dengan data yang ada dibutuhkan $H hari untuk menyelesaikan pengolahan data\n\n";	
	$rek=round(($D/$F)/$A);
	$rek2=round(($D/($A*$G))/60);
	$rekomendasi="Penambahan PC menjadi $rek PC atau \nPenambahan jam kerja menjadi ".($rek2)." jam perhari";
	echo "Status : ".$prediksi."\n";
	if($A<$H){
		echo "Rekomendasi : ".$rekomendasi."\n";
	}
}

			
		
?>