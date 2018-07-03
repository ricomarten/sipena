<?php
// include Database connection file
include ("../koneksinya.php");

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
    $risiko = $_POST['risiko'];
    $mitigasi = $_POST['mitigasi'];
    $status = $_POST['status_risiko'];

    // Updaste User details
    $query = "UPDATE risiko SET risiko= '".$risiko."',
								mitigasi	= '".$mitigasi."',
								status	= '".$status."'
								WHERE id = ".$id."";
    if (!$result = mysql_query($query)) {
        exit(mysql_error());
    }
    else{
        echo "Berhasil update";
    }
}