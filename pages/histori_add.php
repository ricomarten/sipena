<?php
	if(isset($_POST['risiko']) && isset($_POST['mitigasi']) && isset($_POST['status_risiko'])){
		// include Database connection file 		
		include ("../koneksinya.php");
		$query = "INSERT INTO risiko (risiko,mitigasi,status) 
			VALUES ('".$_POST['risiko']."','".$_POST['mitigasi']."','".$_POST['status_risiko']."')";
		if (!$result = mysql_query($query)) {
			exit(mysql_error());
			 //echo "Username sudah pernah ada";
		}
		else{
			echo "Berhasil menambahkan risiko ";
		}	    
	}
?>