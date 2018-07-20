<?php
include ("../koneksinya.php"); // Connection to database
 
//$acceptedExtension = Array('image/jpeg', 'image/jpg'); // Accepted extensions
$maxSize = 2048000;
$destFolder = '../upload/'; // We upload the image here

$imgType = $_FILES["kesepakatan"]["type"];
$imgSize = $_FILES["kesepakatan"]["size"];
$imgName = $_FILES["kesepakatan"]["name"];
$imgTmpName = $_FILES["kesepakatan"]["tmp_name"];
//list($txt, $ext) = explode("image/", $imgType); // Get image extension
 
if ($imgSize <= $maxSize && $imgSize != "") { // Test is extension allowed and image size ok
 
	//$newThumbImageName = 'profile-'.$_POST['userId'].'.'.$ext; // We rename the image (in our example it will be profile-1.jpeg)
 
	if(move_uploaded_file($imgTmpName,$destFolder.$imgName)) { // Upload image
		
		mysql_query('UPDATE kegiatan SET dokumen = "'.$imgName.'" WHERE id='.$_POST['kegId']); // Update database
 
		$text = '<p class="myImage"><a href="upload/'.$imgName.'">'.$imgName.'</a></p>'; // Send back the image...
		$text .= '<div class="alert alert-success" role="alert">Berhasil upload dokumen.</div>'; //...and a successfull text
		
		$dataBack = array('text' => $text, 'imgURL' => 'upload/'.$imgName); // Also send back the image URL
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