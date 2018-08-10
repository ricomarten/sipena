<?php
// check request
if($_POST['id'] != "")
{
    // include Database connection file
	include ("../koneksinya.php");
	include "../plugins/AES/function.php";

    // get user id
    $kode = $_POST['id'];
	$cari=mysqli_query($conn,"select * from kalender_kegiatan where id_kegiatan='".$kode."'");
	while($data=mysqli_fetch_array($cari)){
		$cari_kal=mysqli_query($conn,"select * from kalender where tanggal='".$data['tanggal']."'");
		$data_kal=mysqli_fetch_array($cari_kal);
		if(mysqli_num_rows($cari_kal)==1){
			$terpakai=$data_kal['terpakai']-$data['jam_kerja'];
			$sisa=$data_kal['jam_kerja']-$terpakai;
			mysqli_query($conn,"update kalender set terpakai=".$terpakai.",sisa=".$sisa." where tanggal='".$data['tanggal']."'");
		}
	}
	$cek_dokumen=mysqli_query($conn,"select dokumen from kegiatan where id='".$kode."'");
	$dokumen=mysqli_fetch_array($cek_dokumen);
	if($dokumen['dokumen']!=''){
		$destFolder = '../upload/';
		unlink($destFolder.$dokumen['dokumen']);
	}
    // delete User
    $query1 = "DELETE from kegiatan WHERE id = '$kode'";
	$query2 = "DELETE from kalender_kegiatan WHERE id_kegiatan = '$kode'";
	$result1 = mysqli_query($conn,$query1);
	$result2 = mysqli_query($conn,$query2);
    if (!$result1 || !$result2 ) {
        echo "gagal hapus";
    }
	else{
		echo "Berhasil menghapus perencanaan#";
		echo paramEncrypt('page=perencanaan');
	}
}
?>