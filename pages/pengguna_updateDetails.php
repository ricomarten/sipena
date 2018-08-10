<?php
// include Database connection file
include ("../koneksinya.php");

// check request
if(isset($_POST))
{
    // get values
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    // Updaste User details
    $query = "UPDATE user SET 	password= '".$password."',
								status	= '".$level."'
								WHERE username = '$username'";
    if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error($conn));
    }
    else{
        echo "Berhasil update";
    }
}