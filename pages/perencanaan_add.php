<?php
include "../koneksinya.php";
include "../plugins/AES/function.php";
//print_r($_POST);

$sql=mysql_query("select * from pengaturan");
$data=mysql_fetch_array($sql);

if($_POST['pc']>$data['pc']){
	echo "PC Melebihi Jumlah yang Ada";
}
else{
	$berhasil=true;
	$sql_query=[];
	$j=0;
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
					mysql_query("INSERT INTO kalender(tanggal, jam_kerja, terpakai, sisa) VALUES ('".$tanggal."',".$jam_pengaturan['jam_kerja'].",".$_POST['jam_kerja'].",".$sisa.")");
				}else{
					$sisa=$data['jam_kerja']-$_POST['jam_kerja'];
					//mysql_query("INSERT INTO kalender(tanggal, jam_kerja, terpakai, sisa) VALUES ('".$tanggal."',".$data['jam_kerja'].",".$_POST['jam_kerja'].",".$sisa.")");
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
					$sisa=$data['jam_kerja']-$terpakai;
					$sql_query[$j]="update kalender set terpakai=".$terpakai.", sisa =".$sisa." where tanggal='".$tanggal."'";
					$berhasil=true;
					$j++;
				}
			}
		}		
	}
	if($berhasil){	
		$hari_pengolahan=0;
		for($k=0;$k<$j;$k++){
			$hasil=mysql_query($sql_query[$k]);
			//echo $hasil;
			$hari_pengolahan++;
		}
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
			
		$result=mysql_query("INSERT INTO kegiatan(nama,jadwal_awal,jadwal_selesai,target_dokumen,waktu_olah,jam_kerja,hari_kerja,pc,prediksi,rekomendasi) 
			VALUES ('".$_POST['nama']."','".tanggal($_POST['jadwal_awal'])."','".tanggal($_POST['jadwal_akhir'])."','".$_POST['target']."','".$_POST['olah']."','".$_POST['jam_kerja']."','".$hari_pengolahan."','".$_POST['pc']."','".$prediksi."','".$rekomendasi."')");
		if($result){
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