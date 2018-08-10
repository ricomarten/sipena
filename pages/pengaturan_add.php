<?php
	if(isset($_POST['pc']) && isset($_POST['jam'])){
		// include Database connection file 
	
			include ("../koneksinya.php");
			$cari=mysqli_num_rows(mysqli_query($conn,"select * from pengaturan"));
			if($cari==0){
				$query = "INSERT INTO pengaturan (pc,jam_kerja) 
					VALUES (".$_POST['pc'].",".$_POST['jam'].")";
				if (!$result = mysqli_query($conn,$query)) {
					exit(mysqli_error($conn));
					 //echo "Username sudah pernah ada";
				}
				else{
					echo "Berhasil menambahkan pengaturan";
				}
			}else{
				$query = "update pengaturan set 
					pc =".$_POST['pc'].", jam_kerja=".$_POST['jam']."";
				if (!$result = mysqli_query($conn,$query)) {
					exit(mysqli_error($conn));
					 //echo "Username sudah pernah ada";
				}
				else{
					echo "Berhasil mengupdate pengaturan";
				}
			}
	    
	}
?>