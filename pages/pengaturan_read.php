<?php
include ("../koneksinya.php");
$query=mysqli_query($conn,"select * from pengaturan");
$data=mysqli_fetch_array($query);
echo '	<div class="controls controls-row">
			<label class="span7">Jumlah PC/Laptop Tersedia</label>
			<input class="span5" type="text" value="'.$data['pc'].'" readonly/>
		</div>';
/* echo'		<div class="controls controls-row">
			<label class="span7">Total Jam Kerja per Hari</label>
			<input class="span5" type="text" value="'.$data['jam_kerja'].'" readonly/>
		</div>
	'; */
?>