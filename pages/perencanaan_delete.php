<?php
// check request
if($_POST['id'] != "")
{
    // include Database connection file
	include ("../koneksinya.php");
	include "../plugins/AES/function.php";

    // get user id
    $kode = $_POST['id'];
	$cari=mysql_query("select * from kalender_kegiatan where id_kegiatan='".$kode."'");
	while($data=mysql_fetch_array($cari)){
		$cari_kal=mysql_query("select * from kalender where tanggal='".$data['tanggal']."'");
		$data_kal=mysql_fetch_array($cari_kal);
		if(mysql_num_rows($cari_kal)==1){
			$terpakai=$data_kal['terpakai']-$data['jam_kerja'];
			$sisa=$data_kal['jam_kerja']-$terpakai;
			mysql_query("update kalender set terpakai=".$terpakai.",sisa=".$sisa." where tanggal='".$data['tanggal']."'");
		}
	}
    // delete User
    $query1 = "DELETE from kegiatan WHERE id = '$kode'";
	$query2 = "DELETE from kalender_kegiatan WHERE id_kegiatan = '$kode'";
	$result1 = mysql_query($query1);
	$result2 = mysql_query($query2);
    if (!$result1 || !$result2 ) {
        echo "gagal hapus";
    }
	else{
		echo "Berhasil menghapus perencanaan#";
		echo paramEncrypt('page=perencanaan');
	}
}
?>