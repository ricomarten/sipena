<?php
include ("../koneksinya.php");
$query=mysql_query("select * from risiko");
$i=1;
while($data=mysql_fetch_array($query)){
echo "<tr>";
	echo "<td class='priority-1'>".$i."</td>";
	echo "<td class='priority-2'>".$data['risiko']."</td>";
	echo "<td class='priority-3'>".$data['mitigasi']."</td>";
	echo "<td class='priority-4'>".$data['status']."</td>";
	echo "<td class='priority-2'>";
	echo "<button onclick='GetDetails(\"".$data['id']."\")' class='btn btn-warning' title='Edit'><i class='icon-edit'></i></button> ";
	echo "<button onclick='Delete(\"".$data['id']."\",\"".$data['risiko']."\")' class='btn btn-danger' title='Hapus'><i class='icon-trash'></i></button></td>";
echo "</tr>";
$i++;
}
?>