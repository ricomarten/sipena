<?php
include "../koneksinya.php";
include "../plugins/AES/function.php";
//print_r($_POST);
$berhasil=false;
$sql=mysql_query("select * from pengaturan");
$data=mysql_fetch_array($sql);
if($_POST['pc']>$data['pc']){
	echo "PC Melebihi Jumlah yang Ada";
}
else{
	$kode = $_POST['id'];
	$cari=mysql_query("select * from kalender_kegiatan where id_kegiatan='".$kode."'");
	while($data=mysql_fetch_array($cari)){
		$cari_kal=mysql_query("select * from kalender where tanggal='".$data['tanggal']."'");
		$data_kal=mysql_fetch_array($cari_kal);
		if(mysql_num_rows($cari_kal)==1){
			$terpakai_edit=$data_kal['terpakai']-$data['jam_kerja'];
			$sisa_edit=$data_kal['jam_kerja']-$terpakai_edit;
			mysql_query("update kalender set terpakai=".$terpakai_edit.",sisa=".$sisa_edit." where tanggal='".$data['tanggal']."'");
		}
	}
   
    $query2 = "DELETE from kalender_kegiatan WHERE id_kegiatan = '$kode'";
	$result2 = mysql_query($query2);
    
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
		if($H==0) $H=1;
		$rek=round(($D/$F)/$A);
		$rek2=round(($D/($H*$G))/60);
		if($A<$H){
			$rekomendasi="Menambah $rek PC Pengolahan atau <br>Penambahan jam kerja menjadi ".($rek2+$E)." jam perhari";
		}else $rekomendasi="";
		
		$result=mysql_query("update kegiatan set nama='".$_POST['nama']."',
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
			
			echo "Berhasil mengupdate perencanaan#";
			echo paramEncrypt('page=perencanaan');
		}	
		
	}else{
		echo $result_kal;
	}
}
?>