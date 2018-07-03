<?php
	if(isset($_POST['password']) && isset($_POST['username'])){
		// include Database connection file 
		if(strlen($_POST['password'])<6){
			echo "Password minimal 6 karakter";
		}
		else{
			include ("../koneksinya.php");
			$_POST['username']=str_replace("'","",$_POST['username']);
			$query = "INSERT INTO user (username,password,status) 
				VALUES ('".$_POST['username']."','".$_POST['password']."','".$_POST['level']."')";
			if (!$result = mysql_query($query)) {
				exit(mysql_error());
				 //echo "Username sudah pernah ada";
			}
			else{
				echo "Berhasil menambahkan user ".$_POST['username'];
			}
	    }
	}
?>