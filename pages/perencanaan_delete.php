<?php
// check request
if($_POST['id'] != "")
{
    // include Database connection file
	include ("../koneksinya.php");
	include "../plugins/AES/function.php";

    // get user id
    $kode = $_POST['id'];

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