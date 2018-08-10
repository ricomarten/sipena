<?php
include ("../koneksinya.php");
$query=mysqli_query($conn,"select * from pengaturan2");
while($data=mysqli_fetch_array($query)){
echo "<tr>";
	$tgl=explode("-",$data['tanggal']);
	$tanggal=$tgl[2]."-".$tgl[1]."-".$tgl[0];
	echo "<td>".bulan($tanggal)."</td>";
	echo "<td>".$data['jam_kerja']."</td>";
	echo "<td>".$data['pc']."</td>";
	echo "<td>";
	//echo "<button onclick='GetDetails(\"".$data['tanggal']."\")' class='btn btn-warning' title='Edit'><i class='icon-edit'></i></button> ";
	echo "<button onclick='Delete(\"".$data['tanggal']."\")' class='btn btn-danger' title='Hapus'><i class='icon-trash'></i></button></td>";
echo "</tr>";
}
?>