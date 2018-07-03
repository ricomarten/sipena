<?php
//koneksi mwsql
$conn = @mysql_connect('localhost','root','');
//$conn = @mysql_connect('localhost','spi_monada','5pi5aja2017');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('sipena', $conn);
//mysql_select_db('spi_monada', $conn);
?>