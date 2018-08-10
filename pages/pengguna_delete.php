<?php
// check request
if(isset($_POST['username']) && $_POST['username'] != "")
{
    // include Database connection file
	include ("../koneksinya.php");

    // get user id
    $kode = $_POST['username'];

    // delete User
    $query = "DELETE from user WHERE username = '$kode'";
    if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error($conn));
    }
}
?>