<?php
	if(isset($_POST['pc']) && isset($_POST['jam'])){
		// include Database connection file 
	
			include ("../koneksinya.php");
			$cari=mysql_num_rows(mysql_query("select * from pengaturan"));
			if($cari==0){
				$query = "INSERT INTO pengaturan (pc,jam_kerja) 
					VALUES (".$_POST['pc'].",".$_POST['jam'].")";
				if (!$result = mysql_query($query)) {
					exit(mysql_error());
					 //echo "Username sudah pernah ada";
				}
				else{
					echo "Berhasil menambahkan pengaturan";
				}
			}else{
				$query = "update pengaturan set 
					pc =".$_POST['pc'].", jam_kerja=".$_POST['jam']."";
				if (!$result = mysql_query($query)) {
					exit(mysql_error());
					 //echo "Username sudah pernah ada";
				}
				else{
					echo "Berhasil mengupdate pengaturan";
				}
			}
	    
	}
?>