<?php
	if(isset($_POST['jam']) && isset($_POST['tanggal']) && isset($_POST['pc'])){
		// include Database connection file 
		include ("../koneksinya.php");
		$tgl=explode("-",$_POST['tanggal']);
		$tanggal=$tgl[2]."-".$tgl[1]."-".$tgl[0];
		$query = "INSERT INTO pengaturan2 (tanggal,jam_kerja,pc) 
			VALUES ('".$tanggal."',".$_POST['jam'].",".$_POST['pc'].")";
		if (!$result = mysql_query($query)) {
			exit(mysql_error());
			 //echo "Username sudah pernah ada";
		}
		else{
			echo "Berhasil menambahkan pengaturan";
		}	
			
	}
?>