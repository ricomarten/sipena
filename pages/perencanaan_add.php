<?php
include "../koneksinya.php";
print_r($_POST);

$sql=mysql_query("select * from pengaturan");
$data=mysql_fetch_array($sql);

if($_POST['jam_kerja']>$data['jam_kerja']){
	echo "Jam Kerja Melebihi Batas Jam Kerja per Hari";
}
else if($_POST['pc']>$data['pc']){
	echo "PC Melebihi Jumlah yang Ada";
}
else{
	for($i=0;$i<count($_POST['hari']);$i++){
		if($_POST['hari'][$i]!=""){
			$tgl=explode("-",$_POST['hari'][$i]);
			$tanggal=$tgl[2]."-".$tgl[1]."-".$tgl[0];
			$queri=mysql_query("select * from kalender where tanggal='".$tanggal."'");
			$ada=mysql_num_rows($queri);
			if($ada==0){
				//mysql_query("INSERT INTO kalender(tanggal, jam_kerja, terpakai, sisa) VALUES ('".$tanggal."',".$data['jam_kerja'].",0,".$data['jam_kerja'].")");
			}
		}
		
	}
	//mysql_query("INSERT INTO kegiatan(nama,jadwal_awal,jadwal_selesai,target_dokumen,waktu_olah,jam_kerja,hari_kerja,pc) 
	//		VALUES ('".$_POST['nama']."','".$_POST['jadwal_awal']."','".$_POST['jadwal_akhir']."','".$_POST['target']."','".$_POST['olah']."','".$_POST['jam_kerja']."','".$_POST['nama']."','".$_POST['pc']."')");
}
?>