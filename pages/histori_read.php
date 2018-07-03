<?php
include ("../koneksinya.php");
$query=mysql_query("select * from risiko");
$i=1;
while($data=mysql_fetch_array($query)){
echo "<tr>";
	echo "<td>".$i."</td>";
	echo "<td>".$data['risiko']."</td>";
	echo "<td>".$data['mitigasi']."</td>";
	echo "<td>".$data['status']."</td>";
	echo "<td>";
	echo "<button onclick='GetDetails(\"".$data['id']."\")' class='btn btn-warning' title='Edit'><i class='icon-edit'></i></button> ";
	echo "<button onclick='Delete(\"".$data['id']."\",\"".$data['risiko']."\")' class='btn btn-danger' title='Hapus'><i class='icon-trash'></i></button></td>";
echo "</tr>";
$i++;
}
?>