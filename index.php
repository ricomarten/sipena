<?php
//error_reporting(0);
session_start();
include "koneksinya.php";
include "plugins/AES/function.php";

if (isset($_SESSION['username']) && (isset($_SESSION['password']))){	
	$pURI = explode('?', $_SERVER['REQUEST_URI']);
	if((count($pURI)==1) || ((count($pURI)==2) && (strlen($pURI[1])<32))){
		$page="main";
		$halaman="pages/$page.php";
	}
	else{
		$var=decode($_SERVER['REQUEST_URI']);
		$page=$var['page'];
		$halaman="pages/$page.php";
	}
	include "header.php";
	//jika file yang diinclude tidak ada.
	if(!file_exists($halaman) || empty($page)){		
		include "pages/main.php";	
	}else{
		include "$halaman";
	}
	include "footer.php";
}
else{
	header('Location: login.php');
}	


?>