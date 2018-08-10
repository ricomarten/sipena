<?php
include ("koneksinya.php");
if($_GET['page']=='mitigasi'){	
	// Fungsi header dengan mengirimkan raw data excel
	header("Content-type: application/vnd-ms-excel");
	 
	// Mendefinisikan nama file ekspor "hasil-export.xls"
	header("Content-Disposition: attachment; filename=mitigasi.xls");
	
	$query=mysqli_query($conn,"select * from risiko");
	$i=1;
	echo"<table border='1'>
			<tr>
				<th><center>No</center></th>    
				<th><center>Masalah</center></th>
				<th><center>Dampak</center></th>
				<th><center>Solusi</center></th>
			</tr>";
	while($data=mysqli_fetch_array($query)){
	echo "<tr>";
		echo "<td>".$i."</td>";
		echo "<td>".$data['risiko']."</td>";
		echo "<td>".$data['mitigasi']."</td>";
		echo "<td>".$data['status']."</td>";
	echo "</tr>";
	$i++;
	}
	echo "</table>";
}
if($_GET['page']=='monitoring'){	
	// Fungsi header dengan mengirimkan raw data excel
	header("Content-type: application/vnd-ms-excel");
	 
	// Mendefinisikan nama file ekspor "hasil-export.xls"
	header("Content-Disposition: attachment; filename=monitoring.xls");
	
	echo "<table border='1'>
		<tr>
			<th>No</th>
			<th>Nama Kegiatan Pengolahan Data</th>
			<th>Waktu Pengolahan</th>
			<th>Rencana Pengerjaan</th>
			<th>Keterangan</th>
			<th>Rekomendasi</th>
		</tr>";
					
	$sql=mysqli_query($conn,"select * from kegiatan");
	$i=1;
	while($data=mysqli_fetch_array($sql)){
		$awal = strtotime($data['jadwal_awal']);
		$akhir = strtotime($data['jadwal_selesai']);
		$datediff = $akhir - $awal;
		//echo round($datediff / (60 * 60 * 24));	
		echo "<tr>";
		echo "<td>".$i."</td>";
		echo "<td>".$data['nama']."</td>";
		echo "<td>".bulan(tanggal($data['jadwal_awal']))." s.d. ".bulan(tanggal($data['jadwal_selesai']))." (".(round($datediff / (60 * 60 * 24))+1)." hari)</td>";
		echo "<td>".$data['hari_kerja']." hari <ul>";
		$kal_keg=mysqli_query($conn,"select * from kalender_kegiatan where id_kegiatan='".$data['id']."' order by tanggal asc");
		while($data_kal=mysqli_fetch_array($kal_keg)){
			echo "<li>".bulan(tanggal($data_kal['tanggal']))."</li>";
		}
		echo "</ul></td>";
		echo "<td>".$data['prediksi']."</td>";
		echo "<td>".$data['rekomendasi']."</td>";			
		echo "</tr>";
		$i++;
	}
					
	echo "</table>";
}
if($_GET['page']=='perencanaan'){	
	// Fungsi header dengan mengirimkan raw data excel
	header("Content-type: application/vnd-ms-excel");
	 
	// Mendefinisikan nama file ekspor "hasil-export.xls"
	header("Content-Disposition: attachment; filename=perencanaan.xls");
	
	echo "<table border='1'>
		<tr>
			<th>No</th>
			<th>Nama Kegiatan Pengolahan Data</th>
			<th>Jadwal Pengolahan Data</th>
			<th>Rencana Pengerjaan</th>
		</tr>";
					
	$sql=mysqli_query($conn,"select * from kegiatan");
	$i=1;
	while($data=mysqli_fetch_array($sql)){
		$awal = strtotime($data['jadwal_awal']);
		$akhir = strtotime($data['jadwal_selesai']);
		$datediff = $akhir - $awal;
		//echo round($datediff / (60 * 60 * 24));
		
		echo "<tr>";
		echo "<td>".$i."</td>";
		echo "<td>".$data['nama']."</td>";
		echo "<td>".tanggal($data['jadwal_awal'])." s.d. ".tanggal($data['jadwal_selesai'])." (".(round($datediff / (60 * 60 * 24))+1)." hari)</td>";
		echo "<td>".$data['hari_kerja']." hari <ul>";
		$kal_keg=mysqli_query($conn,"select * from kalender_kegiatan where id_kegiatan='".$data['id']."'");
		while($data_kal=mysqli_fetch_array($kal_keg)){
			echo "<li>".tanggal($data_kal['tanggal'])."</li>";
		}
		echo "</ul></td>";
		echo "</tr>";
		$i++;
	}
					
	echo "</table>";
}
if($_GET['page']=='pengaturan'){	
	// Fungsi header dengan mengirimkan raw data excel
	header("Content-type: application/vnd-ms-excel");
	 
	// Mendefinisikan nama file ekspor "hasil-export.xls"
	header("Content-Disposition: attachment; filename=pengaturan.xls");
	
	echo "<table border='1'>
		<tr>
			<th><center>Tanggal</center></th>    
			<th><center>Jam Kerja</center></th>
			<th><center>Jumlah PC/Laptop Tersedia</center></th>
		</tr>";
	$i=1;
	$query=mysqli_query($conn,"select * from pengaturan2");
	while($data=mysqli_fetch_array($query)){
		echo "<tr>";
		$tgl=explode("-",$data['tanggal']);
		$tanggal=$tgl[2]."-".$tgl[1]."-".$tgl[0];
		echo "<td>".$tanggal."</td>";
		echo "<td>".$data['jam_kerja']."</td>";
		echo "<td>".$data['pc']."</td>";
		echo "<td>";
		//echo "<button onclick='GetDetails(\"".$data['tanggal']."\")' class='btn btn-warning' title='Edit'><i class='icon-edit'></i></button> ";
		echo "<button onclick='Delete(\"".$data['tanggal']."\")' class='btn btn-danger' title='Hapus'><i class='icon-trash'></i></button></td>";
		echo "</tr>";
	}
					
	echo "</table>";
}
?>