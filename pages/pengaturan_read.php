<?php
include ("../koneksinya.php");
$query=mysql_query("select * from pengaturan");
$data=mysql_fetch_array($query);
echo '	<div class="controls controls-row">
			<label class="span7">Jumlah PC/Laptop Tersedia</label>
			<input class="span5" type="text" value="'.$data['pc'].'" readonly/>
		</div>
		<div class="controls controls-row">
			<label class="span7">Total Jam Kerja per Hari</label>
			<input class="span5" type="text" value="'.$data['jam_kerja'].'" readonly/>
		</div>
	';
?>