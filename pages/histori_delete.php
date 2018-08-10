<?php
// check request
if(isset($_POST['id']) && $_POST['id'] != "")
{
    // include Database connection file
	include ("../koneksinya.php");

    // get user id
    $kode = $_POST['id'];

    // delete User
    $query = "DELETE from risiko WHERE id = '$kode'";
    if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error($conn));
    }
}
?>