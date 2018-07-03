<?php
// check request
if($_POST['tgl'] != "")
{
    // include Database connection file
	include ("../koneksinya.php");

    // get user id
    $kode = $_POST['tgl'];

    // delete User
    $query = "DELETE from pengaturan2 WHERE tanggal = '$kode'";
    if (!$result = mysql_query($query)) {
        exit(mysql_error());
    }
}
?>