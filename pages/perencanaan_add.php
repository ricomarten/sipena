<?php
include "../koneksinya.php";
include "../plugins/AES/function.php";
//print_r($_POST);
$berhasil=false;
$sql=mysql_query("select * from pengaturan");
$data=mysql_fetch_array($sql);
$cek_nama=mysql_query("select nama from kegiatan where nama='".$_POST['nama']."'");

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
for($i=0;$i<count($_POST['hari']);$i++){
	$query_cari_kal=mysql_query("select * from pengaturan2 where tanggal='".tanggal($_POST['hari'][$i])."'");
	$ketemu=mysql_num_rows($query_cari_kal);
  // Check that user date is between start & end
  if($ketemu>0){
	  $cek_kal=false;
  }
  else{
	  $cek_kal=true;
	  $tanggal_setting=$_POST['hari'][$i];
	  break;
  }
}
if(mysql_num_rows($cek_nama)>0){
	echo "Nama kegiatan tidak boleh sama";
}
elseif($cek_batas){
	echo "Rencana pengerjaan tidak boleh diluar rentang jadwal pengolahan";
}
elseif($cek_kal){
	echo "Tanggal ".$tanggal_setting." belum dientri di pengaturan";
}
elseif(count($_POST['hari']) !== count(array_unique($_POST['hari']))) {
	echo "Tanggal tidak boleh sama";
}
elseif($_POST['pc']>$data['pc']){
	echo "PC Melebihi Jumlah yang Ada";
}
else{
	$berhasil=true;
	$sql_query=[];
	$j=0;
	$hari_pengolahan=0;
	for($i=0;$i<count($_POST['hari']);$i++){
		if($_POST['hari'][$i]!=""){
			$tgl=explode("-",$_POST['hari'][$i]);
			$tanggal=$tgl[2]."-".$tgl[1]."-".$tgl[0];
			$queri=mysql_query("select * from kalender where tanggal='".$tanggal."'");
			$ada=mysql_num_rows($queri);
			$datakalender=mysql_fetch_array($queri);
			if($ada<=0){
				$berhasil=true;			
				$sql_pengaturan=mysql_query("select * from pengaturan2 where tanggal='".$tanggal."'");
				if(mysql_num_rows($sql_pengaturan)>0){
					$jam_pengaturan=mysql_fetch_array($sql_pengaturan);
					$sisa=$jam_pengaturan['jam_kerja']-$_POST['jam_kerja'];
					$sql_query[$j]="INSERT INTO kalender(tanggal, jam_kerja, terpakai, sisa) VALUES ('".$tanggal."',".$jam_pengaturan['jam_kerja'].",".$_POST['jam_kerja'].",".$sisa.")";
					$j++;
				}else{
					$sisa=$data['jam_kerja']-$_POST['jam_kerja'];
					$sql_query[$j]="INSERT INTO kalender(tanggal, jam_kerja, terpakai, sisa) VALUES ('".$tanggal."',".$data['jam_kerja'].",".$_POST['jam_kerja'].",".$sisa.")";
					$j++;
				}
			}
			else{
				if($datakalender['sisa']<$_POST['jam_kerja']){
					$berhasil=false;
					$result_kal="Jam kerja pada tanggal ".$_POST['hari'][$i]." tersisa ".$datakalender['sisa']." jam";
					break;
				}
				else{
					$terpakai=$datakalender['terpakai']+$_POST['jam_kerja'];
					$sisa=$datakalender['jam_kerja']-$terpakai;
					$sql_query[$j]="update kalender set terpakai=".$terpakai.", sisa =".$sisa." where tanggal='".$tanggal."'";
					$berhasil=true;
					$j++;
				}
			}
			$hari_pengolahan++;
		}		
	}
	if($berhasil){	
		
		//$datediff = strtotime(tanggal($_POST['jadwal_akhir'])) - strtotime(tanggal($_POST['jadwal_awal']));
		//$A=(round($datediff / (60 * 60 * 24))+1);
		$hari_pengolahan=0;
		for($i=0;$i<count($_POST['hari']);$i++){
			if($_POST['hari'][$i]!=""){
				$hari_pengolahan++;
			}		
		}
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
		//echo $prediksi;
		$rek=round(($D/$F)/$A);
		$rek2=round(($D/($H*$G))/60);
		if($A<$H){
			$rekomendasi="Menambah $rek PC Pengolahan atau <br>Penambahan jam kerja menjadi ".($rek2+$E)." jam perhari";
		}else $rekomendasi="";
		$date = tanggal($_POST['jadwal_awal']);
		$newdate = strtotime ( '-1 day' , strtotime ( $date ) ) ;
		$newdate = date ( 'j-m-Y' , $newdate );
		$rekomendasi.=" <br><i>Dokumen yang akan diolah harus sudah diserahkan paling lambat tanggal ".bulan($newdate)."</i>";
		$result=mysql_query("INSERT INTO kegiatan(nama,jadwal_awal,jadwal_selesai,target_dokumen,waktu_olah,jam_kerja,hari_kerja,pc,prediksi,rekomendasi) 
		VALUES ('".$_POST['nama']."','".tanggal($_POST['jadwal_awal'])."','".tanggal($_POST['jadwal_akhir'])."','".$_POST['target']."','".$_POST['olah']."','".$_POST['jam_kerja']."','".$hari_pengolahan."','".$_POST['pc']."','".$prediksi."','".$rekomendasi."')");
		if($result){
			for($k=0;$k<$j;$k++){
				$hasil=mysql_query($sql_query[$k]);
				//echo $hasil;	
			}
			$cari_id=mysql_query("select id from kegiatan where nama='".$_POST['nama']."'");
			$hasil_id=mysql_fetch_array($cari_id);
			for($i=0;$i<count($_POST['hari']);$i++){
				if($_POST['hari'][$i]!=""){
					$hasil_kal=mysql_query("INSERT INTO kalender_kegiatan(id_kegiatan, tanggal, jam_kerja) VALUES (".$hasil_id['id'].",'".tanggal($_POST['hari'][$i])."',".$_POST['jam_kerja'].")");
				}
			}
			
			echo "Berhasil menambahkan perencanaan#";
			echo paramEncrypt('page=perencanaan');
		}	
		
	}else{
		echo $result_kal;
	}
}
?>