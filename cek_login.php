<?php
	session_start();
	include "koneksinya.php";	
	include "plugins/AES/function.php";
	if(isset($_POST['username']) && isset($_POST['password'] )){
		$sql_cari=mysqli_query($conn, "select * from user where username='".$_POST['username']."' and password='".$_POST['password']."'");
		$cari=mysqli_num_rows($sql_cari);
		$data=mysqli_fetch_array($sql_cari);
		if($cari>=1){
			/* echo'<div class="alert alert-success">
				<button class="close" data-dismiss="alert">&times;</button>
				<h4>Sukses!</h4>
				<p>Username Anda ditemukan.</p>
			</div>'; */
			$_SESSION['username']=$data['username'];
			$_SESSION['password']=$data['password'];
			$_SESSION['level']=$data['status'];
			//echo $_SESSION['username'];
			echo "Berhasil login#";
			echo paramEncrypt('page=main');
		}else{
			echo'Username atau password Anda salah.';
		}
	}
	if(isset($_POST['email'])){
			echo'<div class="alert alert-error">
				<button class="close" data-dismiss="alert">&times;</button>
				<h4>Error!</h4>
				<p>Password baru sudah dikirm ke email.</p>
			</div>';
		}
	?>