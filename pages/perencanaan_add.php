<?php
include "../koneksinya.php";
//print_r($_POST);

$sql=mysql_query("select * from pengaturan");
$data=mysql_fetch_array($sql);

if($_POST['jam_kerja']>$data['jam_kerja']){
	echo "Jam Kerja Melebihi Batas Jam Kerja per Hari";
}
else if($_POST['pc']>$data['pc']){
	echo "PC Melebihi Jumlah yang Ada";
}
else{
	$berhasil=true;
	$sql_query=[];
	for($i=0;$i<count($_POST['hari']);$i++){
		if($_POST['hari'][$i]!=""){
			$tgl=explode("-",$_POST['hari'][$i]);
			$tanggal=$tgl[2]."-".$tgl[1]."-".$tgl[0];
			$queri=mysql_query("select * from kalender where tanggal='".$tanggal."'");
			$ada=mysql_num_rows($queri);
			$datakalender=mysql_fetch_array($queri);
			if($ada<=0){
				$berhasil=true;
				$sisa=$data['jam_kerja']-$_POST['jam_kerja'];
				mysql_query("INSERT INTO kalender(tanggal, jam_kerja, terpakai, sisa) VALUES ('".$tanggal."',".$data['jam_kerja'].",".$_POST['jam_kerja'].",".$sisa.")");
			}
			else{
				if($datakalender['sisa']<$_POST['jam_kerja']){
					$berhasil=false;
					$result_kal="Jam kerja pada tanggal ".$_POST['hari'][$i]." tersisa ".$datakalender['sisa']." jam";
					break;
				}
				else{
					$terpakai=$data['terpakai']+$_POST['jam_kerja'];
					$sisa=$data['jam_kerja']-$terpakai;
					$sql_query[$i]="update kalender set terpakai=".$terpakai.", sisa =".$sisa." where tanggal='".$tanggal."'";
					$berhasil=true;
				}
			}
		}		
	}
	if($berhasil){	
		$hari_pengolahan=0;
		for($i=0;$i<count($_POST['hari']);$i++){
			if($_POST['hari'][$i]!=""){
				if($ada>0){
					$hasil=mysql_query($sql_query[$i]);
					echo $hasil;
				}
				$hari_pengolahan++;
			}
		}
		
		$result=mysql_query("INSERT INTO kegiatan(nama,jadwal_awal,jadwal_selesai,target_dokumen,waktu_olah,jam_kerja,hari_kerja,pc) 
			VALUES ('".$_POST['nama']."','".tanggal($_POST['jadwal_awal'])."','".tanggal($_POST['jadwal_akhir'])."','".$_POST['target']."','".$_POST['olah']."','".$_POST['jam_kerja']."','".$hari_pengolahan."','".$_POST['pc']."')");
		echo $result;
	}else{
		echo $result_kal;
	}
}
?>