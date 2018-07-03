<?php
// include Database connection file
include ("../koneksinya.php");
// check request
if(isset($_POST['username']) && isset($_POST['username']) != "")
{
    // get User ID
    $kode = $_POST['username'];

    // Get User Details
    $query = "select u.*,l.nama as nama_level from user u 
                    left join status_user l on l.kode_status=u.status  WHERE username = '$kode'";
    if (!$result = mysql_query($query)) {
        exit(mysql_error());
    }
    $response = array();
    if(mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_assoc($result)) {
            $response = $row;
        }
    }
    else
    {
        $response['status'] = 200;
        $response['message'] = "Data not found!";
    }
    // display JSON data
    echo json_encode($response);
}
else
{
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}