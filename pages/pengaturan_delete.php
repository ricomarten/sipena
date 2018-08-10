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
    if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error($conn));
    }
}
?>