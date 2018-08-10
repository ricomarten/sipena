<?php
include "../koneksinya.php";
include "../plugins/AES/function.php";
//print_r($_POST);
$berhasil=false;
$sql=mysqli_query($conn,"select * from pengaturan");
$data=mysqli_fetch_array($sql);
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
	$query_cari_kal=mysqli_query($conn,"select * from pengaturan2 where tanggal='".tanggal($_POST['hari'][$i])."'");
	$ketemu=mysqli_num_rows($query_cari_kal);
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
if($_POST['pc']>$data['pc']){
	echo "PC Melebihi Jumlah yang Ada";
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
else{
	$kode = $_POST['id'];
	$cari=mysqli_query($conn,"select * from kalender_kegiatan where id_kegiatan='".$kode."'");
	while($data=mysqli_fetch_array($cari)){
		$cari_kal=mysqli_query($conn,"select * from kalender where tanggal='".$data['tanggal']."'");
		$data_kal=mysqli_fetch_array($cari_kal);
		if(mysqli_num_rows($cari_kal)==1){
			$terpakai_edit=$data_kal['terpakai']-$data['jam_kerja'];
			$sisa_edit=$data_kal['jam_kerja']-$terpakai_edit;
			mysqli_query($conn,"update kalender set terpakai=".$terpakai_edit.",sisa=".$sisa_edit." where tanggal='".$data['tanggal']."'");
		}
	}
   
    $query2 = "DELETE from kalender_kegiatan WHERE id_kegiatan = '$kode'";
	$result2 = mysqli_query($conn,$query2);
    
	$berhasil=true;
	$sql_query=[];
	$j=0;
	$hari_pengolahan=0;
	for($i=0;$i<count($_POST['hari']);$i++){
		if($_POST['hari'][$i]!=""){
			$tgl=explode("-",$_POST['hari'][$i]);
			$tanggal=$tgl[2]."-".$tgl[1]."-".$tgl[0];
			$queri=mysqli_query($conn,"select * from kalender where tanggal='".$tanggal."'");
			$ada=mysqli_num_rows($queri);
			$datakalender=mysqli_fetch_array($queri);
			if($ada<=0){
				$berhasil=true;			
				$sql_pengaturan=mysqli_query($conn,"select * from pengaturan2 where tanggal='".$tanggal."'");
				if(mysqli_num_rows($sql_pengaturan)>0){
					$jam_pengaturan=mysqli_fetch_array($sql_pengaturan);
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
		if($H==0) $H=1;
		#Bila A = H maka selesai tepat waktu
		#Bila A > H maka selesai lebih cepat (A-H) hari
		#Bila A < H maka terlambat (A-H) hari
		
		if($A==$H){
			$prediksi= "Selesai tepat waktu";
		}elseif($A>$H){
			$prediksi= "Selesai lebih cepat ".($A-$H)." hari";
		}elseif($A<$H){
			$prediksi= "Terlambat ".($H-$A)." hari";
		}
		//echo $prediksi;
		if($H==0) $H=1;
		$rek=round(($D/$F)/$A);
		$rek2=round(($D/($A*$G))/60);
		if($A<$H){
			$rekomendasi="Penambahan PC menjadi $rek PC atau <br>Penambahan jam kerja menjadi ".($rek2)." jam perhari";
		}else $rekomendasi="";
		$date = tanggal($_POST['jadwal_awal']);
		$newdate = strtotime ( '-1 day' , strtotime ( $date ) ) ;
		$newdate = date ( 'j-m-Y' , $newdate );
		$rekomendasi.=" <br><i>Dokumen yang akan diolah harus sudah diserahkan paling lambat tanggal ".bulan($newdate)."</i>";
		
		$result=mysqli_query($conn,"update kegiatan set nama='".$_POST['nama']."',
												jadwal_awal='".tanggal($_POST['jadwal_awal'])."',
												jadwal_selesai='".tanggal($_POST['jadwal_akhir'])."',
												target_dokumen='".$_POST['target']."',
												waktu_olah='".$_POST['olah']."',
												jam_kerja='".$_POST['jam_kerja']."',
												hari_kerja='".$hari_pengolahan."',
												pc='".$_POST['pc']."',
												prediksi='".$prediksi."',
												rekomendasi='".$rekomendasi."' 
		where id=".$kode."");
		if($result){
			for($k=0;$k<$j;$k++){
				$hasil=mysqli_query($conn,$sql_query[$k]);
				//echo $hasil;	
			}
			$cari_id=mysqli_query($conn,"select id from kegiatan where nama='".$_POST['nama']."'");
			$hasil_id=mysqli_fetch_array($cari_id);
			for($i=0;$i<count($_POST['hari']);$i++){
				if($_POST['hari'][$i]!=""){
					$hasil_kal=mysqli_query($conn,"INSERT INTO kalender_kegiatan(id_kegiatan, tanggal, jam_kerja) VALUES (".$hasil_id['id'].",'".tanggal($_POST['hari'][$i])."',".$_POST['jam_kerja'].")");
				}
			}
			
			echo "Berhasil mengupdate perencanaan#";
			echo paramEncrypt('page=perencanaan');
		}	
		
	}else{
		echo $result_kal;
	}
}
?>