<?php
include ("../koneksinya.php");
$query=mysql_query("select u.*,l.nama as nama_level from user u 
                    left join status_user l on l.kode_status=u.status");
while($data=mysql_fetch_array($query)){
echo "<tr>";
	echo "<td>".$data['username']."</td>";
	echo "<td>".$data['password']."</td>";
	echo "<td>".$data['nama_level']."</td>";
	echo "<td>";
	echo "<button onclick='GetDetails(\"".$data['username']."\")' class='btn btn-warning' title='Edit'><i class='icon-edit'></i></button> ";
	echo "<button onclick='Delete(\"".$data['username']."\")' class='btn btn-danger' title='Hapus'><i class='icon-trash'></i></button></td>";
echo "</tr>";
}
?>