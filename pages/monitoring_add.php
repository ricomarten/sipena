<?php
include ("../koneksinya.php"); // Connection to database
 
//$acceptedExtension = Array('image/jpeg', 'image/jpg'); // Accepted extensions
$maxSize = 2048000;
$destFolder = '../upload/'; // We upload the image here
$kesepakatan="kesepakatan".$_POST['kegId'];
$imgType = $_FILES[$kesepakatan]["type"];
$imgSize = $_FILES[$kesepakatan]["size"];
$imgName = $_FILES[$kesepakatan]["name"];
$imgTmpName = $_FILES[$kesepakatan]["tmp_name"];
//list($txt, $ext) = explode("image/", $imgType); // Get image extension
 
if ($imgSize <= $maxSize && $imgSize != "") { // Test is extension allowed and image size ok
	$explode	= explode('.',$imgName);
	$extensi	= $explode[count($explode)-1];
	//$newThumbImageName = 'profile-'.$_POST['userId'].'.'.$ext; // We rename the image (in our example it will be profile-1.jpeg)
	
	$sql=mysqli_query($conn,"select nama,dokumen from kegiatan where id='".$_POST['kegId']."'");
	$data=mysqli_fetch_array($sql);
	$namadok=$data['nama'].".".$extensi;
	if($data['dokumen']!=""){
		unlink($destFolder.$data['dokumen']);
	}
	if(move_uploaded_file($imgTmpName,$destFolder.$namadok)) { // Upload image
		
		mysqli_query($conn,'UPDATE kegiatan SET dokumen = "'.$namadok.'" WHERE id='.$_POST['kegId']); // Update database
 
		$text = '<p class="myImage"><a href="upload/'.$namadok.'">'.$namadok.'</a></p>'; // Send back the image...
		$text .= '<div class="alert alert-success" role="alert">Berhasil upload dokumen.</div>'; //...and a successfull text
		$text .= "Approve: <button class='btn btn-circle btn-success'><i class='icon-ok'></i></button><br>"; //...and a successfull text
		
		$dataBack = array('text' => $text, 'imgURL' => 'upload/'.$namadok); // Also send back the image URL
	}
 
} else {
	//if (!in_array($imgType, $acceptedExtension)) $text = '<div class="alert alert-danger" role="alert">Wrong format! Formats accepted: jpeg, jpg.</div>';
	if ($imgSize > $maxSize) $text = '<div class="alert alert-danger" role="alert">Dokumen terlalu besar. Maximum 2 Mb.</div>';
	elseif ($imgSize == "") $text = '<div class="alert alert-danger" role="alert">Dokumen terlalu besar. Maximum 2 Mb.</div>';
	
	$dataBack = array('text' => $text);
}
 
$dataBack = json_encode($dataBack);
echo $dataBack;
?>